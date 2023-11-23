<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactReplyMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.contact.index', [
            'contacts' => Contact::latest('id')->get(),
        ]);
    }

    /**
     * Display the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle the submission of the contact form.
     *
     * @param  \App\Http\Requests\ContactFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(ContactRequest $request)
    {
        $email = $request->input('email');
        $ipAddress = $request->ip();

        try {
            $isBanned = Contact::where('is_banned', 1)
                ->where(function ($query) use ($email, $ipAddress) {
                    $query->where('email', $email)
                        ->orWhere('ip_address', $ipAddress);
                })->exists();

            if ($isBanned) {
                return back()->with('error', 'Your account is banned. You cannot send messages.');
            }

            $contact = Contact::create($request->validated() + ['ip_address' => $ipAddress]);

            Mail::to($contact->email)->queue(new ContactReplyMail($contact));

            return back()->with('success', 'Message sent successfully!');
        } catch (QueryException $e) {
            Log::error("Database Query Exception: " . $e->getMessage());
            return back()->with('error', 'There was an issue submitting your message. Please try again.');
        } catch (Exception $e) {
            Log::error("General Exception: " . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }



    public function updateStatus(Request $request, $contactId)
    {
        // Directly validate the request data
        $validatedData = $request->validate([
            'is_banned' => 'required|boolean',
        ]);

        // Attempt to update the contact and handle any exceptions
        try {
            Contact::where('id', $contactId)->update(['is_banned' => $validatedData['is_banned']]);
            return response()->json(['message' => 'Contact status updated successfully']);
        } catch (\Exception $e) {
            // Log the exception and return a generic error message
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to update contact status'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::find($id)->delete();
    }
}

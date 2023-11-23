<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactReplyMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Log; // Import the Log facade

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

        // Check if a contact with the same email or IP address is banned
        $isBanned = Contact::where(function ($query) use ($email, $ipAddress) {
            $query->where('email', $email)
                ->orWhere('ip_address', $ipAddress);
        })->where('is_banned', 1)->exists();

        if ($isBanned) {
            return back()->with('error', 'Your account is banned. You cannot send messages.');
        }

        $validatedData = $request->validated();
        $validatedData['ip_address'] = $ipAddress;

        $contact = Contact::create($validatedData);

        Mail::to($contact->email)->queue(new ContactReplyMail($contact));

        return back()->with('success', 'Message sent successfully!');
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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Http\Controllers\Controller;

class PaymentTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.paymentTransaction.index', [
            'paymentTransactions' => PaymentTransaction::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'status' => 'required|string|in:pending,completed,failed,refunded' // Adjust the status values as needed
        ]);

        // Update the transaction status
        $updated = PaymentTransaction::find($id)
            ->update(['status' => $validated['status']]);

        // Check if any row was actually updated
        if ($updated) {
            return response()->json(['message' => 'Status updated successfully']);
        }

        // If no rows were updated, it means the transaction was not found
        return response()->json(['message' => 'Transaction not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaymentTransaction::find($id)->delete();
    }
}

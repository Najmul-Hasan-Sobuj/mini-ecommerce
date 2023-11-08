<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentTransactionRequest;
use App\Repositories\Interfaces\PaymentTransactionRepositoryInterface;

class PaymentTransactionController extends Controller
{
    private $paymentTransactionRepository;

    public function __construct(PaymentTransactionRepositoryInterface $paymentTransactionRepository)
    {
        $this->paymentTransactionRepository = $paymentTransactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.paymentTransaction.index', [
            'paymentTransactions' => $this->paymentTransactionRepository->allPaymentTransaction(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentTransactionRequest $request)
    {
        $data = [
            'order_id'          => $request->order_id,
            'payment_method_id' => $request->payment_method_id,
            'amount'            => $request->amount,
            'transaction_id'    => $request->transaction_id,
            'status'            => $request->status,
        ];
        $this->paymentTransactionRepository->storePaymentTransaction($data);
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentTransactionRequest $request, $id)
    {
        $data = [
            'order_id'          => $request->order_id,
            'payment_method_id' => $request->payment_method_id,
            'amount'            => $request->amount,
            'transaction_id'    => $request->transaction_id,
            'status'            => $request->status,
        ];
        $this->paymentTransactionRepository->updatePaymentTransaction($data, $id);

        toastr()->success('Data has been updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->paymentTransactionRepository->destroyPaymentTransaction($id);
    }
}

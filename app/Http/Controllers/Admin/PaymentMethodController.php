<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;

class PaymentMethodController extends Controller
{
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.paymentMethod.index', [
            'paymentMethods' => $this->paymentMethodRepository->allPaymentMethod(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request)
    {
        $data = [
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
        ];
        $this->paymentMethodRepository->storePaymentMethod($data);
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
    public function update(PaymentMethodRequest $request, $id)
    {
        $data = [
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
        ];
        $this->paymentMethodRepository->updatePaymentMethod($data, $id);

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
        $this->paymentMethodRepository->destroyPaymentMethod($id);
    }
}

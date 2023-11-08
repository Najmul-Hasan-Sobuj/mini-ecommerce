<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RefundPolicyRequest;
use App\Repositories\Interfaces\RefundPolicyRepositoryInterface;

class RefundPolicyController extends Controller
{
    private $refundPolicyRepository;

    public function __construct(RefundPolicyRepositoryInterface $refundPolicyRepository)
    {
        $this->refundPolicyRepository = $refundPolicyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.refundPolicy.index', [
            'refundPolicies' => $this->refundPolicyRepository->allRefundPolicy(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RefundPolicyRequest $request)
    {
        $data = [
            'policy_text' => $request->policy_text,
            'last_updated' => now(),
        ];
        $this->refundPolicyRepository->storeRefundPolicy($data);
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
    public function update(RefundPolicyRequest $request, $id)
    {
        $data = [
            'policy_text' => $request->policy_text,
            'last_updated' => now(),
        ];
        $this->refundPolicyRepository->updateRefundPolicy($data, $id);

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
        $this->refundPolicyRepository->destroyRefundPolicy($id);
    }
}

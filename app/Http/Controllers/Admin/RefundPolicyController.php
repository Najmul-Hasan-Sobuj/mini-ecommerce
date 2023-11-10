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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function refundPolicy(RefundPolicyRequest $request)
    {
        $dataToUpdateOrCreate = [
            'policy_text'  => $request->policy_text,
            'last_updated' => now(),
        ];

        $refundPolicy = $this->refundPolicyRepository->updateOrCreateRefundPolicy($dataToUpdateOrCreate);

        $toastMessage = $refundPolicy->wasRecentlyCreated ? 'Data has been created successfully!' : 'Data has been updated successfully!';
        toastr()->success($toastMessage);
        return redirect()->back();
    }
}

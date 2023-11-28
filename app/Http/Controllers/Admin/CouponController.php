<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Repositories\BaseRepositoryInterface;

class CouponController extends Controller
{
    private $couponRepository;

    public function __construct(BaseRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.coupon.index', [
            'coupons' => $this->couponRepository->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $data = [
            'code'        => $request->code,
            'type'        => $request->type,
            'max_uses'    => $request->max_uses,
            'valid_from'  => $request->valid_from,
            'valid_until' => $request->valid_until,
            'status'      => $request->status,
            'description' => $request->description,
        ];
        $this->couponRepository->create($data);

        return redirect()->back()->with('success', 'Data has been saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        $data = [
            'code'        => $request->code,
            'type'        => $request->type,
            'max_uses'    => $request->max_uses,
            'valid_from'  => $request->valid_from,
            'valid_until' => $request->valid_until,
            'status'      => $request->status,
            'description' => $request->description,
        ];
        $this->couponRepository->update($data, $id);


        return redirect()->back()->with('success', 'Data has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->couponRepository->delete($id);
    }
}

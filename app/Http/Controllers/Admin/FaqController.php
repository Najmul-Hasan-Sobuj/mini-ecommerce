<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Repositories\Interfaces\FaqRepositoryInterface;

class FaqController extends Controller
{
    private $faqRepository;

    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.faq.index', [
            'faqs' => $this->faqRepository->allFaq(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $data = [
            'category' => $request->category,
            'question' => $request->question,
            'order'    => $request->order,
            'status'   => $request->status,
            'answer'   => $request->answer,
        ];
        $this->faqRepository->storeFaq($data);
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
    public function update(FaqRequest $request, $id)
    {
        $data = [
            'category' => $request->category,
            'question' => $request->question,
            'order'    => $request->order,
            'status'   => $request->status,
            'answer'   => $request->answer,
        ];
        $this->faqRepository->updateFaq($data, $id);

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
        $this->faqRepository->destroyFaq($id);
    }
}

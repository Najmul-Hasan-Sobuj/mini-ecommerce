<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviewRequest;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.productReview.index', [
            'productReviews' => ProductReview::join('users', 'product_reviews.user_id', '=', 'users.id')
                ->select('product_reviews.*', 'users.name as user_name')
                ->latest('product_reviews.id')
                ->get(),
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
    public function store(ProductReviewRequest $request)
    {
        $data = [
            'product_id'   => $request->product_id,
            'user_id'      => $request->user_id,
            'review_text'  => $request->review_text,
            'rating_value' => $request->rating_value,
            'is_verified'  => 'no',
        ];
        ProductReview::create($data);

        return redirect()->back()->with('success', 'Review added successfully.');
    }

    public function updateStatus(Request $request, $reviewId)
    {
        // Directly validate the request data
        $validatedData = $request->validate([
            'is_verified' => 'required|in:yes,no',
        ]);

        // Attempt to update the product review and handle any exceptions
        try {
            ProductReview::where('id', $reviewId)->update(['is_verified' => $validatedData['is_verified']]);
            return response()->json(['message' => 'Review verification status updated successfully']);
        } catch (\Exception $e) {
            // Log the exception and return a generic error message
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to update review verification status'], 500);
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductReview::find($id)->delete();
    }
}

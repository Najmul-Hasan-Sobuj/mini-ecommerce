<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Models\ProductAttachment;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.product.index', [
            'products' => Product::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view("admin.pages.product.create", [
            'categorys' => Category::get(['id', 'name']),
            'brands'    => Brand::get(['id', 'name']),
            'products' => Product::get(['tags']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $mainImageFile = $request->file('image');
            $mainImagePath = storage_path('app/public/');
            $mainImage = null;

            if (!empty($mainImageFile)) {
                $uploadMainImage = customUpload($mainImageFile, $mainImagePath);
                if ($uploadMainImage['status'] == 1) {
                    $mainImage = $uploadMainImage['file_name'];
                }
            }

            $productData = [
                'category_id' => $request->category_id,
                'brand_id'    => $request->brand_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'image'       => $mainImage,
                'sku'         => $request->sku,
                'description' => $request->description,
                'price'       => $request->price,
                'quantity'    => $request->quantity,
                'status'      => $request->status,
                'sizes'       => json_encode($request->sizes),
                'colors'      => json_encode($request->colors),
                'tags'        => json_encode($request->tags),
                'created_by'  => auth()->id(),
            ];

            $product = Product::create($productData);

            $additionalImages = $request->file('images');
            if (!empty($additionalImages)) {
                foreach ($additionalImages as $imageFile) {
                    $uploadImage = customUpload($imageFile, $mainImagePath);
                    if ($uploadImage['status'] == 1) {
                        $attachmentData = [
                            'product_id' => $product->id,
                            'images'     => $uploadImage['file_name'],
                        ];
                        ProductAttachment::create($attachmentData);
                    }
                }
            }

            DB::commit();
            return back()->success('Product has been saved successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->error('An error occurred while saving the product.');
        }
        return redirect()->back();
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
        return view("admin.pages.product.edit", [
            'product'   => Product::findOrFail($id),
            'categorys' => Category::get(['id', 'name']),
            'brands'    => Brand::get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        // Begin transaction
        DB::beginTransaction();

        try {
            // Find the product by id
            $product = Product::findOrFail($id);

            // Process the main product image
            $mainFile = $request->file('image');
            $filePath = storage_path('app/public/');
            $mainImageUpdate = false;

            if (!empty($mainFile)) {
                // Upload the new main image
                $globalFunImage = customUpload($mainFile, $filePath);

                // Delete the old main image if new image upload is successful
                if ($globalFunImage['status'] == 1) {
                    $mainImageUpdate = true;
                    $oldImagePath = $filePath . $product->image;
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
            } else {
                $globalFunImage = ['status' => 0];
            }

            // Prepare data for the main product update
            $product->update([
                'category_id' => $request->category_id,
                'brand_id'    => $request->brand_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'image'       => $mainImageUpdate ? $globalFunImage['file_name'] : $product->image,
                'sku'         => $request->sku,
                'description' => $request->description,
                'price'       => $request->price,
                'quantity'    => $request->quantity,
                'status'      => $request->status,
                'sizes'       => json_encode($request->sizes),
                'colors'      => json_encode($request->colors),
                'tags'        => json_encode($request->tags),
                'created_by'  => auth()->id(), // Or another way to get the user ID
            ]);

            // Process additional images if they are provided
            if ($request->has('images')) {
                // First, delete old attachment records and their files
                $oldAttachments = ProductAttachment::where('product_id', $product->id)->get();
                foreach ($oldAttachments as $oldAttachment) {
                    $oldAttachmentPath = $filePath . $oldAttachment->images;
                    if (File::exists($oldAttachmentPath)) {
                        File::delete($oldAttachmentPath);
                    }
                    $oldAttachment->delete(); // This will delete the record from the database
                }

                $additionalImages = $request->file('images');
                foreach ($additionalImages as $imageFile) {
                    // Upload and store each additional image
                    $uploadImage = customUpload($imageFile, $filePath);
                    if ($uploadImage['status'] == 1) {
                        // Create new product attachments
                        ProductAttachment::create([
                            'product_id' => $product->id,
                            'images' => $uploadImage['file_name'],
                        ]);
                    }
                }
            }

            DB::commit();
            toastr()->success('Product has been updated successfully!');
        } catch (\Exception $e) {
            // An error occurred; rollback the transaction
            DB::rollback();
            toastr()->error('An error occurred while updating the product.');
            // Optionally, log the error or handle it as needed
        }

        // Redirect back
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
        // Retrieve the product along with its attachments
        $product = Product::with('attachments')->findOrFail($id);

        // Delete the main product image
        $mainImagePath = storage_path('app/public/') . $product->image;
        if (File::exists($mainImagePath)) {
            File::delete($mainImagePath);
        }

        // Delete additional images from the product_attachments table
        foreach ($product->attachments as $attachment) {
            $attachmentPath = storage_path('app/public/') . $attachment->images;
            if (File::exists($attachmentPath)) {
                File::delete($attachmentPath);
            }
            // Delete the attachment record
            $attachment->delete();
        }

        // Delete the product
        $product->delete();
    }
}

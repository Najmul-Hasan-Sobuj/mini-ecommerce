<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Repositories\Interfaces\BrandRepositoryInterface;

class BrandController extends Controller
{
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.brand.index', [
            'brands' => $this->brandRepository->allBrand(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view("admin.pages.brand.create", [
            'brands' => $this->brandRepository->allBrand(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $mainFile = $request->file('image');
        $filePath = storage_path('app/public/');
        if (!empty($mainFile)) {
            $globalFunImage = customUpload($mainFile, $filePath,   44, 44);
        } else {
            $globalFunImage = ['status' => 0];
        }

        $data = [
            'name'         => $request->name,
            'slug'         => Str::slug($request->name),
            'image'        => $globalFunImage['status'] == 1 ? $globalFunImage['file_name'] : null,
        ];
        $this->brandRepository->storeBrand($data);

        toastr()->success('Data has been saved successfully!');
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
        return view('admin.pages.brand.show', [
            'brand' => $this->brandRepository->findBrand($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.brand.edit', [
            'brand' => $this->brandRepository->findBrand($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $brand =  $this->brandRepository->findBrand($id);

        $mainFile = $request->file('image');
        $filePath = storage_path('app/public/');

        if (!empty($mainFile)) {
            $globalFunImage = customUpload($mainFile, $filePath, 44, 44);
            $paths = [
                storage_path("app/public/{$brand->image}"),
                storage_path("app/public/requestImg/{$brand->image}")
            ];
            foreach ($paths as $path) {
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        } else {
            $globalFunImage = ['status' => 0];
        }

        $data = [
            'name'         => $request->name,
            'slug'         => Str::slug($request->name),
            'image'        => $globalFunImage['status'] == 1 ? $globalFunImage['file_name'] : $brand->image,
        ];

        $this->brandRepository->updateBrand($data, $id);

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
        $brand =  $this->brandRepository->findBrand($id);

        $paths = [
            storage_path('app/public/') . $brand->image,
            storage_path('app/public/requestImg/') . $brand->image,
        ];

        foreach ($paths as $path) {
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $this->brandRepository->destroyBrand($id);
    }
}


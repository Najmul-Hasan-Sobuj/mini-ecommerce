<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    public function allBrand()
    {
        return Brand::get();
    }

    public function storeBrand(array $data)
    {
        return Brand::create($data);
    }

    public function findBrand(int $id)
    {
        return Brand::findOrFail($id);
    }

    public function updateBrand(array $data, int $id)
    {
        return Brand::findOrFail($id)->update($data);
    }

    public function destroyBrand(int $id)
    {
        return Brand::destroy($id);
    }
}

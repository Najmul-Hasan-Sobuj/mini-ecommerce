<?php

namespace App\Repositories;

use App\Models\RefundPolicy;
use App\Repositories\Interfaces\RefundPolicyRepositoryInterface;

class RefundPolicyRepository implements RefundPolicyRepositoryInterface
{
    public function allRefundPolicy()
    {
        return RefundPolicy::latest('id')->get();
    }

    public function storeRefundPolicy(array $data)
    {
        return RefundPolicy::create($data);
    }

    public function findRefundPolicy(int $id)
    {
        return RefundPolicy::findOrFail($id);
    }

    public function updateRefundPolicy(array $data, int $id)
    {
        return RefundPolicy::findOrFail($id)->update($data);
    }

    public function destroyRefundPolicy(int $id)
    {
        return RefundPolicy::destroy($id);
    }
}

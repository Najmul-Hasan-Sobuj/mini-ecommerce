<?php

namespace App\Repositories;

use App\Models\RefundPolicy;
use App\Repositories\Interfaces\RefundPolicyRepositoryInterface;

class RefundPolicyRepository implements RefundPolicyRepositoryInterface
{
    public function allRefundPolicy()
    {
        return RefundPolicy::first();
    }

    public function findRefundPolicy(int $id)
    {
        return RefundPolicy::findOrFail($id);
    }

    public function updateOrCreateRefundPolicy(array $data)
    {
        return RefundPolicy::updateOrCreate([], $data);
    }
}

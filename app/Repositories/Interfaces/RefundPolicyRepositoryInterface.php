<?php

namespace App\Repositories\Interfaces;

interface RefundPolicyRepositoryInterface
{
    public function allRefundPolicy();
    public function findRefundPolicy(int $id);
    public function updateOrCreateRefundPolicy(array $data);
}

<?php

namespace App\Repositories\Interfaces;

interface RefundPolicyRepositoryInterface
{
    public function allRefundPolicy();
    public function storeRefundPolicy(array $data);
    public function findRefundPolicy(int $id);
    public function updateRefundPolicy(array $data, int $id);
    public function destroyRefundPolicy(int $id);
}

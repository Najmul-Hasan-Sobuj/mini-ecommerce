<?php

namespace App\Repositories\Interfaces;

interface PaymentMethodRepositoryInterface
{
    public function allPaymentMethod();
    public function storePaymentMethod(array $data);
    public function findPaymentMethod(int $id);
    public function updatePaymentMethod(array $data, int $id);
    public function destroyPaymentMethod(int $id);
}

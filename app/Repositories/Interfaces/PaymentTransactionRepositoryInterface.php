<?php

namespace App\Repositories\Interfaces;

interface PaymentTransactionRepositoryInterface
{
    public function allPaymentTransaction();
    public function storePaymentTransaction(array $data);
    public function findPaymentTransaction(int $id);
    public function updatePaymentTransaction(array $data, int $id);
    public function destroyPaymentTransaction(int $id);
}

<?php

namespace App\Repositories;

use App\Models\PaymentTransaction;
use App\Repositories\Interfaces\PaymentTransactionRepositoryInterface;

class PaymentTransactionRepository implements PaymentTransactionRepositoryInterface
{
    public function allPaymentTransaction()
    {
        return PaymentTransaction::latest('id')->get();
    }

    public function storePaymentTransaction(array $data)
    {
        return PaymentTransaction::create($data);
    }

    public function findPaymentTransaction(int $id)
    {
        return PaymentTransaction::findOrFail($id);
    }

    public function updatePaymentTransaction(array $data, int $id)
    {
        return PaymentTransaction::findOrFail($id)->update($data);
    }

    public function destroyPaymentTransaction(int $id)
    {
        return PaymentTransaction::destroy($id);
    }
}

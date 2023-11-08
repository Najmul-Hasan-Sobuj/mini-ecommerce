<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function allPaymentMethod()
    {
        return PaymentMethod::latest('id')->get();
    }

    public function storePaymentMethod(array $data)
    {
        return PaymentMethod::create($data);
    }

    public function findPaymentMethod(int $id)
    {
        return PaymentMethod::findOrFail($id);
    }

    public function updatePaymentMethod(array $data, int $id)
    {
        return PaymentMethod::findOrFail($id)->update($data);
    }

    public function destroyPaymentMethod(int $id)
    {
        return PaymentMethod::destroy($id);
    }
}

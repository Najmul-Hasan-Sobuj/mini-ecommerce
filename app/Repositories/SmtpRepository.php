<?php

namespace App\Repositories;

use App\Models\Smtp;
use App\Repositories\Interfaces\SmtpRepositoryInterface;

class SmtpRepository implements SmtpRepositoryInterface
{
    protected $model;

    public function __construct(Smtp $smtp)
    {
        $this->model = $smtp;
    }

    public function getFirstSmtp()
    {
        return $this->model->first();
    }

    public function updateOrCreateSmtp(array $data)
    {
        return $this->model->updateOrCreate([], $data);
    }
}

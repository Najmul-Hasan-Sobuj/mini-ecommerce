<?php

namespace App\Repositories;

use App\Models\Faq;

class FaqRepository extends BaseRepository
{
    protected $model;

    public function __construct(Faq $faq)
    {
        $this->model = $faq;
    }
}

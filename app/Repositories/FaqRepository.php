<?php

namespace App\Repositories;

use App\Models\Faq;
use App\Repositories\Interfaces\FaqRepositoryInterface;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    // public function allFaq()
    // {
    //     return Faq::latest('id')->get();
    // }

    // public function storeFaq(array $data)
    // {
    //     return Faq::create($data);
    // }

    // public function findFaq(int $id)
    // {
    //     return Faq::findOrFail($id);
    // }

    // public function updateFaq(array $data, int $id)
    // {
    //     return Faq::findOrFail($id)->update($data);
    // }

    // public function destroyFaq(int $id)
    // {
    //     return Faq::destroy($id);
    // }

    protected $model;

    public function __construct(Faq $faq)
    {
        $this->model = $faq;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
}

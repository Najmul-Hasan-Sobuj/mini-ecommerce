<?php

namespace App\Repositories\Interfaces;

interface FaqRepositoryInterface
{
    // public function allFaq();
    // public function storeFaq(array $data);
    // public function findFaq(int $id);
    // public function updateFaq(array $data, int $id);
    // public function destroyFaq(int $id);

    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}

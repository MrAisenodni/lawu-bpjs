<?php

namespace App\Repositories\Settings\Provider;

use App\Models\Settings\Provider;

class ProviderRepository implements ProviderRepositoryInterface
{
    public function getAll()
    {
        $data = Provider::get();

        return $data;
    }

    public function getData()
    {
        $data = Provider::first();

        return $data;
    }

    public function findById($id)
    {
        $data = Provider::where('id', $id);

        return $data->first();
    }

    public function save(array $data)
    {
        return Provider::create($data);
    }

    public function update($id, array $data)
    {
        $detail = $this->findById($id);
        $detail->update($data);
        return $detail;
    }

    public function delete($id)
    {
        $detail = $this->findById($id);
        $detail->delete();
        return true;
    }
}
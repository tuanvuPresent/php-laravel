<?php

namespace App\Repositories\Example;

use App\Example;

class ExampleRepository implements IExampleRepository
{
    public function getAll()
    {
        return Example::all();
    }

    public function find($id)
    {
        $result = Example::find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return Example::create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
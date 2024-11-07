<?php

namespace App\Services;

use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Pharmacy;
use Phar;

class PharmacyService
{
  public function index()
  {
    try {
      $count = request()->query('count', 10);
      return Pharmacy::paginate($count);
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while retrieving.');
    }
  }

  public function store(StorePharmacyRequest $request)
  {
    try {
      return Pharmacy::create($request->only(['name', 'address']));
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while creating.');
    }
  }

  public function show($id)
  {
    try {
      return Pharmacy::findOrFail($id);
    } catch (\Exception $e) {
      throw new \App\Exceptions\NotFoundException('Not found.');
    }
  }

  public function update(UpdatePharmacyRequest $request, $id)
  {
    try {
      $pharmacy = Pharmacy::findOrFail($id);
    } catch (\Exception $e) {
      throw new \App\Exceptions\NotFoundException('Not found.');
    }

    try {
      $data = $request->only(['name', 'address']);
      if ($pharmacy->name === $data['name']) {
        unset($data['name']);
      }

      $pharmacy->update($data);
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while updating.');
    }

    return $pharmacy->fresh();
  }

  public function destroy($id)
  {
    try {
      $pharmacy = Pharmacy::findOrFail($id);
    } catch (\Exception $e) {
      throw new \App\Exceptions\NotFoundException('Not found.');
    }

    try {
      $pharmacy->delete();
    } catch (\Exception $e) {
      throw new \App\Exceptions\QueryDBException('An error occurred while deleting.');
    }

    return $pharmacy;
  }
}

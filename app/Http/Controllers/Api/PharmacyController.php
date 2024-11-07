<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Services\PharmacyService;

class PharmacyController extends Controller
{
    protected $pharmacyService;

    public function __construct(PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }

    public function index()
    {
        $pharmacies = $this->pharmacyService->index();
        return response()->json($pharmacies);
    }

    public function store(StorePharmacyRequest $request)
    {
        $createdPharmacy = $this->pharmacyService->store($request);
        return response()->json($createdPharmacy, 201);
    }

    public function show($id)
    {
        $pharmacy = $this->pharmacyService->show($id);
        return response()->json($pharmacy);
    }

    public function update(UpdatePharmacyRequest $request,  $id)
    {
        $updatedPharmacy = $this->pharmacyService->update($request, $id);
        return response()->json($updatedPharmacy);
    }

    public function destroy($id)
    {
        $deletedPharmacy = $this->pharmacyService->destroy($id);
        return response()->json($deletedPharmacy);
    }
}

<?php

namespace App\Http\Controllers;

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
        return view('pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        return view('pharmacies.create');
    }

    public function store(StorePharmacyRequest $request)
    {
        $this->pharmacyService->store($request);
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy created successfully.');
    }

    public function edit($id)
    {
        $pharmacy = $this->pharmacyService->show($id);
        return view('pharmacies.edit', compact('pharmacy'));
    }

    public function update(UpdatePharmacyRequest $request, $id)
    {
        $this->pharmacyService->update($request, $id);
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy updated successfully.');
    }

    public function destroy($id)
    {
        $this->pharmacyService->destroy($id);
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy deleted successfully.');
    }
}

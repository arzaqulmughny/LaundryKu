<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialRequest;
use App\Models\Material;
use App\Repositories\MaterialRepository;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.materials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $units = UnitRepository::all()->pluck('name', 'code');
        return view('pages.materials.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        try {
            MaterialRepository::store($request->toArray());
            return redirect()->route('materials.index')->with('success', 'Data bahan berhasil ditambahkan');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return view('pages.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Material $material)
    {
        $units = UnitRepository::all()->pluck('name', 'code');
        return view('pages.materials.edit', compact('material', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        try {
            MaterialRepository::update($material, $request->toArray());
            return redirect()->route('materials.index')->with('success', 'Data bahan berhasil diupdate');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        try {
            MaterialRepository::delete($material);
            return redirect()->route('materials.index')->with('success', 'Data bahan berhasil dihapus');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

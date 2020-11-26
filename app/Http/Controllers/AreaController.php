<?php

namespace App\Http\Controllers;

use App\Area;
use App\DataTables\AreaDataTable;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AreaDataTable $areaDataTable)
    {
        $areas = Area::all();
        $regions = $areas->unique('region_name')->pluck('region_name');
        $provinces = $areas->unique('province_name')->pluck('province_name');
        $cities = $areas->unique('city_name')->pluck('city_name');
        $districts = $areas->unique('district_name')->pluck('district_name');
        $villages = $areas->unique('village_name')->pluck('village_name');
        return $areaDataTable->render('areas.index', compact('regions', 'provinces', 'cities', 'districts', 'villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Area::create($request->only('code', 'region_name', 'region_code', 'province_name', 'province_code', 'city_name', 'city_code', 'district_name', 'district_code', 'village_name', 'village_code'));
        Alert::success("Berhasil", "Berhasil menambah area");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return view('areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $data = $request->only('code', 'region_name', 'region_code', 'province_name', 'province_code', 'city_name', 'city_code', 'district_name', 'district_code', 'village_name', 'village_code');
        $area->update($data);
        Alert::success('Berhasil', "Berhasil memperbarui area");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}

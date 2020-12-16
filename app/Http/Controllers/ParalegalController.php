<?php

namespace App\Http\Controllers;

use App\Area;
use App\DataTables\ParalegalDataTable;
use App\Paralegal;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ParalegalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ParalegalDataTable $paralegalDataTable)
    {
        $areas = Area::all();
        return $paralegalDataTable->render('paralegals.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paralegal  $paralegal
     * @return \Illuminate\Http\Response
     */
    public function show(Paralegal $paralegal)
    {
        $user = $paralegal->user;
        $user->load('paralegal', 'paralegal.area');

        $areas = Area::all();

        return view('profile', compact('user', 'areas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paralegal  $paralegal
     * @return \Illuminate\Http\Response
     */
    public function edit(Paralegal $paralegal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paralegal  $paralegal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paralegal $paralegal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paralegal  $paralegal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paralegal $paralegal)
    {
        //
    }

    public function approve(Request $request, Paralegal $paralegal)
    {
        if (!$request->area_id) {
            Alert::error('Gagal', "Pilih area terlebih dahulu");
            return redirect()->back();
        }

        $paralegalApprovedCount = str_pad(Paralegal::where('isApproved', 1)->count() + 1, 3, 0, STR_PAD_LEFT);
        $area = Area::find($request->area_id);

        $paralegal->isApproved = 1;
        $paralegal->number = $area->code . ".$paralegal->altered_sex" . ".$paralegalApprovedCount";
        $paralegal->area_id = $request->area_id;
        $paralegal->save();

        Alert::success("Berhasil", "Berhasil menyetujui paralegal");
        return redirect()->back();
    }

    public function disapprove(Paralegal $paralegal)
    {
        $user = $paralegal->user;
        $paralegal->delete();
        $user->delete();

        Alert::success('Berhasil', "Berhasil menolak dan menghapus paralegal");
        return redirect()->route('paralegal.index');
    }
}

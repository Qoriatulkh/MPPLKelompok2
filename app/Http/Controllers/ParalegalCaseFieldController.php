<?php

namespace App\Http\Controllers;

use App\DataTables\ParalegalCaseFieldDataTable;
use App\ParalegalCaseField;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ParalegalCaseFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ParalegalCaseFieldDataTable $paralegalCaseFieldDataTable)
    {
        return $paralegalCaseFieldDataTable->render('cases.fields.index');
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
        $field = ParalegalCaseField::create([
            'name' => $request->name
        ]);

        Alert::success("Berhasil", "Berhasil membuat bidang kasus " . $field->name);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParalegalCaseField  $paralegalCaseField
     * @return \Illuminate\Http\Response
     */
    public function show(ParalegalCaseField $paralegalCaseField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParalegalCaseField  $paralegalCaseField
     * @return \Illuminate\Http\Response
     */
    public function edit(ParalegalCaseField $paralegalCaseField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParalegalCaseField  $paralegalCaseField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParalegalCaseField $paralegalCaseField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParalegalCaseField  $paralegalCaseField
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParalegalCaseField $paralegalCaseField)
    {
        $paralegalCaseField->delete();

        Alert::success("Berhasil", "Berhasil menghapus bidang kasus " . $paralegalCaseField->name);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\ParalegalCaseDataTable;
use App\ParalegalCase;
use Illuminate\Http\Request;

class ParalegalCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ParalegalCaseDataTable $paralegalCaseDataTable)
    {
        return $paralegalCaseDataTable->render('cases.index');
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
     * @param  \App\ParalegalCase  $paralegalCase
     * @return \Illuminate\Http\Response
     */
    public function show(ParalegalCase $paralegalCase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParalegalCase  $paralegalCase
     * @return \Illuminate\Http\Response
     */
    public function edit(ParalegalCase $paralegalCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParalegalCase  $paralegalCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParalegalCase $paralegalCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParalegalCase  $paralegalCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParalegalCase $paralegalCase)
    {
        //
    }
}

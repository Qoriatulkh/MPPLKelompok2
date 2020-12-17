<?php

namespace App\Http\Controllers;

use App\Area;
use App\DataTables\ParalegalCaseDataTable;
use App\Paralegal;
use App\ParalegalCase;
use App\ParalegalCaseField;
use App\ParalegalCaseStatus;
use App\ParalegalCaseType;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ParalegalCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ParalegalCaseDataTable $paralegalCaseDataTable)
    {
        if (auth()->user()->isAdmin()) {
            $paralegals = Paralegal::all();
        } else {
            $paralegals = [];
        }
        $areas = Area::all();
        $types = ParalegalCaseType::all();
        $fields = ParalegalCaseField::all();
        $statuses = ParalegalCaseStatus::all();
        return $paralegalCaseDataTable->render('cases.index', compact('types', 'fields', 'paralegals', 'areas', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->isAdmin()) {
            $paralegals = Paralegal::where('isApproved', 1)->get();
        } else {
            $paralegals = [];
            if (!Gate::check('add-cases')) {
                Alert::error("Gagal", "Akun anda belum disetujui");
                return redirect()->back();
            }
        }
        $types = ParalegalCaseType::all();
        $fields = ParalegalCaseField::all();
        $statuses = ParalegalCaseStatus::all();
        $nowDate = Carbon::now()->locale('id')->translatedFormat('m/d/Y');
        return view('cases.create', compact('paralegals', 'types', 'fields', 'nowDate', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $isAdmin = $user->isAdmin();

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string'],
            'type_id' => ['required'],
            'field_id' => ['required'],
            'description' => ['required'],
        ])->validate();

        $explodedDate = explode('/', $data['date']); // 0 month, 1 day, 2 year
        $date = Carbon::create($explodedDate[2], $explodedDate[0], $explodedDate[1])->toDate();

        $paralegalCase = ParalegalCase::create([
            'name' => $data['name'],
            'date' => $date,
            'paralegal_id' => $isAdmin ? $data['paralegal_id'] : $user->paralegal->id,
            'type_id' => $data['type_id'],
            'field_id' => $data['field_id'],
            'desc' => $data['description'],
            'created_by' => $user->id,
            'status_id' => $data['status_id']
        ]);

        Alert::success("Berhasil", "Berhasil menambah kasus baru");
        return redirect()->route('case.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParalegalCase  $paralegalCase
     * @return \Illuminate\Http\Response
     */
    public function show(ParalegalCase $paralegalCase)
    {
        if (!auth()->user()->isAdmin() && $paralegalCase->paralegal_id != auth()->user()->paralegal->id) {
            abort(403);
        }
        return view('cases.show', compact('paralegalCase'));
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

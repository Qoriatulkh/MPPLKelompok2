<?php

namespace App\DataTables;

use App\ParalegalCase;
use App\ParalegalCaseStatus;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParalegalCaseDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $request = $this->request();
        return datatables()
            ->eloquent($query)
            ->filter(function ($filter) use ($request) {
                if ($area_id = $request->query('area_id')) {
                    $filter->whereHas('paralegal', function ($query) use ($area_id) {
                        $query->where('area_id', $area_id);
                    });
                }
                if (($paralegal_id = $request->query('paralegal_id'))) {
                    $filter->where('paralegal_id', $paralegal_id);
                }
                if (($type_id = $request->query('type_id'))) {
                    $filter->where('type_id', $type_id);
                }
                if (($status_id = $request->query('status_id'))) {
                    $filter->where('status_id', $status_id);
                }
                if (($field_id = $request->query('field_id'))) {
                    $filter->where('field_id', $field_id);
                }
                if (($dateQuery = $request->query('fromDate'))) {
                    $explodedDate = explode('/', $dateQuery); // 0 month, 1 day, 2 year
                    $date = Carbon::create($explodedDate[2], $explodedDate[0], $explodedDate[1])->toDateString();
                    $filter->whereDate('date', '>=', $date);
                }
                if (($dateQuery = $request->query('untilDate'))) {
                    $explodedDate = explode('/', $dateQuery); // 0 month, 1 day, 2 year
                    $untilDate = Carbon::create($explodedDate[2], $explodedDate[0], $explodedDate[1])->toDateString();
                    $filter->whereDate('date', '<=', $untilDate);
                }
                if ($name = $request->query('name')) {
                    $filter->where('name', 'like', "%$name%");
                }
            })
            ->editColumn('name', function (ParalegalCase $paralegalCase) {
                return $paralegalCase->name;
            })
            ->editColumn('area', function (ParalegalCase $paralegalCase) {
                return $paralegalCase->paralegal->area->code;
            })
            ->editColumn('paralegal', function (ParalegalCase $paralegalCase) {
                return $paralegalCase->paralegal->user->name;
            })
            ->editColumn('date', function (ParalegalCase $paralegalCase) {
                return $paralegalCase->date;
            })
            ->editColumn('status', function (ParalegalCase $paralegalCase) {
                return ParalegalCaseStatus::toBadge($paralegalCase->status_id);
            })
            ->editColumn('action', function (ParalegalCase $paralegalCase) {
                return '<a href="' . route('case.show', ['paralegalCase' => $paralegalCase->id]) . '" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Detail</a>';
            })
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ParalegalCase $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ParalegalCase $model)
    {
        $model = $model->newQuery();
        // if (!auth()->user()->isAdmin()) {
        //     $model->where('paralegal_id', auth()->user()->paralegal->id);
        // }

        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('paralegal-case-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => '',
                'data' => "function(d){
                            d.name = $('#name').val();
                            d.field_id = $('#field_id').val();
                            d.type_id = $('#type_id').val();
                            d.paralegal_id = $('#paralegal_id').val();
                            d.status_id = $('#status_id').val();
                            d.area_id = $('#area_id').val();
                            d.fromDate = $('#fromDate').val();
                            d.untilDate = $('#untilDate').val();
                        }"
            ])
            ->parameters([
                'pageLength' => 10,
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
                'initComplete' => " 
                            function() {
                                $('#paralegal-case-filter').on('submit', function(e) {
                                    window.LaravelDataTables['paralegal-case-table'].draw();
                                    e.preventDefault();
                                });

                                $('#reset-filter').click(function(e) {
                                    $('#paralegal_id').val('').trigger('change');
                                    $('#area_id').val('').trigger('change');
                                    $('#type_id').val('').trigger('change');
                                    $('#field_id').val('').trigger('change');
                                    $('#status_id').val('').trigger('change');
                                    $('#name').val('');
                                    $('#fromDate').val('');
                                    $('#untilDate').val('');
                                    $('#paralegal-case-filter').submit();
                                });
                            }
                        "
            ])
            ->dom(
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-8 text-right'B>>" .
                    "<'row'<'col-sm-12'tr>>" .
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name')
                ->title('Nama Kasus'),
            Column::make('area')
                ->title('Kode Area Kasus'),
            Column::make('paralegal')
                ->title('Paralegal'),
            Column::make('date')
                ->title('Tanggal'),
            Column::make('status')
                ->title('Tanggal'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ParalegalCase_' . date('YmdHis');
    }
}

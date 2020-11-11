<?php

namespace App\DataTables;

use \App\ParalegalCaseType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParalegalCaseTypeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function () {
                return '<button type="button" class="btn btn-sm btn-success mr-1"><i class="fas fa-eye"></button>';
            })
            ->editColumn('case_count', function (ParalegalCaseType $paralegalCaseType) {
                return $paralegalCaseType->name;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ParalegalCaseType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ParalegalCaseType $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('paralegal-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'pageLength' => 10,
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
            ])
            ->dom(
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-8 text-right'B>>" .
                    "<'row'<'col-sm-12'tr>>" .
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            )
            ->orderBy(0, 'asc')
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
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
            Column::make('id')->title('ID'),
            Column::make('name')->title('Nama Jenis'),
            Column::make('case_count')->title('Jumlah Kasus'),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ParalegalCaseType_' . date('YmdHis');
    }
}

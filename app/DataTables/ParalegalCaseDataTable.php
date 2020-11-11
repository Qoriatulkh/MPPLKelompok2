<?php

namespace App\DataTables;

use App\ParalegalCase;
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
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'paralegalcase.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ParalegalCase $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ParalegalCase $model)
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
            ->orderBy(1)
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
            Column::make('number')->title('Nomor Kasus'),
            Column::make('name')->title('Nama Kasus'),
            Column::make('area')->title('Area Kasus'),
            Column::make('paralegals')->title('Paralegal'),
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

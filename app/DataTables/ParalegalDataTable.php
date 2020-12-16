<?php

namespace App\DataTables;

use App\Paralegal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParalegalDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $no = 0;
        return datatables()
            ->eloquent($query)
            ->editColumn('no', function (Paralegal $paralegal) use ($no) {
                return ++$no;
            })
            ->editColumn('number', function (Paralegal $paralegal) {
                return $paralegal->number ?? '-';
            })
            ->editColumn('name', function (Paralegal $paralegal) {
                return $paralegal->user->name;
            })
            ->editColumn('sex', function (Paralegal $paralegal) {
                return $paralegal->sex == 'Male' ? 'Laki-Laki' : 'Perempuan';
            })
            ->editColumn('address', function (Paralegal $paralegal) {
                return $paralegal->address;
            })
            ->editColumn('status', function (Paralegal $paralegal) {
                return $paralegal->isApproved ? '<span class="badge badge-success">Disetujui</span>' : '<span class="badge badge-danger">Belum Disetujui</span>';
            })
            ->editColumn('action', function (Paralegal $paralegal) {
                return '<a href="' . route('paralegal.show', ['paralegal' => $paralegal->id]) . '" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Detail</a>';
            })
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Paralegal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Paralegal $model)
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
            ->orderBy(0)
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
            Column::make('no')
                ->orderable(false)
                ->title('No.'),
            Column::make('number')
                ->title('Nomor Paralegal'),
            Column::make('name')
                ->title('Nama')
                ->orderable(false),
            Column::make('sex')
                ->title('Jenis Kelamin'),
            Column::make('address')
                ->title('Alamat')
                ->orderable(false),
            Column::make('status')
                ->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Paralegal_' . date('YmdHis');
    }
}

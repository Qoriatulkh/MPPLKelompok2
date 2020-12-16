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
    protected $no;

    public function __construct()
    {
        $this->no = 0;
    }

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
            ->editColumn('no', function () {
                return ++$this->no;
            })
            ->editColumn('action', function (ParalegalCaseType $paralegalCaseType) {
                return '
                <form action="' . route('case.type.destroy', ['paralegalCaseType' => $paralegalCaseType->id]) . '" method="post" id="deleteCaseTypeForm-' . $paralegalCaseType->id . '" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                </form>
                <button type="button" class="btn btn-sm btn-danger mr-1" id="deleteCaseType.' . $paralegalCaseType->id . '.' . $paralegalCaseType->name . '"><i class="fas fa-trash"></i></button>
                ';
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
        return $model->newQuery()->withCount('cases');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('paralegal-case-type-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'pageLength' => 10,
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
                'initComplete' => "
                    function(){
                        $('#paralegal-case-type-table').on('click', '[id^=deleteCaseType]', function (e) {
                            e.preventDefault();
                            var id = this.id.split('.')[1];
                            var nama = this.id.split('.', 3)[2];
                            var form = $('#deleteCaseTypeForm-'+id);
                            Swal.fire({
                                title: 'Konfirmasi',
                                html: 'Anda yakin ingin menghapus jenis kasus <b>'+nama+'</b> ?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Hapus',
                                cancelButtonText: 'Batalkan'
                            }).then((result) => {
                                if (result.value) {
                                    form.submit();
                                }
                            })
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
            Column::make('no')->title('No.')->orderable(false),
            Column::make('name')->title('Nama Jenis'),
            Column::make('cases_count')->title('Jumlah Kasus'),
            Column::make('action')
                ->addClass('text-center')
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

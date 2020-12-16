<?php

namespace App\DataTables;

use \App\ParalegalCaseField;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParalegalCaseFieldDataTable extends DataTable
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
            // ->editColumn('case_count', function (ParalegalCaseField $paralegalCaseField) {
            //     return $paralegalCaseField->cases()->count();
            // })
            ->editColumn('action', function (ParalegalCaseField $paralegalCaseField) {
                return '
                <form action="' . route('case.field.destroy', ['paralegalCaseField' => $paralegalCaseField->id]) . '" method="post" id="deleteCaseFieldForm-' . $paralegalCaseField->id . '" style="display: none">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                </form>
                <button type="button" class="btn btn-sm btn-danger mr-1" id="deleteCaseField.' . $paralegalCaseField->id . '.' . $paralegalCaseField->name . '"><i class="fas fa-trash"></i></button>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ParalegalCaseField $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ParalegalCaseField $model)
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
            ->setTableId('paralegal-case-field-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'pageLength' => 10,
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
                'initComplete' => "
                    function(){
                        $('#paralegal-case-field-table').on('click', '[id^=deleteCaseField]', function (e) {
                            e.preventDefault();
                            var id = this.id.split('.')[1];
                            var nama = this.id.split('.', 3)[2];
                            var form = $('#deleteCaseFieldForm-'+id);
                            Swal.fire({
                                title: 'Konfirmasi',
                                html: 'Anda yakin ingin menghapus bidang kasus <b>'+nama+'</b> ?',
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
            Column::make('no')
                ->title('No.')
                ->orderable(false),
            Column::make('name')
                ->title('Nama'),
            Column::make('cases_count')
                ->title('Jumlah Kasus'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
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
        return 'ParalegalCaseField_' . date('YmdHis');
    }
}

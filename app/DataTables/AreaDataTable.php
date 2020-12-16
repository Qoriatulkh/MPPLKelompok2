<?php

namespace App\DataTables;

use \App\Area;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AreaDataTable extends DataTable
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
                if ($region_name = $request->query('region_name')) {
                    $filter->where('region_name', $region_name);
                }
                if (($province_name = $request->query('province_name'))) {
                    $filter->where('province_name', '=', $province_name);
                }
                if (($city_name = $request->query('city_name'))) {
                    $filter->where('city_name', '=', $city_name);
                }
                if (($district_name = $request->query('district_name'))) {
                    $filter->where('district_name', '=', $district_name);
                }
                if (($village_name = $request->query('village_name'))) {
                    $filter->where('village_name', '=', $village_name);
                }
                if ($code = $request->query('code')) {
                    $filter->where('code', 'like', "%$code%");
                }
            })
            ->editColumn('action', function (Area $area) {
                return '<a href="' . route('area.show', ['area' => $area->id]) . '" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Detail</a>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Area $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Area $model)
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
            ->setTableId('area-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => '',
                'data' => "function(d){
                            d.region_name = $('#region').val();
                            d.province_name = $('#province').val();
                            d.city_name = $('#city').val();
                            d.district_name = $('#district').val();
                            d.village_name = $('#village').val();
                            d.code = $('#code').val();
                        }"
            ])
            ->parameters([
                'pageLength' => 10,
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
                'initComplete' => " 
                            function() {
                                $('#area-filter').on('submit', function(e) {
                                    window.LaravelDataTables['area-table'].draw();
                                    e.preventDefault();
                                });

                                $('#reset-filter').click(function(e) {
                                    $('#region').val('').trigger('change');
                                    $('#province').val('').trigger('change');
                                    $('#city').val('').trigger('change');
                                    $('#district').val('').trigger('change');
                                    $('#village').val('').trigger('change');
                                    $('#code').val('');
                                    $('#area-filter').submit();
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
            Column::make('code')
                ->title('Kode'),
            Column::make('region_name')
                ->title('Region'),
            Column::make('province_name')
                ->title('Provinsi'),
            Column::make('city_name')
                ->title('Kota/Kabupaten'),
            Column::make('district_name')
                ->title('Kecamatan'),
            Column::make('village_name')
                ->title('Kelurahan/Desa'),
            Column::make('action')
                ->title('Aksi')
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Area_' . date('YmdHis');
    }
}

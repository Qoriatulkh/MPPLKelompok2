@extends('adminlte::page')

@section('title', 'Paralegal')

@section('content_header')
<h1 class="m-0 text-dark">Manajemen Paralegal</h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <button class="btn btn-primary btn-block mb-4" data-toggle="collapse" href="#collapseExample" type="button"
            aria-expanded="false" aria-controls="collapseExample">
            <i class="fas fa-search"></i> Filter
        </button>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form method="GET" id="paralegal-filter" role="form">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="area">Area</label>
                                <select class="form-control select2" name="area_id" id="area">
                                    <option value="">Semua</option>
                                    @foreach ($areas as $area)
                                    <option value="{{$area->id}}">
                                        {{ $area->code . ' - ' . $area->village_name . ', ' . $area->district_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="number">Nomor Paralegal</label>
                                <input type="text" class="form-control" id="number" name="number">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control select2" name="gender" id="gender">
                                    <option value="">Semua</option>
                                    <option value="Male">Laki - Laki</option>
                                    <option value="Female">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" id="search-button"><i
                                        class="fas fa-search"></i>
                                    Cari</button>
                                <button type="button" class="btn btn-secondary" id="reset-filter"><i
                                        class="fas fa-undo-alt"></i>
                                    Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header my-2">
                <h5>Daftar Paralegal</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-hover'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
{{$dataTable->scripts()}}

<script>
    $("#search-button").click(function(){
        $('#paralegal-filter').submit();
    });
</script>

@endpush
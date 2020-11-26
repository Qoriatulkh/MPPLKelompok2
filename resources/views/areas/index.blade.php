@extends('adminlte::page')

@section('title', 'Area')

@section('content_header')
<h1 class="m-0 text-dark">Manajemen Area</h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <button class="btn btn-primary btn-block mb-4" data-toggle="collapse" href="#collapseExample"
                    type="button" aria-expanded="false" aria-controls="collapseExample" id="paralegal-filter">
                    <i class="fas fa-search"></i> Filter
                </button>
            </div>
            <div class="col-6">
                <a class="btn btn-success btn-block mb-4" id="addAreaButton" href="{{route('area.create')}}">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form method="GET" id="paralegal-filter" role="form">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="region">Region</label>
                                <select class="form-control select2" name="region_code" id="region">
                                    <option value="">Semua</option>
                                    @foreach ($regions as $regionName)
                                    <option value="{{$regionName}}">{{$regionName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district">Kecamatan</label>
                                <select class="form-control select2" name="district_code" id="district">
                                    <option value="">Semua</option>
                                    @foreach ($districts as $districtName)
                                    <option value="{{$districtName}}">{{$districtName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="province">Provinsi</label>
                                <select class="form-control select2" name="province_code" id="province">
                                    <option value="">Semua</option>
                                    @foreach ($provinces as $provinceName)
                                    <option value="{{$provinceName}}">{{$provinceName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="village">Kelurahan / Desa</label>
                                <select class="form-control select2" name="village_code" id="village">
                                    <option value="">Semua</option>
                                    @foreach ($villages as $villageName)
                                    <option value="{{$villageName}}">{{$villageName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="city">Kota / Kabupaten</label>
                                <select class="form-control select2" name="city_code" id="city">
                                    <option value="">Semua</option>
                                    @foreach ($cities as $cityName)
                                    <option value="{{$cityName}}">{{$cityName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">Code</label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-right">
                                <button type="button" class="btn btn-primary" id="searchButton">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <button type="button" class="btn btn-secondary" id="reset-filter">
                                    <i class="fas fa-undo-alt"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table table-hover'], true) !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{{ $dataTable->scripts() }}

<script>
    $(window).keydown(function(event){
        if( (event.keyCode == 13) ) {
            event.preventDefault();
            return false;
        }
    });

    $("#searchButton").click(function(){
        $('#paralegal-filter').submit();
    });
</script>

@endpush
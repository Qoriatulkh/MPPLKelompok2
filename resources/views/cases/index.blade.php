@extends('adminlte::page')

@section('title', 'Kasus')

@section('content_header')
<h1 class="m-0 text-dark">Manajemen Kasus</h1>
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
                <form method="GET" role="form" id="paralegal-case-filter">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="name">Nama Kasus</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="description">Dari Tanggal</label>
                                <input class="form-control datepicker" data-provide="datepicker" type="text"
                                    name="fromDate" value="" id="fromDate">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="description">Sampai Tanggal</label>
                                <input class="form-control datepicker" data-provide="datepicker" type="text"
                                    name="untilDate" value="" id="untilDate">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="region">Area</label>
                                <select class="form-control select2" name="area_id" id="area_id">
                                    <option value="">Semua</option>
                                    @foreach ($areas as $area)
                                    <option value="{{$area->id}}">
                                        {{$area->code . " - " . $area->village_name . ', ' . $area->district_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="name">Paralegal</label>
                                <select class="form-control select2" name="paralegal_id" id="paralegal_id">
                                    <option value="">Semua</option>
                                    @foreach ($paralegals as $paralegal)
                                    <option value="{{$paralegal->id}}">
                                        {{ $paralegal->number . ' - ' . $paralegal->user->name}}
                                        {{ $paralegal->user->id == auth()->user()->id ? "(me)" : "" }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="type">Jenis</label>
                                <select class="form-control select2" name="type_id" id="type_id">
                                    <option value="">Semua</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="field">Status</label>
                                <select class="form-control select2" name="status_id" id="status_id">
                                    <option value="">Semua</option>
                                    @foreach ($statuses as $status)
                                    <option value="{{$status->id}}">{!! \App\ParalegalCaseStatus::toBadge($status->id)
                                        !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="field">Bidang</label>
                                <select class="form-control select2" name="field_id" id="field_id">
                                    <option value="">Semua</option>
                                    @foreach ($fields as $field)
                                    <option value="{{$field->id}}">{{$field->name}}</option>
                                    @endforeach
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
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-hover'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
    crossorigin="anonymous" />
@endpush

@push('js')

{{$dataTable->scripts()}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.datepicker').datepicker();
</script>

<script>
    $("#search-button").click(function(){
        $('#paralegal-case-filter').submit();
    });
</script>

@endpush
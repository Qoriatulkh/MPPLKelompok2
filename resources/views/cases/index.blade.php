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
                <form action="">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="number">Nomor Kasus</label>
                                <input type="text" class="form-control" id="number">
                            </div>
                            <div class="form-group">
                                <label for="region">Area</label>
                                <select class="form-control select2" name="region" id="region">
                                    <option value="">Semua</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="name">Nama Kasus</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="type">Jenis</label>
                                <select class="form-control select2" name="type" id="type">
                                    <option value="">Semua</option>
                                    @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="name">Paralegal</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="field">Bidang</label>
                                <select class="form-control select2" name="field" id="field">
                                    <option value="">Semua</option>
                                    @foreach ($fields as $field)
                                    <option value="{{$field->id}}">{{$field->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>
                                    Cari</button>
                                <button type="button" class="btn btn-secondary"><i class="fas fa-undo-alt"></i>
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

@push('js')
{{$dataTable->scripts()}}
@endpush
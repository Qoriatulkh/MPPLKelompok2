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
                <form action="">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="region">Region</label>
                                <select class="form-control select2" name="region" id="region">
                                    <option value="">Semua</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district">Kecamatan</label>
                                <select class="form-control select2" name="district" id="district">
                                    <option value="">Semua</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="number">Nomor Paralegal</label>
                                <input type="text" class="form-control" id="number">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="province">Provinsi</label>
                                <select class="form-control select2" name="province" id="province">
                                    <option value="">Semua</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="village">Kelurahan</label>
                                <select class="form-control select2" name="village" id="village">
                                    <option value="">Semua</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="city">Kota / Kabupaten</label>
                                <select class="form-control select2" name="city" id="city">
                                    <option value="">Semua</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">Jenis Kelamin</label>
                                <select class="form-control select2" name="city" id="city">
                                    <option value="">Semua</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
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
@endpush
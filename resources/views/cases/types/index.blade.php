@extends('adminlte::page')

@section('title', 'Jenis Kasus')

@section('content_header')
<h4 class="m-0 text-dark">Manajemen Jenis Kasus</h4>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <button class="btn btn-primary btn-block mb-4">
            <i class="fas fa-plus"></i> Tambah Baru
        </button>
    </div>
    <div class="col-12">
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
@endpush
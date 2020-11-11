@extends('adminlte::page')

@section('title', 'Bidang Kasus')

@section('content_header')
<h1 class="m-0 text-dark">Manajemen Bidang Kasus</h1>
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
@extends('adminlte::page')

@section('title', 'Bidang Kasus')

@section('content_header')
<h1 class="m-0 text-dark">Manajemen Bidang Kasus</h1>
<hr>
@stop

@section('content')

<div class="modal fade" id="addCaseFieldModal" tabindex="-1" role="dialog" aria-labelledby="addCaseFieldModalTitle"
    aria-hidden="true">
    <form action="{{ route('case.field.store') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Bidang Kasus </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                            placeholder="Masukkan nama bidang kasus" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-12">
        <button class="btn btn-primary btn-block mb-4" data-toggle="modal" data-target="#addCaseFieldModal">
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
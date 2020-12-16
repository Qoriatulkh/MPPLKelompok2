@extends('adminlte::page')

@section('title', 'Jenis Kasus')

@section('content_header')
<h4 class="m-0 text-dark">Manajemen Jenis Kasus</h4>
<hr>
@stop

@section('content')

<div class="modal fade" id="addCaseTypeModal" tabindex="-1" role="dialog" aria-labelledby="addCaseTypeModalTitle"
    aria-hidden="true">
    <form action="{{ route('case.type.store') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jenis Kasus </h5>
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
        <button class="btn btn-primary btn-block mb-4" data-toggle="modal" data-target="#addCaseTypeModal">
            <i class="fas fa-plus"></i> Tambah Baru
        </button>
    </div>
    <div class="col-12">
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
{{ $dataTable->scripts() }}
@endpush
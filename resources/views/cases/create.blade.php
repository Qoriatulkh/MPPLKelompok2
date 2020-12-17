@extends('adminlte::page')

@section('title', 'Tambah Kasus')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Kasus</h1>
<hr>
@stop

@section('content')

<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('case.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district_code">Nama Kasus</label>
                        <div class="input-group mb-3">
                            <input type="text" name="name"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ old('name') }}" placeholder="Masukkan nama kasus" autofocus>
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Tanggal</label>
                        <input class="form-control datepicker" data-provide="datepicker" type="text" name="date"
                            value="{{ $nowDate }}">
                    </div>
                </div>
                @if (auth()->user()->isAdmin())
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district_code">Paralegal</label>
                        <div class="input-group mb-3">
                            <select class="form-control select2 {{ $errors->has('paralegal_id') ? 'is-invalid' : '' }}"
                                id="sel1" name="paralegal_id">
                                <option disabled selected value="">Pilih Paralegal</option>
                                @foreach ($paralegals as $paralegal)
                                <option value="{{$paralegal->id}}">
                                    {{ $paralegal->number . ' - ' . $paralegal->user->name }}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('paralegal_id'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('paralegal_id') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <div class=" {{ auth()->user()->isAdmin() ? 'col-md-6' : 'col-12'}} ">
                    <div class="form-group">
                        <label for="district_code">Status Kasus</label>
                        <div class="input-group mb-3">
                            <select class="form-control select2 {{ $errors->has('status_id') ? 'is-invalid' : '' }}"
                                id="sel1" name="status_id">
                                <option disabled selected value="">Pilih Status</option>
                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}">
                                    {!! \App\ParalegalCaseStatus::toBadge($status->id) !!}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('status_id'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('status_id') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district_code">Jenis Kasus</label>
                        <div class="input-group mb-3">
                            <select class="form-control select2 {{ $errors->has('type_id') ? 'is-invalid' : '' }}"
                                id="sel1" name="type_id">
                                <option disabled selected value="">Pilih Jenis Kasus</option>
                                @foreach ($types as $type)
                                <option value="{{$type->id}}">
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('type_id'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('type_id') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district_code">Bidang Kasus</label>
                        <div class="input-group mb-3">
                            <select class="form-control select2 {{ $errors->has('field_id') ? 'is-invalid' : '' }}"
                                id="sel1" name="field_id">
                                <option disabled selected value="">Pilih Bidang Kasus</option>
                                @foreach ($fields as $field)
                                <option value="{{$field->id}}">
                                    {{ $field->name }}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('field_id'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('field_id') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control date" id="description" rows="3" name="description"
                            placeholder="Masukkan deskripsi kasus"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-block btn-primary">
                <span class="fas fa-file-medical"></span>
                Tambah
            </button>
        </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.datepicker').datepicker();
</script>
@endpush
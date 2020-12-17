@extends('adminlte::page')

@section('title', 'Kasus')

@section('content_header')
<h1 class="m-0 text-dark">Detail Kasus</h1>
<hr>
@stop

@section('content')

<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Status Kasus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('case.update', ['paralegalCase' => $paralegalCase->id])}}" id="updateStatusForm"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="district_code">Status Kasus</label>
                        <div class="input-group mb-3">
                            <select class="form-control select2 {{ $errors->has('status_id') ? 'is-invalid' : '' }}"
                                id="sel1" name="status_id">
                                <option disabled selected value="">Pilih Status</option>
                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}" @if ($status->id == $paralegalCase->status_id)
                                    {{ 'selected' }}
                                    @endif>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="updateStatusForm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5 class="font-weight-bolder">Status Kasus</h5>
        {!! \App\ParalegalCaseStatus::toBadge($paralegalCase->status_id) !!}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district_code">Nama Kasus</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $paralegalCase->name }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district_code">Tanggal Kasus</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $paralegalCase->date }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district_code">Jenis Kasus</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $paralegalCase->type->name }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district_code">Bidang Kasus</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $paralegalCase->field->name }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district_code">Paralegal</label> <span><a
                            href="{{ route('paralegal.show', ['paralegal' => $paralegalCase->paralegal_id]) }}"
                            class="btn btn-xs btn-primary px-2">
                            <i class="fas fa-eye"></i> Detail</a></span>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $paralegalCase->paralegal->user->name }}"
                            disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district_code">Area</label> <span><a
                            href="{{ route('area.show', ['area' => $paralegalCase->paralegal->area_id]) }}"
                            class="btn btn-xs btn-primary px-2">
                            <i class="fas fa-eye"></i> Detail</a></span>
                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control" value="" disabled>{{ $paralegalCase->paralegal->area->code . ' - ' . $paralegalCase->paralegal->area->village_name . ', ' . $paralegalCase->paralegal->area->district_name . ', ' . $paralegalCase->paralegal->area->city_name . ', ' . $paralegalCase->paralegal->area->province_name . ', ' . $paralegalCase->paralegal->area->region_name}}
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="district_code">Deskripsi</label>
                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control" value="" disabled>{{ $paralegalCase->desc }}
                        </textarea>
                    </div>
                </div>
            </div>
            <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#updateStatusModal">
                <i class="fas fa-edit"></i> Update Status
            </button>
        </div>
    </div>
</div>

@endsection

@push('css')

@endpush

@push('js')

@endpush
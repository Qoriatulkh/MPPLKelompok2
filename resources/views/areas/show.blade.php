@extends('adminlte::page')

@section('title', 'Area ' . $area->code)

@section('content_header')
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header mt-2">
                <h5>Area <b>{{ $area->code }}</b></h5>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="code">Kode Area</label>
                            <input type="text" class="form-control" id="code" name="code" readonly
                                value="{{ $area->code }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="region_name">Nama Region</label>
                            <input readonly type="text" class="form-control" id="region_name" name="region_name"
                                value="{{ $area->region_name }}">
                        </div>
                        <div class="form-group">
                            <label for="province_name">Nama Provinsi</label>
                            <input readonly type="text" class="form-control" id="province_name" name="province_name"
                                value="{{ $area->province_name }}">
                        </div>
                        <div class="form-group">
                            <label for="city_name">Nama Kota/Kabupaten</label>
                            <input readonly type="text" class="form-control" id="city_name" name="city_name"
                                value="{{ $area->city_name }}">
                        </div>
                        <div class="form-group">
                            <label for="district_name">Nama Kecamatan</label>
                            <input readonly type="text" class="form-control" id="district_name" name="district_name"
                                value="{{ $area->district_name }}">
                        </div>
                        <div class="form-group">
                            <label for="village_name">Nama Desa/Kelurahan</label>
                            <input readonly type="text" class="form-control" id="village_name" name="village_name"
                                value="{{ $area->village_name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="region_code">Kode Region</label>
                            <input readonly type="text" class="form-control" id="region_code" name="region_code"
                                value="{{ $area->region_code }}">
                        </div>
                        <div class="form-group">
                            <label for="province_code">Kode Provinsi</label>
                            <input readonly type="text" class="form-control" id="province_code" name="province_code"
                                value="{{ $area->province_code }}">
                        </div>
                        <div class="form-group">
                            <label for="city_code">Kode Kota/Kabupaten</label>
                            <input readonly type="text" class="form-control" id="city_code" name="city_code"
                                value="{{ $area->city_code }}">
                        </div>
                        <div class="form-group">
                            <label for="district_code">Kode Kecamatan</label>
                            <input readonly type="text" class="form-control" id="district_code" name="district_code"
                                value="{{ $area->district_code }}">
                        </div>
                        <div class="form-group">
                            <label for="village_code">Kode Kelurahan/Desa</label>
                            <input readonly type="text" class="form-control" id="village_code" name="village_code"
                                value="{{ $area->village_code }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-block btn-success" id="editButton" data-toggle="modal"
                    data-target="#editAreaModal">Edit</button>
                <form action="{{route('area.destroy', ['area' => $area->id])}}" id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <button class="btn btn-block btn-danger mt-3" id="deleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

@include('areas.editmodal')

@endsection

@push('js')
<script>
    function splitCode(){
        const valueBefore = $('#codeEdit').val();
        const splitted = valueBefore.split('.');
        console.log(splitted);
        const provinceCode = splitted[0];
        const cityCode = splitted[1];
        const districtCode = splitted[2];
        const villageCode = splitted[3];

        return {
            province: provinceCode,
            city: cityCode,
            district: districtCode,
            village: villageCode
        }
    }

    $('#province_code_edit').keyup(function() {
        const codeBefore = splitCode();
        $('#codeEdit').val($(this).val() + "." + codeBefore.city + "." + codeBefore.district + "." + codeBefore.village);
    });

    $('#city_code_edit').keyup(function() {
        const codeBefore = splitCode();
        $('#codeEdit').val(codeBefore.province + "." + $(this).val() + "." + codeBefore.district + "." + codeBefore.village);
    });

    $('#district_code_edit').change(function() {
        const codeBefore = splitCode();
        $('#codeEdit').val(codeBefore.province + "." + codeBefore.city + "." + $(this).val() + "." + codeBefore.village);
    });

    $('#village_code_edit').keyup(function() {
        const codeBefore = splitCode();
        $('#codeEdit').val(codeBefore.province + "." + codeBefore.city + "." + codeBefore.district + "." + $(this).val());
    });

    $('#deleteButton').click(function(){
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah anda yakin akan menghapus area ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#deleteForm").submit();
            }
        })
    });
</script>
@endpush
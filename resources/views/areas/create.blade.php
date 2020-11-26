@extends('adminlte::page')

@section('title', 'Tambah Area')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Area</h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @error('code')
                <div class="alert alert-danger text-center"><b>Perhatian!</b> {{ $message }}</div>
                @enderror
                <form action="{{route('area.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="code">Kode Area</label>
                                <input type="text" class="form-control" id="code" name="code" readonly
                                    value="{{ old('code') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_name">Nama Region</label>
                                <input required type="text" class="form-control" id="region_name"
                                    placeholder="Masukkan nama region" name="region_name"
                                    value="{{ old('region_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="province_name">Nama Provinsi</label>
                                <input required type="text" class="form-control" id="province_name"
                                    placeholder="Masukkan nama provinsi" name="province_name"
                                    value="{{ old('province_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="city_name">Nama Kota/Kabupaten</label>
                                <input required type="text" class="form-control" id="city_name"
                                    placeholder="Masukkan nama kota/kabupaten" name="city_name"
                                    value="{{ old('city_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="district_name">Nama Kecamatan</label>
                                <input required type="text" class="form-control" id="district_name"
                                    placeholder="Masukkan nama kecamatan" name="district_name"
                                    value="{{ old('district_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="village_name">Nama Desa/Kelurahan</label>
                                <input required type="text" class="form-control" id="village_name"
                                    placeholder="Masukkan nama desa/kelurahan" name="village_name"
                                    value="{{ old('village_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_code">Kode Region</label>
                                <input required type="text" class="form-control" id="region_code"
                                    placeholder="Masukkan kode region" name="region_code"
                                    value="{{ old('region_code') }}">
                            </div>
                            <div class="form-group">
                                <label for="province_code">Kode Provinsi</label>
                                <input required type="text" class="form-control" id="province_code"
                                    placeholder="Masukkan kode provinsi" name="province_code"
                                    value="{{ old('province_code') }}">
                            </div>
                            <div class="form-group">
                                <label for="city_code">Kode Kota/Kabupaten</label>
                                <input required type="text" class="form-control" id="city_code"
                                    placeholder="Masukkan kode kota/kabupaten" name="city_code"
                                    value="{{ old('city_code') }}">
                            </div>
                            <div class="form-group">
                                <label for="district_code">Kode Kecamatan</label>
                                <input required type="text" class="form-control" id="district_code"
                                    placeholder="Masukkan kode kecamatan" name="district_code"
                                    value="{{ old('district_code') }}">
                            </div>
                            <div class="form-group">
                                <label for="village_code">Kode Kelurahan/Desa</label>
                                <input required type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="village_code" placeholder="Masukkan kode kelurahan/desa" name="village_code"
                                    value="{{ old('village_code') }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function splitCode(){
        const valueBefore = $('#code').val();
        const splitted = valueBefore.split('.');
        const provinceCode = splitted[0];
        const cityCode = splitted[1];
        const districtCode = splitted[2];
        const villageCode = splitted[3];

        return {
            province: provinceCode ? provinceCode : "",
            city: cityCode ? cityCode : "",
            district: districtCode ? districtCode : "",
            village: villageCode ? villageCode : ""
        }
    }

    $('#province_code').keyup(function() {
        const codeBefore = splitCode();
        $('#code').val($(this).val() + "." + codeBefore.city + "." + codeBefore.district + "." + codeBefore.village);
    });

    $('#city_code').keyup(function() {
        const codeBefore = splitCode();
        $('#code').val(codeBefore.province + "." + $(this).val() + "." + codeBefore.district + "." + codeBefore.village);
    });

    $('#district_code').change(function() {
        const codeBefore = splitCode();
        $('#code').val(codeBefore.province + "." + codeBefore.city + "." + $(this).val() + "." + codeBefore.village);
    });

    $('#village_code').keyup(function() {
        const codeBefore = splitCode();
        $('#code').val(codeBefore.province + "." + codeBefore.city + "." + codeBefore.district + "." + $(this).val());
    });

</script>
@endpush
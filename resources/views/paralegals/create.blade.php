@extends('adminlte::page')

@section('title', 'Buat Akun Paralegal Baru')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Akun Paralegal</h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form action="{{ route('paralegal.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Name field --}}
                            <div class="form-group">
                                <label for="district_code">Nama</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        value="{{ old('name') }}" placeholder="Masukkan nama lengkap paralegal"
                                        autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Email field --}}
                            <div class="form-group">
                                <label for="district_code">Email</label>
                                <div class="input-group mb-3">
                                    <input type="email" name="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        value="{{ old('email') }}" placeholder="Masukkan email paralegal">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Phone number field --}}
                            <div class="form-group">
                                <label for="district_code">Nomor Handphone</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="phoneNumber"
                                        class="form-control {{ $errors->has('phoneNumber') ? 'is-invalid' : '' }}"
                                        value="{{ old('phoneNumber') }}" placeholder="Masukkan nomor telepon">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-phone{{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if($errors->has('phoneNumber'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('phoneNumber') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Gender field --}}
                            <div class="form-group">
                                <label for="district_code">Jenis Kelamin</label>
                                <div class="input-group mb-3">
                                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                        id="sel1" name="gender">
                                        <option disabled selected value="">Pilih jenis kelamin</option>
                                        <option value="Male">Laki-laki</option>
                                        <option value="Female">Perempuan</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-mars-double {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            {{-- Password field --}}
                            <div class="form-group">
                                <label for="district_code">Kata sandi</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password"
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                        placeholder="Masukkan kata sandi" value="{{ old('password') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Confirm password field --}}
                            <div class="form-group">
                                <label for="district_code">Konfirmasi kata sandi</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation"
                                        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                        placeholder="Ketik ulang kata sandi" value="{{ old('password_confirmation') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="district_code">Area</label>
                                <div class="input-group mb-3">
                                    <select
                                        class="form-control select2 {{ $errors->has('area_id') ? 'is-invalid' : '' }}"
                                        id="sel1" name="area_id">
                                        <option disabled selected value="">Pilih Area</option>
                                        @foreach ($areas as $area)
                                        <option value="{{$area->id}}">
                                            {{ $area->code . ' - ' . $area->village_name . ', ' . $area->district_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('area_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('area_id') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Address field --}}
                            <div class="form-group">
                                <label for="district_code">Alamat</label>
                                <div class="input-group mb-3">
                                    <textarea type="address" name="address"
                                        class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        placeholder="Masukkan alamat paralegal">{{ old('address') }}</textarea>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-map-marker {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                    @if($errors->has('address'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Register button --}}
                    <button type="submit"
                        class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-user-plus"></span>
                        Tambah
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
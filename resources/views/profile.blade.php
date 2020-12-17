@extends('adminlte::page')

@section('title', 'Profil')

@section('content_header')
<h1 class="m-0 text-dark">Profile</h1>
<hr>
@endsection

@section('content')

<div class="modal fade" id="updateImageModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('profile.photo.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="uploadImage"
                                aria-describedby="inputGroupFileAddon01" name="image">
                            <label class="custom-file-label" for="uploadImage">Pilih
                                Berkas</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <input type="hidden" name="kategori_administrasi" value="">
        </form>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                            placeholder="Masukkan nama anda" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Masukkan email anda" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat</label>
                        <textarea class="form-control" id="address" aria-describedby="addressHelp"
                            placeholder="Masukkan alamat anda" name="address">{{$user->paralegal->address}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="email">Jenis Kelamin</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="Male" {{ $user->paralegal->sex == 'Male' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="Female" {{ $user->paralegal->sex == 'Female' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Nomor Handphone</label>
                        <input type="number" class="form-control" id="phoneNumber"
                            placeholder="Masukkan nomor handphone anda" name="phoneNumber"
                            value="{{$user->paralegal->phoneNumber}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalTitle"
    aria-hidden="true">
    <form action="{{ route('profile.changePassword') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <input type="password" class="form-control" id="old_password" aria-describedby="emailHelp"
                            placeholder="Masukkan password lama anda" name="old_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" id="new_password"
                            aria-describedby="new_passwordHelp" placeholder="Masukkan password baru anda"
                            name="new_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            placeholder="Masukkan nomor handphone anda" name="new_password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>

@if (auth()->user()->isAdmin())
<div class="modal fade" id="approveUserModal" tabindex="-1" role="dialog" aria-labelledby="approveUserModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Penetapan Area Paralegal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="old_password">Pilih Area</label>
                    <select class="form-control select2" id="areaSelect" name="area_id">
                        <option value="" disabled selected>Pilih Area</option>
                        @foreach ($areas as $area)
                        <option value="{{$area->id}}">
                            {{ $area->code . ' - ' . "$area->village_name, $area->district_name, $area->city_name, $area->province_name, $area->region_name" }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="approveButton">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    @if (!$user->paralegal->isApproved)
    @if(!auth()->user()->isAdmin())
    <div class="col-12">
        <div class="alert alert-primary">
            <b class="font-weight-bolder">Perhatian! Akun anda belum disetujui.</b> Mohon tunggu persetujuan admin untuk
            bisa
            memasukkan kasus serta mendapatkan
            nomor paralegal dan area.
        </div>
    </div>
    @else
    <div class="col-12">
        <div class="alert alert-danger">
            <b class="font-weight-bolder">Perhatian!</b> Akun ini belum disetujui. Silahkan setujui atau tolak.
        </div>
    </div>
    @endif
    @endif

    <div class="col-md-4 text-center">
        <div class="card card-outline {{ $user->paralegal->isApproved ? 'card-primary' : '' }}">
            <div class="card-body">
                <a href="{{ $user->paralegal->photo_url ? asset('storage/' . $user->paralegal->photo_url) : asset('image/default-user-image.png') }}"
                    target="_blank">
                    <img src="{{ $user->paralegal->photo_url ? asset('storage/' . $user->paralegal->photo_url) : asset('image/default-user-image.png') }}"
                        alt="" class="img-fluid img-thumbnail w-100">
                </a>
                @if (!auth()->user()->isAdmin())
                <button class="btn btn-block btn-primary mt-3" data-toggle="modal" data-target="#updateImageModal"><i
                        class="fas fa-image"></i> Ganti Foto </button>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-outline {{ $user->paralegal->isApproved ? 'card-primary' : '' }}">
            @if (!auth()->user()->isAdmin())
            <div class="card-header text-right">
                @if ($user->paralegal->isApproved)
                <a class="btn btn-info" target="_blank" href="{{route('profile.nametag')}}">
                    <i class="fas fa-download"></i> Unduh Name Tag
                </a>
                @endif
                <button class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">
                    <i class="fas fa-key"></i> Ganti Password
                </button>
                <button class="btn btn-success" data-toggle="modal" data-target="#editModal">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <tr>
                            <td class="font-weight-bold">
                                Nomor Paralegal
                            </td>
                            <td>
                                {{ $user->paralegal->number }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Nama
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Email
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Area
                            </td>
                            <td>
                                {{ $user->paralegal->area_id ? $user->paralegal->area->village_name . ", " . $user->paralegal->area->district_name . ", "
                                .$user->paralegal->area->city_name . ", " .$user->paralegal->area->province_name . ", "
                                .$user->paralegal->area->region_name : '-'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Alamat
                            </td>
                            <td>
                                {{ $user->paralegal->address }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Nomor Handphone
                            </td>
                            <td>
                                {{ $user->paralegal->phoneNumber }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Jenis Kelamin
                            </td>
                            <td>
                                {{ $user->paralegal->sex == 'Male' ? 'Laki-Laki' : 'Perempuan' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Status
                            </td>
                            <td>
                                {!! $user->paralegal->isApproved ? '<span class="badge badge-success">Disetujui</span>'
                                : '<span class="badge badge-danger">Belum Disetujui</span>' !!}
                            </td>
                        </tr>
                        @if (auth()->user()->isAdmin())
                        <tr>
                            <td class="font-weight-bold">
                                Informasi Akun
                            </td>
                            <td>
                                {{ $user->information }}
                            </td>
                        </tr>
                        @endif
                    </table>

                </div>
                @if (auth()->user()->isAdmin() && !$user->paralegal->isApproved)
                <div class="row my-3">
                    <form action="{{route('paralegal.approve', ['paralegal' => $user->paralegal->id])}}" method="post"
                        style="display: none" id="approveUserForm">
                        @csrf
                    </form>
                    <div class="col-md-6">
                        <button class="btn btn-block btn-success mb-2" data-toggle="modal"
                            data-target="#approveUserModal">
                            <i class="fas fa-check"></i> Setujui
                        </button>
                    </div>
                    <form action="{{route('paralegal.disapprove', ['paralegal' => $user->paralegal->id])}}"
                        method="post" style="display: none" id="disapproveUserForm">
                        @csrf
                    </form>
                    <div class="col-md-6">
                        <button class="btn btn-block btn-danger" id="disapproveButton">
                            <i class="fas fa-times"></i> Tolak
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected text-dark").html(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            accordion = document.getElementById('accordion');
            accordion.style.display = "";

            preview = document.getElementById("previewImage");
            // get loaded data and render thumbnail.
            preview.src = e.target.result;
        };
        // read the image file as a data URL./
        reader.readAsDataURL(this.files[0]);
    });

    $('#approveButton').click(function(){
        var form = $('#approveUserForm');
        Swal.fire({
            title: 'Konfirmasi',
            html: "Apakah anda yakin akan menyetujui akun atas nama <b>{{ $user->name }}</b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Setujui'
        }).then((result) => {
            if (result.isConfirmed) {
                var areaId = $('#areaSelect').find(":selected").val();
                form.append(`<input typ="hidden" value="${areaId}" name="area_id">`)
                form.submit();
            }
        })
    });

    $('#disapproveButton').click(function(){
        var form = $('#disapproveUserForm');
        Swal.fire({
            title: 'Konfirmasi',
            html: "Apakah anda yakin akan menolak dan menghapus akun atas nama <b>{{ $user->name }}</b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#9c9c9c',
            confirmButtonText: 'Ya, Tolak dan Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
</script>
@endpush
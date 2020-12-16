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

<div class="row">
    @if (!$user->isApproved)
    <div class="col-12">
        <div class="alert alert-primary">
            <b class="font-weight-bolder">Perhatian! Akun anda belum disetujui.</b> Mohon tunggu persetujuan admin untuk
            bisa
            memasukkan kasus serta mendapatkan
            nomor paralegal dan area.
        </div>
    </div>
    @endif

    <div class="col-md-4 text-center">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <a href="{{ $user->paralegal->photo_url ? asset('storage/' . $user->paralegal->photo_url) : asset('image/default-user-image.png') }}"
                    target="_blank">
                    <img src="{{ $user->paralegal->photo_url ? asset('storage/' . $user->paralegal->photo_url) : asset('image/default-user-image.png') }}"
                        alt="" class="img-fluid img-thumbnail w-100">
                </a>
                <button class="btn btn-block btn-primary mt-3" data-toggle="modal" data-target="#updateImageModal"><i
                        class="fas fa-image"></i> Ganti Foto </button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal"><i
                        class="fas fa-key"></i>
                    Ganti Password</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i>
                    Edit</button>
            </div>
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
                                {{ $user->paralegal->area_id }}
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
                    </table>
                </div>
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
</script>
@endpush
<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $user->load('paralegal', 'paralegal.area');

        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $paralegal = $user->paralegal;

        // Users fields
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        $user->save();

        // Paralegals fields
        if ($request->address) {
            $paralegal->address = $request->address;
        }
        if ($request->gender) {
            $paralegal->sex = $request->gender;
        }
        if ($request->phoneNumber) {
            $paralegal->phoneNumber = $request->phoneNumber;
        }
        $paralegal->save();

        Alert::success("Berhasil", "Berhasil memperbarui profil anda");
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->old_password, $user->password)) {
            Alert::error('Gagal', "Password lama salah");
            return redirect()->back();
        }

        if ($request->new_password != $request->new_password_confirmation) {
            Alert::error('Gagal', "Konfirmasi password tidak sama");
            return redirect()->back();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Alert::success('Berhasil', "Berhasil memperbarui password");
        return redirect()->back();
    }

    public function photo()
    {
        // return Storage::download(auth()->user()->paralegal->photo_url)
    }

    public function uploadPhoto(Request $request)
    {
        $image = $request->file('image');
        $extension = $image->guessExtension();
        $user = auth()->user();

        if (!in_array($extension, ['png', 'jpg', 'jpeg'])) {
            Alert::error('Gagal', "Gambar hanya boleh berformat png, jpg, atau jpeg");
            return redirect()->back();
        }

        if ($user->paralegal->photo_url) {
            Storage::delete($user->paralegal->photo_url);
        }

        $fileName = uniqid() . "." . $extension;
        $fileUrl = $image->storeAs('/image/users', $fileName, 'public');

        $user->paralegal->photo_url = $fileUrl;
        $user->paralegal->save();

        Alert::success("Berhasil", "Berhasil memperbarui foto profil");
        return redirect()->back();
    }

    public function downloadNameTag()
    {
        $user = auth()->user();

        if (!$user->paralegal->photo_url) {
            Alert::error("Gagal", "Mohon upload foto profil terlebih dahulu");
            return redirect()->route('profile');
        }

        $img = Image::make(public_path('image/template-nametag.png'));
        $profile = Image::make(public_path('storage/' . $user->paralegal->photo_url));
        $profile->resize(336, 444);

        $img->insert($profile, 'top-left', 175, 337);
        $img->text($user->name, 338, 855, function ($font) {
            $font->file(public_path('fonts/Bebas-Regular.ttf'));
            $font->size(50);
            $font->color('#FFFFFF');
            $font->align('center');
        });
        $img->text($user->paralegal->number, 338, 935, function ($font) {
            $font->file(public_path('fonts/Bebas-Regular.ttf'));
            $font->size(40);
            $font->color('#FFFFFF');
            $font->align('center');
        });

        return $img->response('png');
    }
}

<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("users.index", compact('users'));
    }
    public function updateProfileOperator()
    {
        $user = User::where('username', auth()->user()->username)->first();
        return view("operator.user-profile", compact('user'));
    }
    public function store(Request $request)
    {
        $users = new User;
        $validator = Validator::make($request->all(), [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $email = user::where('email', $request->email)->first();
        $username = User::where('username', $request->username)->first();
        if ($username || $email) {
            if ($validator->fails()) {
                return back()->with('error', 'Email atau Username sudah Ada');
            }
        }
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalName();

            // Folder yang sesuai dengan nama users
            $folderName = strtolower(str_replace(' ', '_', $request->nama));
            if ($users->role_id == 1) {
                $file->storeAs("Admin/foto/{$folderName}", $fileName, 'public');
            } else {
                $file->storeAs("Operator/foto/{$folderName}", $fileName, 'public');
            }
            // Simpan nama file foto ke dalam database
            $users->create(['foto' => $folderName . '/' . $fileName]);
        }

        $users->nama = $request->nama;
        $users->nik = $request->nik;
        $users->tempat_lahir = $request->tempat_lahir;
        $users->tanggal_lahir = $request->tanggal_lahir;
        $users->jk = $request->jk;
        $users->no_hp = $request->no_hp;
        $users->email = $request->email;
        $users->username = $request->username;
        $users->role_id = $request->role_id;
        $users->password = $request->password;
        $users->save();

        toast('Berhasil Menambahkan Data 👌', 'success');
        return back();
    }
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:users',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required',
        ]);

        $email = user::where('email', $request->email)->where('id', '!=', $user_id)->first();
        $username = user::where('username', $request->username)->where('id', '!=', $user_id)->first();
        if ($username || $email) {
            if ($validator->fails()) {

                return back()->with('error', 'Email atau Username sudah Ada');
            }
        }
        // Periksa apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $file = $request->file('foto');
            $userName = $user->nama;
            $oldPhotoPath = $user->foto;

            if ($oldPhotoPath) {
                // Hapus foto lama dari penyimpanan
                Storage::disk('public')->delete($oldPhotoPath);
            }

            $fileName = time() . '_' . $userName . '.' . $file->getClientOriginalExtension();
            if ($user->role_id == 1) {
                $folderPath = 'Admin/foto/' . $userName;
            } else {
                $folderPath = 'Operator/foto/' . $userName;
            }
            $file->storeAs($folderPath, $fileName, 'public');

            // Simpan nama file foto baru ke dalam basis data
            $user->update(['foto' => $folderPath . '/' . $fileName]);
        }

        if ($request->password != null) {
            $user->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jk' => $request->jk,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'password' => $request->password,
            ]);
        } else {
            $user->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jk' => $request->jk,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
                'role_id' => $request->role_id,
            ]);
        }

        toast('Berhasil Update Data 👌', 'success')->timerProgressBar(true);
        return back();
    }
    public function destroy($users_id)
    {
        User::destroy($users_id);
        toast('Data berhasil dihapus 👌', 'success');
        return back();
    }

    public function deleteAll()
    {
        User::query()->truncate();
        toast('Data berhasil dihapus 👌', 'success');
        return back();
    }

    public function downloadTemplate()
    {
        $filePath = 'template-import-data/template-data-user.xlsx';
        $filename = 'template-data-user.xlsx';

        return response()->file(storage_path("app/public/{$filePath}"), [
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-online' . $user->id))
                echo $user->name . " is online. <br>";
            else
                echo $user->name . " is offline <br>";
        }
    }
}

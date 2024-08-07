<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\LevelModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Dashboard', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }
    
    public function list(Request $request)
    {
        $users = User::select('id_user', 'avatar', 'username', 'nama', 'email', 'kode_level')->with('level');

        if ($request->kode_level) {
            $users->where('kode_level', $request->kode_level);
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                $btn = '<a href="' . route('user.edit', $user->id_user) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen-to-square mr-2"></i>   Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. route('user.destroy', $user->id_user) .'">'.
                            csrf_field() . method_field('DELETE') .
                            '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');"><i class="fa-solid fa-trash"></i> Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create() 
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Dashboard', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah User Baru'
        ];

        $level = LevelModel::all();

        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_media' => 'mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|string|unique:user,email',
            'username' => 'required|string|min:3|unique:user,username',
            'nama' => 'required|string|max:50',
            'password' => 'required|min:8',
            'kode_level' => 'required|string'
        ],
        [
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email yang anda masukkan sudah terdaftar.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal memiliki panjang 3 karakter.',
            'username.unique' => 'Username yang anda masukkan sudah terdaftar.',
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama maksimal memiliki panjang 50 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal memiliki panjang 8 karakter.',
            'kode_level.required' => 'Level user harus diisi.',
            'news_media.mimes' => 'Ekstensi file harus JPG, JPEG, atau PNG',
            'news_media.max' => 'Terdapat file yang berukuran lebih dari 2 MB',
        ]);

        try {
            if(!$request->news_media) {
                User::create([
                    'avatar' => null,
                    'email' => $request->email,
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'password' => Hash::make($request->password),
                    'kode_level' => $request->kode_level
                ]);
            } else {
                $id = 1;

                if (User::exists()) {
                    $id += (User::max('id_user'));
                }
                
                $file = $request->file('news_media');

                $extension = $file->getClientOriginalExtension();

                $filename = time() . '.' . $extension;

                $path = "uploads/avatar/" . $id . "/";

                User::create([
                    'avatar' => $path.$filename,
                    'email' => $request->email,
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'password' => Hash::make($request->password),
                    'kode_level' => $request->kode_level,
                ]);

                $file->move($path, $filename);
            }

            return redirect(route('user.index'))->with('success', 'Data user berhasil disimpan');
        } catch (QueryException $e) {
            return redirect(route('user.index'))->with('success', 'Data user berhasil disimpan');
        }

    }

    public function edit($id) 
    {
        $user = User::find($id);

        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Dashboard', 'User', 'Edit']
        ];
    
        $page = (object) [
            'title' => 'Edit User'
        ];
    
        $activeMenu = 'user';
    
        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([    
            'news_media' => 'mimes:png,jpg,jpeg|max:2048',
            'email' => [
                'required',
                'string',
                Rule::unique('user', 'email')->ignore($id, 'id_user'),
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                Rule::unique('user', 'username')->ignore($id, 'id_user'),
            ],
            'nama' => 'required|string|max:50',
            'password' => 'nullable|string|min:8',
            'kode_level' => 'required|string',
        ],[
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email yang anda masukkan sudah terdaftar.',
            'username.required' => 'Username harus diisi.',
            'username.min' => 'Username minimal memiliki panjang 3 karakter.',
            'username.unique' => 'Username yang anda masukkan sudah terdaftar.',
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama maksimal memiliki panjang 50 karakter.',
            'password.min' => 'Password minimal memiliki panjang 8 karakter.',
            'kode_level.required' => 'Level user harus diisi.',
            'news_media.mimes' => 'Ekstensi file harus JPG, JPEG, atau PNG',
            'news_media.max' => 'Terdapat file yang berukuran lebih dari 2 MB',
        ]);

        try {
            if(!$request->news_media) {
                User::find($id)->update([
                    'email' => $request->email,
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'password' => $request->password ? Hash::make($request->password) : User::find($id)->password,
                    'kode_level' => $request->kode_level
                ]);
            } else {
                $file = $request->file('news_media');

                $extension = $file->getClientOriginalExtension();

                $filename = time() . '.' . $extension;

                $path = "uploads/avatar/" . $id . "/";

                if (File::exists(User::find($id)->avatar)) {
                    File::delete(User::find($id)->avatar);
                }
                
                User::find($id)->update([
                    'avatar' => $request->news_media ? $path.$filename : User::find($id)->avatar,
                    'email' => $request->email,
                    'username' => $request->username,
                    'nama' => $request->nama,
                    'password' => $request->password ? Hash::make($request->password) : User::find($id)->password,
                    'kode_level' => $request->kode_level
                ]);

                $file->move($path, $filename);
            }

            return redirect(route('user.edit', $id))->with('success', 'Data user berhasil diubah');
        } catch (QueryException $e) {
            return redirect(route('user.edit', $id))->with('error', 'Data user gagal diubah');
        }
    }

    public function destroy(String $id)
    {
        if (!User::find($id)) {
            return redirect(route('user.index'))->with('error', 'Data user tidak ditemukan');
        }

        try {
            if (File::exists(User::find($id)->avatar)) {
                File::delete(User::find($id)->avatar);
            }
    
            if (File::exists('uploads/avatar/' . $id)) {
                File::deleteDirectory('uploads/avatar/' . $id);
            }

            User::destroy($id);

            return redirect(route('user.index'))->with('success', 'Data user berhasil dihapus');
        } catch (QueryException $e) {
            return redirect(route('user.index'))->with('error', 'Data user gagal dihapus');
        }
    }

    public function destroyAvatar($id)
    {
        try {
            $user = User::find($id);

            if (File::exists($user->avatar)) {
                File::delete($user->avatar);
            }
    
            if (File::exists('uploads/avatar/' . $id)) {
                File::deleteDirectory('uploads/avatar/' . $id);
            }

            User::find($id)->update([
                'avatar' => null,
            ]);
    
            return redirect(route('user.edit', $id))->with('success', 'Avatar berhasil dihapus');
        } catch (QueryException $th) {
            return redirect(route('user.edit', $id))->with('error', 'Avatar gagal dihapus');
        }
    }
}

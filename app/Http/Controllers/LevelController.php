<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Dashboard', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar Level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $levels = LevelModel::select('id_level', 'kode_level', 'nama');

            return DataTables::of($levels)
                ->addIndexColumn()
                ->addColumn('aksi', function ($level) {
                    $btn = '<a href="'.url('/level/' . $level->id_level . '/edit').'" class="btn btn-warning btn-sm"><i class="fas fa-pen-to-square mr-2"></i>  Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="'. url('/level/'.$level->id_level).'">'.
                                csrf_field() . method_field('DELETE') .
                                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');"><i class="fa-solid fa-trash"></i> Hapus</button></form>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function create() 
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Dashboard', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Level Baru'
        ];

        $activeMenu = 'level';

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kode_level' => 'required|string|min:2|max:5|unique:level',
        ],
        [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama level maksimal memiliki panjang 100 karakter.',
            'kode_level.required' => 'kode_level level harus diisi.',
            'kode_level.min' => 'kode_level minimal memiliki panjang 2 karakter.',
            'kode_level.max' => 'kode_level level maksimal memiliki panjang 5 karakter.',
            'kode_level.unique' => 'kode_level level yang anda masukkan sudah terdaftar.',
        ]);

        try {
            LevelModel::create([
                'nama' => $request->nama,
                'kode_level' => $request->kode_level,
            ]);

            return redirect(route('level.index'))->with('success', 'Data level berhasil ditambahkan');
        } catch (QueryException $e) {
            return redirect(route('level.index'))->with('error', 'Data level gagal ditambahkan');
        }


    }

    public function edit($id) 
    {
        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Dashboard', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';
        
        $level = LevelModel::find($id);

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kode_level' => [
                'required',
                'string',
                'min:2',
                'max:5',
                Rule::unique('level', 'kode_level')->ignore($id, 'id_level'),
            ],
        ],
        [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama level maksimal memiliki panjang 100 karakter.',
            'kode_level.required' => 'kode_level level harus diisi.',
            'kode_level.min' => 'kode_level minimal memiliki panjang 2 karakter.',
            'kode_level.max' => 'kode_level level maksimal memiliki panjang 5 karakter.',
            'kode_level.unique' => 'kode_level level yang anda masukkan sudah terdaftar.',
        ]);

        try {
            LevelModel::find($id)->update([
                'nama' => $request->nama,
                'kode_level' => $request->kode_level,
            ]);
            
            return redirect(route('level.index'))->with('success', 'Data level berhasil diperbarui');
        } catch (QueryException $e) {
            return redirect(route('level.index'))->with('error', 'Data level gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        if (!LevelModel::find($id)) {
            return redirect(route('level.index'))->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);

            return redirect(route('level.index'))->with('success', 'Data level berhasil dihapus');
        } catch (QueryException $e) {
            return redirect(route('level.index'))->with('error', 'Data level gagal dihapus');
        }
    }
}

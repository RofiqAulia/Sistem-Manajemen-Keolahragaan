<?php

namespace App\Http\Controllers;

use App\Models\CaborModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CaborController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Cabor',
            'list' => ['Dashboard', 'Cabor']
        ];
    
        $page = (object) [
            'title' => 'Daftar berita yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'cabor'; // Define your $activeMenu variable
    
        // Pass all necessary variables to the view
        return view('cabor.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu, // Make sure $activeMenu is passed to the view
        ]);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $cabor = CaborModel::select('id_cabor', 'kode_cabor', 'nama');

            return DataTables::of($cabor)
                ->addIndexColumn()
                ->addColumn('aksi', function ($cabor) {
                    $btn = '<a href="'.url('/cabor/' . $cabor->id_cabor . '/edit').'" class="btn btn-warning btn-sm"><i class="fas fa-pen-to-square mr-2"></i>  Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="'. url('/Cabor/'.$cabor->id_cabor).'">'.
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
            'title' => 'Tambah Cabor',
            'list' => ['Dashboard', 'Cabor', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Cabor Baru'
        ];

        $activeMenu = 'cabor';

        return view('cabor.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_Cabor' => 'required|string|min:2|max:5|unique:Cabor',
            'nama' => 'required|string|max:30',
            'deskripsi' => 'required|string|max:30',
        ],
        [
            'kode_Cabor.required' => 'kode_Cabor Cabor harus diisi.',
            'kode_Cabor.min' => 'kode_Cabor minimal memiliki panjang 2 karakter.',
            'kode_Cabor.max' => 'kode_Cabor Cabor maksimal memiliki panjang 5 karakter.',
            'kode_Cabor.unique' => 'kode_Cabor Cabor yang anda masukkan sudah terdaftar.',
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama Cabor maksimal memiliki panjang 30 karakter.',
            'deskripsi.required' => 'Deskrispsi harus disisi',
            'deskripsi.max' => 'Deskrisp maximal panjang karakter 30 karakter',
        ]);

        try {
            CaborModel::create([
                'kode_Cabor' => $request->kode_Cabor,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect(route('cabor.index'))->with('success', 'Data Cabor berhasil ditambahkan');
        } catch (QueryException $e) {
            return redirect(route('cabor.index'))->with('error', 'Data Cabor gagal ditambahkan');
        }


    }

    public function edit($id) 
    {
        $breadcrumb = (object) [
            'title' => 'Edit Cabor',
            'list' => ['Dashboard', 'Cabor', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Cabor'
        ];

        $activeMenu = 'cabor';
        
        $cabor = CaborModel::find($id);

        return view('cabor.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'cabor' => $cabor, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_cabor' => [
                'required',
                'string',
                'min:2',
                'max:5',
                Rule::unique('cabor', 'kode_cabor')->ignore($id, 'id_cabor'),
            ],
            'nama' => 'required|string|max:30',
            'deskripsi' => 'required|string|max:30',
        ],
        [
            'kode_cabor.required' => 'kode_cabor cabor harus diisi.',
            'kode_cabor.min' => 'kode_cabor minimal memiliki panjang 2 karakter.',
            'kode_cabor.max' => 'kode_cabor cabor maksimal memiliki panjang 5 karakter.',
            'kode_cabor.unique' => 'kode_cabor cabor yang anda masukkan sudah terdaftar.',
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama cabor maksimal memiliki panjang 30 karakter.',
            'deskripsi.required' => 'Deskrispsi harus disisi',
            'deskripsi.max' => 'Deskrisp maximal panjang karakter 30 karakter',
            
        ]);

        try {
            CaborModel::find($id)->update([
                'kode_cabor' => $request->kode_cabor,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            
            return redirect(route('cabor.index'))->with('success', 'Data cabor berhasil diperbarui');
        } catch (QueryException $e) {
            return redirect(route('cabor.index'))->with('error', 'Data cabor gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        if (!CaborModel::find($id)) {
            return redirect(route('cabor.index'))->with('error', 'Data cabor tidak ditemukan');
        }

        try {
            CaborModel::destroy($id);

            return redirect(route('cabor.index'))->with('success', 'Data cabor berhasil dihapus');
        } catch (QueryException $e) {
            return redirect(route('cabor.index'))->with('error', 'Data cabor gagal dihapus');
        }
    }
}

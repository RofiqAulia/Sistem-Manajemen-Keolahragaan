<?php

namespace App\Http\Controllers;

use App\Models\AtletModel;
use App\Models\CaborModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AtletController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Atlet',
            'list' => ['Dashboard', 'Atlet']
        ];
    
        $page = (object) [
            'title' => 'Daftar berita yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'atlet'; // Define your $activeMenu variable
    
        // Pass all necessary variables to the view
        return view('atlet.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu, // Make sure $activeMenu is passed to the view
        ]);
    }
    


    public function list(Request $request)
    {
        $atlet = AtletModel::select('id_atlet','kode_cabor', 'nama','umur','alamat','no_hp');

        return DataTables::of($atlet)
            ->addIndexColumn()
            ->addColumn('aksi', function ($atlet) {
                $btn = '<a href="' . route('atlet.show',  $atlet->id_atlet) . '" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>   Detail</a> ';
                $btn .= '<a href="' . route('atlet.edit', $atlet->id_atlet) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen-to-square mr-2"></i>  Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. route('atlet.destroy', $atlet->id_atlet).'">'.
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
            'title' => 'Tambah atlet',
            'list' => ['Dashboard', 'atlet', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah atlet'
        ];

        $activeMenu = 'atlet';

        return view('atlet.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cabor' => 'required|string|max:30|unique:atlet,kode_cabor',
            'nama' => 'required|string|max:30',
            'umur' => 'required|integer',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:13',
        ],
        [
            'kode_cabor.required' => 'Kode cabor harus diisi.',
            'kode_cabor.unique' => 'Kode cabor yang anda masukkan sudah terdaftar.',
            'nama.required' => 'Nama atlet harus diisi.',
            'nama.max' => 'Maksimal panjang 30 karakter.',
            'umur.required' => 'Umur atlet harus diisi.',
            'umur.max' => 'Maksimal 2 karakter.',
            'alamat.required' => 'alamat news harus diisi.',
            'alamat.max' => 'Maksimal panjang 100 karakter.',
            'no_hp.required' => 'No handphone harus diisi.',
            'no_hp.max' => 'Maksimal panjang 13 karakter.'
        ]);
    
        try {
            $id = AtletModel::create([
                'kode_cabor' => $request->kode_cabor,
                'nama' => $request->nama,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ])->id_atlet;
        } catch (QueryException $e) {
            return redirect(route('atlet.index'))->with('error', 'Data atlet gagal ditambahkan');
        }

        if (!$request->cabor) {
            return redirect(route('atlet.index'))->with('success', 'Data atlet berhasil ditambahkan');
        }

        try {
            $this->storeMedia($request, $id);
            return redirect((route('atlet.index')))->with('success', 'Data atlet dan gambarnya berhasil ditambahkan');
        } catch (QueryException $e) {
            return redirect((route('atlet.index')))->with('warning', 'Data atlet berhasil ditambahkan');
        }
    }
    
    public function show(string $id)
    {
        $atlet = AtletModel::find($id);

        $cabor = CaborModel::where('id_atlet', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Detail atlet',
            'list' => ['Dashboard', 'atlet', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail atlet'
        ];

        $activeMenu = 'atlet';

        return view('atlet.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'atlet' => $atlet, 'cabor' => $cabor]);
    }

    public function edit(string $id)
    {
        $atlet = atletModel::find($id);
        
        $cabor = CaborModel::where('id_atlet', $id)->get();
        
        $breadcrumb = (object) [
            'title' => 'Edit atlet',
            'list' => ['Dashboard', 'atlet', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit atlet'
        ];

        $activeMenu = 'atlet';

        return view('atlet.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'atlet' => $atlet, 'cabor' => $cabor]);
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'kode_cabor' => [
                'required',
                'string',
                'max:30',
                Rule::unique('atlet', 'kode_cabor')->ignore($id, 'id_cabor'),
            ],
            'nama' => 'required|string|max:30',
            'umur' => 'required|integer|max:2',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:13'
        ],
        [
            'kode_cabor.required' => 'Kode cabor harus diisi.',
            'kode_cabor.unique' => 'Nama cabor yang anda masukkan sudah terdaftar.',
            'kode_cabor.max' => 'Maksimal panjang 30 karakter.',
            'nama.required' => 'Nama cabor harus diisi.',
            'nama.unique' => 'Nama cabor yang anda masukkan sudah terdaftar.',
            'nama.max' => 'Maksimal panjang 30 karakter.',
            'umur.unique' => 'umur cabor yang anda masukkan sudah terdaftar.',
            'umur.max' => 'Maksimal panjang 2 karakter.',
            'alamat.required' => 'Deskripsi atlet harus diisi.',
            'alamat.max' => 'Maksimal panjang 100 karakter.',
            'no_hp.required' => 'Deskripsi atlet harus diisi.',
            'no_hp.max' => 'Maksimal panjang 13 karakter.'
        ]);

        try {
            AtletModel::find($id)->update([
                'kode_cabor' => $request->kode_cabor,
                'nama' => $request->nama,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);
        } catch (QueryException $e) {
            return redirect(route('atlet.edit', $id))->with('error', 'Data atlet gagal diperbarui');
        }

        if (!$request->media) {
            return redirect(route('atlet.edit', $id))->with('success', 'Data atlet berhasil diperbarui');
        }

        // $fileCount = count($request->file('cabor'));

        // $mediaCount = NewsMediaModel::where('id_news', $id)->get()->count();

        // if ($fileCount > (5 - $mediaCount)) {
        //     return redirect(route('news.edit', $id))->with('error', 'Data gambar gagal ditambahkan, maksimal gambar yang dapat disimpan adalah 5. Coba untuk hapus gambar lain terlebih dahulu!');
        // }

        // try {
        //     $this->storeMedia($request, $id);
            
        //     return redirect(route('news.edit', $id))->with('success', 'Data news berhasil diperbarui dan data gambar berhasil ditambahkan');
        // } catch (QueryException $e) {
        //     return redirect(route('news.edit', $id))->with('error', 'Data news berhasil diperbarui, tetapi data gambar gagal ditambahkan');
        // }
    }

    public function destroy($id)
    {
        if (!AtletModel::find($id)) {
            return redirect(route('atlet.index'))->with('error', 'Data atlet tidak ditemukan');
        }
        
        $cabor = CaborModel::where('id_atlet', $id)->get();

        foreach ($cabor as $item) {
            if (File::exists($item->path)) {
                File::delete($item->path);
            }
    
            $item->delete();
        }

        if (File::exists('uploads/atlet/' . $id)) {
            File::deleteDirectory('uploads/atlet/' . $id);
        }

        try {
            AtletModel::destroy($id);
            return redirect(route('atlet.index'))->with('success', 'Data atlet berhasil dihapus');
        } catch (QueryException $e) {
            return redirect(route('atlet.index'))->with('error', 'Data atlet gagal dihapus');
        }
    }

    public function destroyMedia(int $id)
    {
        if (!CaborModel::find($id)) {
            return redirect()->back()->with('error', 'Data gambar tidak ditemukan');
        }

        $cabor = CaborModel::findOrFail($id);

        if (File::exists($cabor->path)) {
            File::delete($cabor->path);
        }

        try {
            CaborModel::destroy($id);
            return redirect()->back()->with('success', 'cabor berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'cabor gagal dihapus');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NewsModel;
use App\Models\NewsMediaModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Berita',
            'list' => ['Dashboard', 'Berita']
        ];
    
        $page = (object) [
            'title' => 'Daftar berita yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'news'; // Define your $activeMenu variable
    
        // Pass all necessary variables to the view
        return view('news.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu, // Make sure $activeMenu is passed to the view
        ]);
    }
    


    public function list(Request $request)
    {
        $news = NewsModel::select('id_news', 'nama', 'deskripsi');

        return DataTables::of($news)
            ->addIndexColumn()
            ->addColumn('aksi', function ($news) {
                $btn = '<a href="' . route('news.show',  $news->id_news) . '" class="btn btn-info btn-sm"><i class="fa-solid fa-circle-info"></i>   Detail</a> ';
                $btn .= '<a href="' . route('news.edit', $news->id_news) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen-to-square mr-2"></i>  Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. route('news.destroy', $news->id_news).'">'.
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
            'title' => 'Tambah news',
            'list' => ['Dashboard', 'news', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah news'
        ];

        $activeMenu = 'news';

        return view('news.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:30|unique:news,nama',
            'deskripsi' => 'required|string|max:1000',
        ],
        [
            'nama.required' => 'Nama news harus diisi.',
            'nama.unique' => 'Nama news yang anda masukkan sudah terdaftar.',
            'nama.max' => 'Maksimal panjang 20 karakter.',
            'deskripsi.required' => 'Deskripsi news harus diisi.',
            'deskripsi.max' => 'Maksimal panjang 1000 karakter.'
        ]);
    
        try {
            $id = NewsModel::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ])->id_news;
        } catch (QueryException $e) {
            return redirect(route('news.index'))->with('error', 'Data news gagal ditambahkan');
        }

        if (!$request->media) {
            return redirect(route('news.index'))->with('success', 'Data news berhasil ditambahkan');
        }

        try {
            $this->storeMedia($request, $id);
            return redirect((route('news.index')))->with('success', 'Data news dan gambarnya berhasil ditambahkan');
        } catch (QueryException $e) {
            return redirect((route('news.index')))->with('warning', 'Data news berhasil ditambahkan, tetapi gambar news gagal ditambahkan');
        }
    }
    
    public function show(string $id)
    {
        $news = NewsModel::find($id);

        $media = NewsMediaModel::where('id_news', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Detail news',
            'list' => ['Dashboard', 'news', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail news'
        ];

        $activeMenu = 'news';

        return view('news.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'news' => $news, 'media' => $media]);
    }

    public function edit(string $id)
    {
        $news = NewsModel::find($id);
        
        $media = NewsMediaModel::where('id_news', $id)->get();
        
        $breadcrumb = (object) [
            'title' => 'Edit news',
            'list' => ['Dashboard', 'news', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit news'
        ];

        $activeMenu = 'news';

        return view('news.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'news' => $news, 'media' => $media]);
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:30',
                Rule::unique('news', 'nama')->ignore($id, 'id_news'),
            ],
            'deskripsi' => 'required|string|max:1000'
        ],
        [
            'nama.required' => 'Nama news harus diisi.',
            'nama.unique' => 'Nama news yang anda masukkan sudah terdaftar.',
            'nama.max' => 'Maksimal panjang 20 karakter.',
            'deskripsi.required' => 'Deskripsi news harus diisi.',
            'deskripsi.max' => 'Maksimal panjang 1000 karakter.'
        ]);

        try {
            NewsModel::find($id)->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
        } catch (QueryException $e) {
            return redirect(route('news.edit', $id))->with('error', 'Data news gagal diperbarui');
        }

        if (!$request->media) {
            return redirect(route('news.edit', $id))->with('success', 'Data news berhasil diperbarui');
        }

        $fileCount = count($request->file('media'));

        $mediaCount = NewsMediaModel::where('id_news', $id)->get()->count();

        if ($fileCount > (5 - $mediaCount)) {
            return redirect(route('news.edit', $id))->with('error', 'Data gambar gagal ditambahkan, maksimal gambar yang dapat disimpan adalah 5. Coba untuk hapus gambar lain terlebih dahulu!');
        }

        try {
            $this->storeMedia($request, $id);
            
            return redirect(route('news.edit', $id))->with('success', 'Data news berhasil diperbarui dan data gambar berhasil ditambahkan');
        } catch (QueryException $e) {
            return redirect(route('news.edit', $id))->with('error', 'Data news berhasil diperbarui, tetapi data gambar gagal ditambahkan');
        }
    }

    public function destroy($id)
    {
        if (!NewsModel::find($id)) {
            return redirect(route('news.index'))->with('error', 'Data news tidak ditemukan');
        }
        
        $media = NewsMediaModel::where('id_news', $id)->get();

        foreach ($media as $item) {
            if (File::exists($item->path)) {
                File::delete($item->path);
            }
    
            $item->delete();
        }

        if (File::exists('uploads/news/' . $id)) {
            File::deleteDirectory('uploads/news/' . $id);
        }

        try {
            NewsModel::destroy($id);
            return redirect(route('news.index'))->with('success', 'Data news berhasil dihapus');
        } catch (QueryException $e) {
            return redirect(route('news.index'))->with('error', 'Data news gagal dihapus');
        }
    }

    public function destroyMedia(int $id)
    {
        if (!NewsMediaModel::find($id)) {
            return redirect()->back()->with('error', 'Data gambar tidak ditemukan');
        }

        $media = NewsMediaModel::findOrFail($id);

        if (File::exists($media->path)) {
            File::delete($media->path);
        }

        try {
            NewsMediaModel::destroy($id);
            return redirect()->back()->with('success', 'Gambar berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gambar gagal dihapus');
        }
    }

    private function storeMedia(Request $request, $id) {
        $news = NewsModel::findOrFail($id);

        $mediaData = [];

        if ($files = $request->file('media')) {
            foreach($files as $key => $file){

                $extension = $file->getClientOriginalExtension();

                $filename = $key . time() . '.' . $extension;

                $path = "uploads/news/" . $news->id_news . "/";

                $file->move($path, $filename);

                $mediaData[] = [
                    'id_news' => $news->id_news,
                    'path' => $path.$filename,
                ];
            }
        }

        NewsMediaModel::insert($mediaData);
    }
}

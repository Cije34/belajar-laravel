<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{


     public function index(Request $request){ //menampilkan data

        $judul = $request->judul;
        $article = Article::where('judul','LIKE','%'.$judul.'%')->orderBy('id','desc')->simplePaginate(10);
       // return $article;
        return view("article" , ["article"=> $article, "judul" => $judul]);
    }

    public function show(Request $request, $id){
        $judul = $request->judul;
        $article = Article::with('comments', 'tags','image','author')->where('id', $id)->first();
        // return $article;
        if(!$article){
            abort(404);
        }
        return view('single', ['article' => $article,'judul' => $judul]);

    }

    public function write(){
        $tag = Tag::all();
        // return $tag;
        return view('write',['tag' => $tag]);
    }

    public function store (Request $request){
    // Validasi input
    $validate = $request->validate([
        'judul' => 'required|unique:articles,judul',
        'content' => 'required',
        'tags' => 'array',
        'tags.*' => 'exists:tags,id', // Validasi untuk memastikan setiap tag yang dipilih ada di database
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk gambar
        // 'author_id' => 'required|exists:users,id', // Validasi untuk author_id

    ]);

    // return $validate ;
    // Buat artikel terlebih dahulu
    $article = Article::create([
        'judul' => $validate['judul'],
        'content' => $validate['content'],
        'author_id' => Auth::id(), // Menambahkan author_id
    ]);



    // Handle image upload SETELAH artikel dibuat
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');

        // Buat relasi image setelah artikel tersimpan
        $article->image()->create([
            'url' => $imagePath,
            'imageable_id' => $article->id,
            'imageable_type' => Article::class
        ]);
    }

    // Attach tags (jika ada)
    if ($request->has('tags')) {
        $article->tags()->attach($request->tags);
    }
        return redirect()->route('article')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id){
        $article = Article::with('tags','image')->find($id);
        $tag = Tag::all();
        // return ['article' => $article, 'tag' => $tag];
        // return $article;
        if(!$article){
            abort(404);
        }
        return view('edit', ['article' => $article, 'tag' => $tag]);
    }

    public function update(Request $request, $id){
        $article = Article::findorFail($id);
        $Validate = $request->validate([
            'judul' => 'required|unique:articles,judul,'.$article->id,
            'content' => 'required',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id', // Validasi untuk memastikan setiap tag yang dipilih ada di database
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk gambar
        ]);

        $article->tags()->sync($request->tags); // Sync selected tags with the article
        $article->update($Validate);
        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::disk('public')->delete($article->image->url);
                $article->image->delete();
            }
            // Simpan gambar baru
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');

            $article->image()->updateOrCreate([
                'url' => $imagePath,
                'imageable_id' => $article->id,
                'imageable_type' => Article::class
            ]);

        return redirect()->route('article')->with('success', 'Artikel berhasil diupdate');
        }
    }

    public function delete($id){
        $article = Article::find($id);
        if(!$article){
            abort(404);
        }
        $article->delete();
        return redirect()->route('article')->with('success', 'Artikel berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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
        $article = Article::with('comments', 'tags')->where('id', $id)->first();
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
        // return $request->all();
        $Validate = $request->validate([
            'judul' => 'required|unique:articles,judul',
            'content' => 'required'
        ]);

        $article = Article::create($Validate);
        $article->tags()->attach($request->tags); // Attach selected tags to the article
        return redirect()->route('article')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id){
        $article = Article::with('tags')->find($id);
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
            'content' => 'required'
        ]);

        $article->tags()->sync($request->tags); // Sync selected tags with the article
        $article->update($Validate);

        return redirect()->route('article')->with('success', 'Artikel berhasil diupdate');
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

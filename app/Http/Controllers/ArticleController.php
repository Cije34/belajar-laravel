<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ArticleController extends Controller
{
     public function index(Request $request){
        $judul = $request->judul;
        $article = Article::where('judul','LIKE','%'.$judul.'%')->simplePaginate(10);
        // return $article;
        return view("article" , ["article"=> $article, "judul" => $judul ]);


    }
    public function show(Request $request, $id){
        $judul = $request->judul;
        $article = Article::where('id', $id)->first();
        if(!$article){
            abort(404);
        }
        return view('single', ['article' => $article,'judul' => $judul]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        //validate
        $validatedData = $request->validate([
            'title' => 'bail|required|alpha|min:6|max:10',
        ]);

        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function destroy(Article $article)
    {
        try {
            $article->delete();
        } catch (\Exception $e) {
        }

        return response()->json(null, 204);
    }
}

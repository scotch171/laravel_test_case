<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ArticlesController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('articles/index');
    }

    public function show(int $id)
    {
        $article = Article::whereId($id)->first();

        $json = json_encode([
            'header' => $article->header,
            'text' => $article->text,
            'likes' => $article->likes,
            'view' => $article->view,
        ]);

        return view('articles/show', compact('article', 'json'));
    }
}

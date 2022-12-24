<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class MainController extends Controller
{
    public function index()
    {
        $articles = DB::table('articles')->get();

        return view('main', compact('articles'));
    }
}

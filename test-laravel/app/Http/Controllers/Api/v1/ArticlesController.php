<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\ArticleAction;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticlesController extends Controller
{
    private const L_INCREMENT = 'like-increment';
    private const L_DECRIMENT = 'like-decrement';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = DB::table('articles')->orderBy('created_at')->paginate($request->get('count'));

        if (!$articles) {
            return response([
                'status' => false,
            ], 404);
        } else {
            return response(
                $articles
            , 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $article = Article::whereId($id)->first();

        $article->increment('view');

        return response([
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function changeLikes(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response();
    }


    /**
     * @param Request $request
     * @param int $id
     */
    public function action(Request $request, int $id)
    {
        $action = $request->get('action');

        /** @var Article $article */
        $article = Article::whereId($id)->first();

        switch ($action) {
            case self::L_INCREMENT:
                $article->likes++;
                break;
            case self::L_DECRIMENT:
                $article->likes--;
                break;
        }

        event(new ArticleAction($id, $article->likes));
        $article->save();

        return '';
    }
}

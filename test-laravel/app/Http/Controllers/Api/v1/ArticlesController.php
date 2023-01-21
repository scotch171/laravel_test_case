<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\ArticleAction;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    private const L_INCREMENT = 'like-increment';
    private const L_DECRIMENT = 'like-decrement';
    private const V_INCREMENT = 'view-increment';

    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
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
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function action(Request $request, int $id): Response
    {
        $action = $request->get('action');

        /** @var Article $article */
        $article = Article::whereId($id)->first();
        $response = [];

        switch ($action) {
            case self::L_INCREMENT:
                $article->likes++;
                break;
            case self::L_DECRIMENT:
                $article->likes--;
                break;
            case self::V_INCREMENT:
                $response['view']= ++$article->view;
        }

        if (in_array($action, [self::L_INCREMENT, self::L_DECRIMENT], true)) {
            event(new ArticleAction($id, $article->likes));
        }

        $article->save();

        return response($response);
    }

    public function getTags(int $id): Response|Application|ResponseFactory
    {
        return response(Article::whereId($id)->first()->getTags());
    }

    public function getComments(int $id): Response|Application|ResponseFactory
    {
        return response(Article::whereId($id)->first()->comments);
    }

}

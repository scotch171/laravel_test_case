<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Jobs\CreateCommentJob;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        CreateCommentJob::dispatch(
            (int)$request->get('articleId'),
            $request->get('userName'),
            $request->get('text'),
        )->onQueue('add-comment');

        return response([]);
    }

}

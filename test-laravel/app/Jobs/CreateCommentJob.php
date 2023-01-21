<?php

namespace App\Jobs;

use App\Models\ArticleComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $articleId;
    protected string $userName;
    protected string $text;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        int $articleId,
        string $userName,
        string $text
    ){
        $this->articleId = $articleId;
        $this->userName = $userName;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = new ArticleComment([
            'article_id' => $this->articleId,
            'user_name' => $this->userName,
            'text' => $this->text
        ]);

        $comment->save();
    }
}

<?php

namespace App\Events;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ArticleAction implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $articleId;
    public int $likes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function  __construct(int $articleId, int $likes)
    {
        $this->articleId = $articleId;
        $this->likes = $likes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('article-chanel.' . $this->articleId);
    }

    public function join()
    {
        return true;

    }

}

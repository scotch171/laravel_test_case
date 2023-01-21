<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $article_id
 * @property string $user_name
 * @property string $text
 */
class ArticleComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id', 'user_name', 'text'
    ];
}

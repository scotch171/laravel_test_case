<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $header
 * @property string $text
 * @property int $view
 * @property int $likes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property ArticleTagReference[] $articleTagReference
 * @property ArticleComment[] $comments
 * @method static ArticleFactory factory(...$parameters)
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereHeader($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereLikes($value)
 * @method static Builder|Article whereText($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @method static Builder|Article whereView($value)
 * @mixin Eloquent
 */
class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $attributes = [
        'likes' => 0,
        'view' => 0,
    ];

    protected $fillable = [
        'likes',
        'viewes',
    ];

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function articleTagReference(): HasMany
    {
        return $this->hasMany(ArticleTagReference::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class);
    }

    public function getTags(): array
    {
        $result = [];

        foreach ($this->articleTagReference as $articleTagReference) {
            $result[] = $articleTagReference->tag;
        }

        return $result;
    }
}

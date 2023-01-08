<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property ArticleTagReference[] $articleTagReference
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    public $timestamps = false;


    public function articleTagReference(): HasMany
    {
        return $this->hasMany(ArticleTagReference::class);
    }
}

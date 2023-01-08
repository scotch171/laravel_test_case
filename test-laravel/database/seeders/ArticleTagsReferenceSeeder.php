<?php

namespace Database\Seeders;

use App\Models\ArticleTagReference;
use Illuminate\Database\Seeder;

class ArticleTagsReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleTagReference::factory()->count(50)->create();
    }
}

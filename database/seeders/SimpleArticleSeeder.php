<?php

namespace Freebizbot\SimpleArticles\database\seeders;

use Illuminate\Database\Seeder;
use Freebizbot\SimpleArticles\Models\Article;

class SimpleArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create(['slug'=>'one','title'=>'one','content' => 'Article 1 Content']);
        Article::create(['slug'=>'two','title'=>'two','content' => 'Article 2 Content']);
    }
}

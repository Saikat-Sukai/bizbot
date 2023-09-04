<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Module;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Module::create([
//            'slug'=>'freebizbot/wordpress-manager',
//            'title'=>'Wordpress Manager',
//            'constructor'=>'\Freebizbot\WordpressManager\WordpressManager',
//            'tables_controlled'=> ['wp_posts', 'wp_postmeta', 'wp_comments', 'wp_options', 'wp_users'],
//            'functions_contained'=> [
//                'suggest_topics' => ['description' => 'Suggest topics to write on based on existing topics, gaps, SEO value, etc.', 'params'=> ['mandatory'=>[], 'optional'=> ['title'] ]   ],
//                'suggest_seo_strategy' => ['description' => 'Suggest SEO strategy for the entire website', 'params'=> ['mandatory'=>[], 'optional'=> [] ]   ],
//                'create_wordpress_post' => ['description' => 'Creates a post in wordpress', 'params'=> ['mandatory'=>['post_title','post_content','post_excerpt','post_name','guid'], 'optional'=> [] ]   ],
//                'update_wordpress_post' => ['description' => 'Updates a post in wordpress', 'params'=> ['mandatory'=>['post_id'], 'optional'=> ['post_title','post_content','post_excerpt','post_name','guid'] ]   ],
//                'search_wordpress_posts' => ['description' => 'Searches for posts in wordpress', 'params'=> ['mandatory'=>['keyword'], 'optional'=> [] ]   ],
//                'create_wordpress_page' => ['description' => 'Creates a page in wordpress', 'params'=> ['mandatory'=>['page_title','page_content','page_excerpt','page_name','guid'], 'optional'=> [] ]   ],
//                'upload_wordpress_image' => ['description' => 'Uploads an image in wordpress', 'params'=> ['mandatory'=>['image_url'], 'optional'=> [] ]   ],
//                'show_wordpress_comments' => ['description' => 'Shows all comments in wordpress', 'params'=> ['mandatory'=>[], 'optional'=> [] ]   ],
//                'show_wordpress_plugins' => ['description' => 'Shows all plugins in wordpress', 'params'=> ['mandatory'=>[], 'optional'=> [] ]   ],
//                'create_wordpress_user' => ['description' => 'Creates a user in wordpress', 'params'=> ['mandatory'=>['user_login','user_pass','user_email'], 'optional'=> [] ]   ],
//                'show_wordpress_menu' => ['description' => 'Shows the menu management', 'params'=> ['mandatory'=>['menu_name'], 'optional'=> [] ]   ],
//                'do_wordpress_seo' => ['description' => 'Do SEO for the entire website', 'params'=> ['mandatory'=>[], 'optional'=> [] ]   ],
//                'do_wordpress_page_seo' => ['description' => 'Does SEO for a page in a wordpress website', 'params'=> ['mandatory'=>['page_id'], 'optional'=> [] ]   ],
//                'do_wordpress_post_seo' => ['description' => 'Does SEO for a post in a wordpress website', 'params'=> ['mandatory'=>['post_id'], 'optional'=> [] ]   ],
//            ],
//        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\Request;
use Log;

class InstructionsController extends Controller
{
    public function processInstruction(Request $request)
    {
        // gets message from the view
        $message = $request->message;

        $key = Key::where('slug','bizbot')->first();

        // passes it onto the BizBot Decisions API
        $data = \Http::withToken($key->value)->post('https://bizbot.site/api/decisions', [
            'message' => $message,
        ]);

//        Log::info('Data we recieved is: ');
//        Log::info($data);
        // gets back the [moduleToCall, functionToCall, params] data
        $module_slug = $data['moduleToCall'];
        if($module_slug!="none") {
            $moduleDef = \App\Models\Module::where('slug',$module_slug)->first();
            if($moduleDef){
                // calls the function in the module with the data
                $function = $data['functionToCall'];
                $params = $data['params'];
                $module = new $moduleDef->constructor();
                return $module->call($function,$params);

//                $wp = new \Freebizbot\WordpressManager\WordpressManager();
//
//                $params = [ 'post_title' => 'POst Title', 'post_content' => 'Post Content',
//                    'post_excerpt' => 'Post Excerpt', 'post_name' => 'Post Name', 'guid' => '5' ];
//
//                return $wp->call('create_wordpress_post',$params);

            }
        }



        // parses the output of the function to return the resultView, resultData, resultText etc. data back to App.vue
    }
}

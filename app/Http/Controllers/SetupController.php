<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Key;
use App\Models\Knowledgebase;
use App\Models\Module;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function initiateSetup()
    {
        $user = auth()->user();

        $k = Key::where('slug', 'language')->first();
        if(!$k){ $stepToGo = 1; }
        else{
            $k2 = Knowledgebase::where('about', 'business')->first();
            if(!$k2){ $stepToGo = 2; }
            else{
                $k3 = Key::where('slug','bizbot')->first();
                if(!$k3){
                    // user has not completed setup
                    $stepToGo = 3;
                }else{
                    $k4 = Key::where('slug','openai')->first();
                    // user has completed setup
                    if(!$k4) {
                        $stepToGo = 4; // openai setup
                    }else{

                        $bm = \App\Models\Knowledgebase::where('about','business_model')->first();
//                        if(!$bm){
                            $stepToGo = 5; // business model setup
//                        }else{
//                            $stepToGo = 6; // module selection
//                        }

                    }

                }
            }
        }
        return [
            "appState" => ['disabled'=>true],
            "messageText" => "Hi {$user->name}, I am <b>BizBot</b>, your AI Business Assistant. Can you please go through the setup questions and help me get started?",
            "messageView" => 'links',
            "messageData" => [
                "links"=>[
                    [ 'name'=> 'How does BizBot work?', 'icon' => 'PlayIcon', 'href'=> 'https://www.youtube.com/watch?v=qQ_W1w9v-2Y', 'bgColor' => 'bg-red-600' ],
                ]
//                "title"=>"Setup Process Requested",
//                "message"=>"Can you please go through the setup questions and help me get started?"
            ],
            "resultView"=>"setupForm",
            "dataToAction"=>[ "step"=>$stepToGo ],
        ];
    }

    public function index()
    {
        // One by one, we will ask questions from the user to understand the business
        // we will create a business model for the user.

        // First, ask them to select Language. then ask their name and name of the business
        // Next, introduce the user to BizBot and help them create an account so that we can assist them with various resources at our disposal like gig workers, timeshared employees, updates, new features, etc.
        // Next, assist them in creating an openai account and store the key locally and with BizBot account

        // Understand their business model in detail:
        // Select the closest simile of what they do, what industry.
        // Download the business model knowledgebase BMKbase.
        // Do: Now keep asking questions and learning.
            // Suggest modules to implement common business model patterns. Go through setup of each module and create the modules knowledgebase MoKbase.
            // Discuss and Seteup automatic tasks based on BMKbase and MoKbase.
            // Understand contact preferences and setup notifications accordingly.
        // While: Compare that with the industry and suggest them the best practices of the industry, and understand how they do things differently. ask why and keep evolving the BMKbase until you are fairly confident.

        // Newsletter for their industry, which will teach them the tricks of how their trade is evolving and how they can stay ahead of the curve.
    }

    public function actions(Request $request)
    {
        if($request->dataFromAction['action'] == "goto"){
            return [
                'resultView'=>'setupForm',
                'dataToAction'=>[ 'step'=>$request->dataFromAction['step'] ]
            ];
        }

        if($request->dataFromAction['action'] == "submit") {
            if ($request->dataToAction['step'] == 1) {

                // save business language preferences
                Key::updateOrCreate(['slug' => 'language'], ['value' => ($request->dataFromAction['language'] ?? 'en')]);
                return [
                    'resultView' => 'setupForm',
                    'dataToAction' => ['step' => 2],
                    'notification' => ['type' => 'success', 'title' => 'Language saved successfully']
                ];
            }
            if ($request->dataToAction['step'] == 2) {
                // save preferences of language. it should be user-based preference, but right now it is a business-level setting
                $k = Knowledgebase::where('about', 'business')->first();
                if (!$k) {
                    Knowledgebase::create(['about' => 'business', 'data' => ['name' => ($request->dataFromAction['business'])]]);
                }

                return [
                    'resultView' => 'setupForm',
                    'dataToAction' => ['step' => 3],
                    'notification' => ['type' => 'success', 'title' => 'Business name saved successfully']
                ];
            }
            if ($request->dataToAction['step'] == 3) {


                if (Http::withToken($request->dataFromAction['token'])->get('https://bizbot.site/api/user')->json()) {

                    // save token.
                    $k = Key::updateOrCreate(['slug' => 'bizbot'], ['value' => ($request->dataFromAction['token'])]);

                    return [
                        'resultView' => 'setupForm',
                        'dataToAction' => ['step' => 4],
                        'notification' => ['type' => 'success', 'title' => 'Token saved successfully']
                    ];
                } else {
                    return [
                        'resultView' => 'setupForm',
                        'dataToAction' => ['step' => 3],
                        'notification' => ['type' => 'warning', 'title' => 'Token not working properly. Please check again or click the support option from the menu.']
                    ];
                }

            }
            if ($request->dataToAction['step'] == 4) {

                $k = Key::updateOrCreate(['slug' => 'openai'], ['value' => ($request->dataFromAction['openaikey'])]);
                $result = Http::withToken($request->dataFromAction['openaikey'])->post('https://api.openai.com/v1/chat/completions',
                    ["model" => "gpt-3.5-turbo", "messages" => [["role" => "user", "content" => "Say this is a test!"]]]
                )->json();


                if (isset($result['id'])) {

                    // send the key to bizbotserver
                    $token = Key::where('slug', 'bizbot')->first()->value;
                    $bbservresponse = Http::withToken($token)->post('https://bizbot.site/api/setup',
                        [
                            "openai" => $request->dataFromAction['openaikey'],
                            "domain" => request()->getHost(),
                            "company" => Knowledgebase::where('about', 'business')->first()->data['name'],
                        ]
                    );
                    return [
                        'resultView' => 'setupForm',
                        'dataToAction' => ['step' => 5],
                        'notification' => ['type' => 'success', 'title' => 'OpenAI key saved successfully']
                    ];
                } else {
                    return [
                        'resultView' => 'setupForm',
                        'dataToAction' => ['step' => 4],
                        'notification' => ['type' => 'warning', 'title' => 'OpenAI key not working properly. Please check again or click the support option from the menu.']
                    ];
                }

            }
            if ($request->dataToAction['step'] == 5) {


                // ask for businessmodel from user, send it to the server and get the list of modules to install
                \App\Models\Knowledgebase::updateOrCreate(['about' => 'business_model'], ['data' => ['businessmodel' => ($request->dataFromAction['businessmodel'])]]);


                // if the user has not provided the token and openai key, return back a message which refreshes his page.
                $openaikey = Key::where('slug', 'openai')->first() ? Key::where('slug', 'openai')->first()->value : null;
                if (!$openaikey) {
                    return [
                        'resultView' => 'setupForm',
                        'dataToAction' => ['step' => 4],
                        'notification' => ['type' => 'warning', 'title' => 'OpenAI key or Token not found. Please check again or click the support option from the menu.']
                    ];
                }
                $token = Key::where('slug', 'bizbot')->first() ? Key::where('slug', 'bizbot')->first()->value : null;
                if (!$token) {
                    return [
                        'resultView' => 'setupForm',
                        'dataToAction' => ['step' => 3],
                        'notification' => ['type' => 'warning', 'title' => 'OpenAI key or Token not found. Please check again or click the support option from the menu.']
                    ];
                }

                Http::withToken($token)->post('https://bizbot.site/api/setup', [
                        'business_model' => $request->dataFromAction['businessmodel'],
                    ]
                );

                $relevantmodules = Http::withToken($token)->post('https://bizbot.site/api/modulesuggestion', [
                    'business_model' => $request->dataFromAction['businessmodel'],
                ])->json();


                // get the list of relevant modules from the server and send it to the front-end

                return [
                    "resultView" => 'setupForm',
                    "dataToAction" => ['step' => 6, 'modules' => $relevantmodules['data']],
                    'notification' => ['type' => 'success', 'title' => 'Business model saved successfully']
                ];
            }
            if ($request->dataToAction['step'] == 6) {
                // user is providing the modules list to install
                // install them with composer
                // tell server about which modules are installed

                foreach (explode(',', rtrim($request->dataFromAction['checkedModules'], ',')) as $module) {
//                        $command = "composer require ".$module." --no-interaction --no-suggest --no-progress --no-scripts --no-plugins";
//                        $path = base_path();
//                        $output = exec("cd {$path} && {$command}");

                    $allModules = $request->dataFromAction['allModules'];
                    foreach ($allModules as $eachModule) {
                        if ($eachModule['slug'] == $module) {
                            $m = $eachModule;
                            break;
                        }
                    }

                    Module::updateOrCreate(['slug' => $m['slug']],
                        [
                            'title' => $m['title'],
                            'constructor' => $m['constructor'],
                            'tables_controlled' => $m['tables_controlled'],
                            'functions_contained' => $m['functions_contained'],
                        ]);
                }

                $token = Key::where('slug', 'bizbot')->first() ? Key::where('slug', 'bizbot')->first()->value : null;

                if (!$token) {
                    return [
                        'resultView' => 'setupForm',
                        'dataToAction' => ['step' => 3],
                        'notification' => ['type' => 'warning', 'title' => 'OpenAI key or Token not found. Please check again or click the support option from the menu.']
                    ];
                }

                // parse each module and install it via composer
                // if a module is paid, ask for payment

                // after the modules are installed, tell the server about it
                Http::withToken($token)->post('https://bizbot.site/api/setup', [
                        'modules' => rtrim($request->dataFromAction['checkedModules'], ',')
                    ]
                );

                $message = "Thanks for completing the setup process. Please let me know how I can serve you. You can type in the input box above, or press / to select it.";

                Conversation::create([
                    'user_id' => auth()->user()->id,
                    'user_input' => "",
                    'final_output' => $message,
                    'learning_priority' => 0
                ]);

                return [
                    "appState" => ['disabled' => false],
                    "messageText" => $message,
                    "messageView" => '',
                    "messageData" => [],
                    "resultView" => 'suggestions',
                    "dataToAction" => [],

                ];


            }
        }
    }






}

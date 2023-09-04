<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.png" />
    <title>{{ config('app.name', 'BizBot') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script>
        window.last5conversations = @json(auth()->user()->conversations()->latest()->take(5)->get());
        window.preferencesContext = @json(\App\Models\Knowledgebase::where('about','preferences')->first() ? \App\Models\Knowledgebase::where('about','preferences')->first()->data : []);
        window.businessContext = @json(\App\Models\Knowledgebase::where('about','business')->first() ? \App\Models\Knowledgebase::where('about','business')->first()->data : []);
        window.businessModelContext = '{{ \App\Models\Knowledgebase::where('about','business_model')->first() ? \App\Models\Knowledgebase::where('about','business_model')->first()->data['businessmodel'] : '' }}';
        window.user = @json(auth()->user());
        window.domain = '{{$_SERVER['SERVER_NAME']}}';
        window.openaikey = '{{\App\Models\Key::where('slug','openai')->first() ?  \App\Models\Key::where('slug','openai')->first()->value : ''}}';
        window.token = '{{\App\Models\Key::where('slug','bizbot')->first() ? \App\Models\Key::where('slug','bizbot')->first()->value : ''}}';
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>

<body class="font-sans antialiased h-full" >
<div id="app_root"></div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Thunderbite</title>

    <link href="{{ mix('/css/backstage.css') }}" rel="stylesheet">
    <style>
       

    </style>

</head>

<body class="w-9/12 ml-auto mr-auto mt-40">

    <div class="grid grid-cols-5 w-full" style="border: 2px solid black">
        @foreach($data as $symbols)
            @foreach($symbols as $symbol)
            {{-- <div 
                class="border-solid border-4 border-light-blue-500 w-auto h-48" 
                style="background-image:url({{url($symbol['image'])}})"> --}}
            <div 
            class="border-solid border-4 border-light-blue-500 w-auto h-48 rounded-md flex items-center justify-center text-black text-2xl">    
                {{ $symbol['id'] }}
            </div>

            @endforeach
        @endforeach
    </div>
    <div class="mt-4 w-auto flex items-center justify-center cursor-pointer">
        {!! Form::open(['route' => 'save']) !!}
            {{ Form::hidden('reels', serialize($data)) }}
            <button type="submit" class="button-create">SPIN</button>
        {!! Form::close() !!}
    </div>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg, video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }
    </style>

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
     style="background: url('https://images.unsplash.com/photo-1608735483220-4e7239a08ba5?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1000&q=80');
     background-size: cover;
">

    <div id="player" class="max-w-6xl mx-auto sm:px-6 lg:px-8" x-data="player()" x-init="init()">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 bg-opacity-30 bg-white rounded-lg shadow">
            <h1 class="dark:text-white font-semibold p-6 text-6xl text-black text-center w-full">Guess The Song</h1>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6 shadow">
            <div>
                <h2 class="dark:text-white mb-1 text-9xl text-center" x-text="counter">28.69</h2>
                <p class="dark:text-white text-center text-xl">Seconds left</p>
            </div>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6 ">
            <div class="text-center">
                <a href="#" :class="{ 'text-green-300': playing }" class="text-white inline-block text-lg"
                   @click="play()">
                    <i height="45" width="45" data-feather="play"></i>
                </a>
                <a href="#" :class="{ 'text-red-300': !playing }" class="text-white inline-block" @click="pause()">
                    <i height="45" width="45" data-feather="pause"></i>
                </a>
                <a href="#" :class="{ 'text-purple-300': scrambled }" class="text-white inline-block"
                   @click="scramblePlaylist()">
                    <i height="45" width="45" data-feather="refresh-ccw"></i>
                </a>
                <a href="#" class="text-white inline-block text-blue-300" @click="nextSong()">
                    <i height="45" width="45" data-feather="check"></i>
                </a>
            </div>
        </div>

        <div
            class="bg-white dark:text-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg absolute top-0 right-0 w-1/3 m-2">
            <div class="flex bg-gray-700 p-2 shadow">
                <p class="flex-grow text-center">Game Master</p>
                <a class="flex-grow-0" @click="toggleGamemaster()"><i height="30" width="30"
                                                                      data-feather="book"></i></a>
            </div>
            <div class="p-4 divide-y divide-gray-500" x-show="gamemaster">
                <div class="w-full flex p-2 py-4">
                    <div class="w-1/3 text-center">
                        <div>
                            <i class="inline-block" height="30" width="30" data-feather="star"></i>
                        </div>
                        <p>6 Winners</p>
                    </div>
                    <div class="w-1/3 text-center">
                        <div>
                            <i class="inline-block" height="30" width="30" data-feather="star"></i>
                            <i class="inline-block" height="30" width="30" data-feather="star"></i>
                        </div>
                        <p>6 Winners</p>
                    </div>

                    <div class="w-1/3 text-center">
                        <div>
                            <i class="inline-block" height="30" width="30" data-feather="star"></i>
                            <i class="inline-block" height="30" width="30" data-feather="star"></i>
                            <i class="inline-block" height="30" width="30" data-feather="star"></i>
                        </div>
                        <p>6 Winners</p>
                    </div>
                </div>
                <div class="w-full pt-2 divide-gray-700 divide-y">
                    <template x-for="song in played" :key="song" style="border: none !important;" hidden>
                        <div x-text="song['name'] + ' - ' + song['artist']" class="p-3"></div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}" defer></script>
<script src="https://unpkg.com/feather-icons"></script>
<script> feather.replace() </script>
</body>
</html>

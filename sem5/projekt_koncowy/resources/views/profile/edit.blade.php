<x-app-layout>
{{--        <x-slot name="header">--}}
{{--            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--                {{ __('Profile') }}--}}
{{--            </h2>--}}
{{--        </x-slot>--}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{--    <!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <title>TAI | Komentarze</title>--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">--}}
{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
{{--    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>--}}
{{--    <style>--}}
{{--        body{--}}
{{--            background-color: #e8e8e8;--}}
{{--        }--}}
{{--        .title{--}}
{{--            text-align: center;--}}
{{--            background-color: transparent--}}
{{--        }--}}
{{--        .table-container{--}}
{{--            background-color: white;--}}
{{--            max-width: 900px;--}}
{{--            margin: 0 auto;--}}
{{--        }--}}
{{--        .footer-button{--}}
{{--            background-color: transparent;--}}
{{--            float: right;--}}
{{--            margin-top: 3%;--}}
{{--        }--}}
{{--        table{--}}
{{--            max-width: 800px;--}}
{{--            margin: 0 auto;--}}
{{--        }--}}
{{--        .max-w-7xl {--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--        }--}}
{{--        .max-w-xl {--}}
{{--            width: 100%; /* Dodano */--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--@include('layouts.navbar')--}}
{{--<body>--}}
{{--<x-slot name="header">--}}
{{--    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--        {{ __('Profile') }}--}}
{{--    </h2>--}}
{{--</x-slot>--}}

{{--<div class="py-12">--}}
{{--    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--            <div class="max-w-xl">--}}
{{--                @include('profile.partials.update-profile-information-form')--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--            <div class="max-w-xl">--}}
{{--                @include('profile.partials.update-password-form')--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--            <div class="max-w-xl">--}}
{{--                @include('profile.partials.delete-user-form')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}

{{--</html>--}}

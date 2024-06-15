<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    {{-- Fontawesome --}}
    <script src="https://kit.fontawesome.com/39fcf45a94.js" crossorigin="anonymous"></script>

    {{-- Sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased sm:overflow-auto" :class="{
    'overflow-hidden': open
}" x-data="{ open: false }">
    <x-banner />

    <div class="min-h-screen bg-gray-100">

        {{-- Nav --}}
        @include('layouts.includes.admin.nav')

        {{-- Sidebar --}}
        @include('layouts.includes.admin.sidebar')


        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-double rounded-lg dark:border-gray-700 mt-14">
                {{-- Alerts --}}
                <div x-data="{ closeAlert: true }">
                    @session('status')
                        <div id="alert-border-3"
                            class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                            :class="{
                                'transition-opacity duration-300 ease-out opacity-0 hidden': !closeAlert
                            }"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                {{ session('status') }}
                            </div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alert-border-3" aria-label="Close"
                                x-on:click="closeAlert = !closeAlert">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endsession
                </div>
                {{-- Header --}}
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                {{ $slot }}
            </div>
        </div>
    </div>

    <div x-show="open" x-on:click="open = !open" x-cloak
        class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30 sm:hidden"></div>

    @stack('modals')

    @livewireScripts

    {{-- Sweetalert Alerts --}}
    @session('swal')
        <script>
            Swal.fire(@json(session('swal')))
        </script>
    @endsession

    {{-- Stack JS --}}
    @stack('js')
    <script>
        function deleteRecord() {
            Swal.fire({
                title: `{{ __("You're sure?") }}`,
                html: '{{ __("Type \"confirm\" to delete the record.") }}',
                input: 'text',
                showCancelButton: true,
                confirmButtonColor: '#b91c1c',
                cancelButtonColor: '#ca8a04',
                confirmButtonText: '<i class="fa-solid fa-trash"></i> {{ __('Delete') }}',
                cancelButtonText: '<i class="fa-solid fa-ban"></i> {{ __('Cancel') }}',
                preConfirm: (inputValue) => {
                    if (inputValue !== 'confirmar') {
                        Swal.showValidationMessage(
                            '{{ __('You must type "confirm" to proceed.') }}'
                        );
                        return false;
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formDelete').submit();
                }
            });
        }
    </script>
</body>

</html>

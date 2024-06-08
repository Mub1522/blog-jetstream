<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <i class="fa-solid fa-inbox text-gray-600 dark:text-white" aria-hidden="true"></i>
            {{ __('New category') }}
        </h2>
    </x-slot>
    <form action="{{ route('admin.categories.store') }}" method="POST"
        class="w-full mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl mt-4">
        @csrf
        <x-validation-errors class="mb-4" />
        <div class="mb-5">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>
            <input type="text" id="name" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="userName" value="{{ old('name') }}" />
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                class="fa-solid fa-paper-plane"></i> {{ __('Submit') }}</button>
        <a href="{{ route('admin.categories.index') }}">
            <button type="button"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"><i
                    class="fa-solid fa-ban"></i> {{ __('Cancel') }}</button>
        </a>
    </form>

</x-admin-layout>

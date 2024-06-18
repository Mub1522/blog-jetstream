<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <i class="fa-solid fa-paperclip text-gray-600 dark:text-white" aria-hidden="true"></i>
            {{ __('Edit post') }}: {{ $post->title }}
        </h2>
    </x-slot>
    <form action="{{ route('admin.posts.update', $post) }}" method="POST"
        class="w-full mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl mt-4">
        @csrf
        @method('PUT')
        <x-validation-errors class="mb-4" />
        <div class="mb-5">
            <label for="title"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Title') }}</label>
            <input type="text" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="postTitle" value="{{ old('title', $post->title) }}" />
        </div>
        <div class="mb-5">
            <label for="slug"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Slug') }}</label>
            <input type="text" id="slug" name="slug"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="postSlug" value="{{ old('slug', $post->slug) }}" />
        </div>
        <div class="mb-5">
            <label for="category_id"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Category') }}</label>
            <x-select class="w-full" name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-5">
            <label for="excerpt"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Excerpt') }}</label>
            <x-text-area class="w-full" name="excerpt" id="excerpt">
                {{ old('excerpt', $post->excerpt) }}
            </x-text-area>
        </div>
        <div class="mb-5">
            <label for="body"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Body') }}</label>
            <x-text-area class="w-full" name="body" id="body" rows="12">
                {{ old('body', $post->body) }}
            </x-text-area>
        </div>
        <div class="mb-5">
            <input type="hidden" name="published" value="0">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" name="published" value="1"
                    @checked(old('published', $post->published) == 1)>
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Publish now') }}</span>
            </label>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                class="fa-solid fa-paper-plane"></i> {{ __('Submit') }}</button>
        <a href="{{ route('admin.posts.index') }}">
            <button type="button"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"><i
                    class="fa-solid fa-ban"></i> {{ __('Cancel') }}</button>
        </a>
        <button type="button" onclick="deleteRecord()"
            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"><i
                class="fa-solid fa-trash"></i> {{ __('Delete') }}</button>
    </form>
    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')
    </form>
</x-admin-layout>

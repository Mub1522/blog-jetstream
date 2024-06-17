<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <i class="fa-solid fa-paperclip text-gray-600 dark:text-white" aria-hidden="true"></i>
            {{ __('New post') }}
        </h2>
    </x-slot>
    <form action="{{ route('admin.posts.store') }}" method="POST"
        class="w-full mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl mt-4" x-data="data()"
        x-init="$watch('title', value => { string_to_slug(value) })">
        @csrf
        <x-validation-errors class="mb-4" />
        <div class="mb-5">
            <label for="title"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Title') }}</label>
            <input type="text" id="title" name="title" x-model="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="postTitle" value="{{ old('title') }}" />
        </div>
        <div class="mb-5">
            <label for="slug"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Slug') }}</label>
            <input type="text" id="slug" name="slug" x-model="slug"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required autocomplete="postSlug" value="{{ old('slug') }}" />
        </div>
        <div class="mb-5">
            <label for="category_id"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Category') }}</label>
            <x-select class="w-full" name="category_id">
                @foreach ($categories as $category)
                    <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                class="fa-solid fa-paper-plane"></i> {{ __('Submit') }}</button>
        <a href="{{ route('admin.posts.index') }}">
            <button type="button"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"><i
                    class="fa-solid fa-ban"></i> {{ __('Cancel') }}</button>
        </a>
    </form>

    @push('js')
        <script>
            function data() {
                return {
                    'title': '',
                    'slug': '',
                    string_to_slug(str) {
                        str = str.replace(/^\s+|\s+$/g, '');
                        str = str.toLowerCase();
                        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                        var to = "aaaaeeeeiiiioooouuuunc------";
                        for (var i = 0, l = from.length; i < l; i++) {
                            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                        }
                        str = str.replace(/[^a-z0-9 -]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');
                        this.slug = str;
                    }
                }
            }
        </script>
    @endpush
</x-admin-layout>

<x-admin-layout>

    <ul class="space-y-8">
        @foreach ($posts as $post)
            <li class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <img class="aspect-video object-cover object-center" src="{{ $post->image_path }}" alt="">
                </div>
                <div>
                    <h1 class="text-xl font-semibold">
                        {{ $post->title }}
                    </h1>
                    <hr class="mt-1 mb-2">
                    <span @class([
                        'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300' =>
                            $post->published,
                        'bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300' => !$post->published,
                    ])>
                        {{ $post->published ? __('Published') : __('Draft') }}
                    </span>
                    <p class="text-gray-700 mt-2">
                        {{ $post->excerpt }}
                    </p>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('admin.posts.edit', $post) }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i
                                class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</x-admin-layout>

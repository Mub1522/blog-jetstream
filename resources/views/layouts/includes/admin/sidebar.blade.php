@php
    $links = [
        [
            'name' => __('Dashboard'),
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
            'icon' => 'fa-solid fa-gauge-high',
        ],
        [
            'name' => __('Posts'),
            'route' => route('admin.posts.index'),
            'active' => request()->routeIs('admin.posts.*'),
            'icon' => 'fa-solid fa-paperclip',
        ],
        [
            'name' => __('Categories'),
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
            'icon' => 'fa-solid fa-inbox',
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        '-translate-x-full': !open
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['route'] }}" active="{{ $link['active'] }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <i class="{{ $link['icon'] }} text-gray-600 dark:text-white"></i>
                        <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

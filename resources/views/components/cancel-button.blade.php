@props(['href'])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex
                                                                                items-center px-4 py-2 bg-red-800 dark:bg-red-800 border border-red-800
                                                                                dark:border-red-800 rounded-md font-semibold text-xs text-gray-700
                                                                                dark:text-gray-300 uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500
                                                                                focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25
                                                                                transition ease-in-out duration-150',
    ]) }}>
    Cancel
</a>

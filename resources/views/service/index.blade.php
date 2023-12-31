<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            @can('admin')
                                <x-create-button-service href="{{ route('service.create') }}" />
                            @endcan
                        </div>
                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-blue-100 dark:bg-blue-900 border border-blue-200">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-blue-900 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price/Kg
                                    </th>
                                    @can('admin')
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @forelse ($services as $service)
                                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $counter++ }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <a href="{{ route('service.edit', $service) }}" class="hover:underline">
                                                {{ $service->title }}</a>
                                        </td>
                                        <td class="px-6 py-4 md:block">
                                            <a href="{{ route('service.edit', $service) }}"
                                                class="hover:underline">{{ $service->harga }}
                                            </a>
                                        </td>
                                        @can('admin')
                                            <td class="px-6 py-4">
                                                <div class="flex space-x-3">
                                                    <form action="{{ route('service.destroy', $service) }}" method="Post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 dark:text-red-400">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            Empty
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

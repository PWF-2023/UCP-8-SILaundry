<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            @if(!auth()->user()->is_admin)
                                <x-create-button-transaction href="{{ route('transaction.create') }}" />
                            @endif
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
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-blue-100 dark:bg-blue-900 border border-blue-200 dark:border-white">
                            <thead class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-white dark:text-black">
                                <tr>
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Customer Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Service
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Weight(Kg)
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Entry Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Out Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @forelse ($transactions as $transaction)
                                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $counter++ }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <a href="{{ route('transaction.edit', $transaction) }}"
                                                class="hover:underline">{{ $transaction->customer }}</a>
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            @if ($transaction->service_id)
                                                {{ $transaction->service->title }}
                                            @endif
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $transaction->berat }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ 'Rp ' . number_format($transaction->total_harga, 0, ',', '.') }}
                                        </td>

                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $transaction->tgl_masuk }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $transaction->tgl_keluar }}
                                        </td>
                                        <td class="hidden px-6 py-4 md:block">
                                            @if ($transaction->is_complete == false)
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                    Ongoing
                                                </span>
                                            @else
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    Completed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-3">
                                                {{-- Action Here --}}
                                                @if ($transaction->is_complete == false)
                                                    <form action="{{ route('transaction.complete', $transaction) }}"
                                                        method="Post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="text-green-600 dark:text-green-400">
                                                            Complete
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('transaction.uncomplete', $transaction) }}"
                                                        method="Post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-blue-600 dark:text-blue-400">
                                                            Uncomplete
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('transaction.destroy', $transaction) }}"
                                                    method="Post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

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
                    @if ($transactionsCompleted > 1)
                        <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                            <form action="{{ route('transaction.deleteallcompleted') }}" method="Post">
                                @csrf
                                @method('delete')
                                <x-primary-button>
                                    Delete All Completed Task
                                </x-primary-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
</x-app-layout>

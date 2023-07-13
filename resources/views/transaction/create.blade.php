<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('transaction.store') }}" class="">
                        @csrf
                        @method('post')
                        <div class="mb-6">
                            <x-input-label for="customer" :value="__('Customer')" />
                            <x-text-input id="customer" name="customer" type="text" class="block w-full mt-1"
                                required autofocus autocomplete="customer" />
                            <x-input-error class="mt-2" :messages="$errors->get('customer')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="service" :value="__('Service')" />
                            <x-select id="service" name="service_id" class="form-select">
                                <option value="">Empty</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" data-harga="{{ $service->harga }}">
                                        {{ $service->title }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('service_id')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="berat" :value="__('Berat(Kg)')" />
                            <x-text-input id="berat" name="berat" type="text" class="block w-full mt-1"
                                required autofocus autocomplete="berat" />
                            <x-input-error class="mt-2" :messages="$errors->get('berat')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="tgl_masuk" :value="__('Tanggal Masuk')" />
                            <x-text-input id="tgl_masuk" name="tgl_masuk" type="date" class="block w-2/4 mt-1"
                                required autofocus autocomplete="tgl_masuk" />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_masuk')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="tgl_keluar" :value="__('Tanggal Keluar')" />
                            <x-text-input id="tgl_keluar" name="tgl_keluar" type="date" class="block w-2/4 mt-1"
                                required autofocus autocomplete="tgl_keluar" />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_keluar')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            <x-cancel-button href="{{ route('transaction.index') }}" />
                        </div>
                    </form>

                    <div id="harga-container" class="hidden mt-8">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">Berat (Kg)</th>
                                    <th class="px-4 py-2 text-left">Harga</th>
                                    <th class="px-4 py-2 text-left">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="berat-display" class="px-4 py-2"></td>
                                    <td id="harga-display" class="px-4 py-2"></td>
                                    <td id="total-harga-display" class="px-4 py-2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const serviceSelect = document.getElementById('service');
        const beratInput = document.getElementById('berat');
        const beratDisplay = document.getElementById('berat-display');
        const hargaDisplay = document.getElementById('harga-display');
        const totalHargaDisplay = document.getElementById('total-harga-display');
        const hargaContainer = document.getElementById('harga-container');

        serviceSelect.addEventListener('change', updateHargaDisplay);
        beratInput.addEventListener('input', updateHargaDisplay);

        function updateHargaDisplay() {
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const harga = selectedOption.dataset.harga;
            const berat = beratInput.value;
            const totalHarga = harga * berat;

            if (harga && berat) {
                beratDisplay.textContent = berat;
                hargaDisplay.textContent = 'Rp ' + formatNumber(harga);
                totalHargaDisplay.textContent = 'Rp ' + formatNumber(totalHarga);
                hargaContainer.classList.remove('hidden');
            } else {
                beratDisplay.textContent = '';
                hargaDisplay.textContent = '';
                totalHargaDisplay.textContent = '';
                hargaContainer.classList.add('hidden');
            }
        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
</x-app-layout>

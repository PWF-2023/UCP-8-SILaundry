<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-blue-100 border-b border-gray-200">
                    <center>
                        <p><b>Welcome to Our Laundry Website</b></p>
                    </center>
                    <br>
                    <p><b>Sejarah Berdirinya</b></p>
                    <p>Laundry ini dimulai pada tahun 2019 ketika pendirinya, Bailey Dupont A. Hingga akhirnya tahun
                        2023 ini memutuskan memakai aplikasi website SIstem Informasi Laundry (SILaundry) untuk
                        mempermudah proses pencatatan transaksi. </p>
                    <br>
                    <p><b>Struktur </b></p>
                    <center>
                        <img src="{{ asset('Struktur.png') }}" alt="Struktur" width="800">
                    </center>
                    <br>
                    <p><b>SOP SILaundry</b></p>
                    <p>Berikut SOP (Standard Operating Procedure) bagi pegawai saat menggunakan aplikasi SILaundry:</p>
                    <p>1. Login menggunakan akun pribadi yang sudah terdaftar</p>
                    <p>2. Catat transaksi dengan teliti</p>
                    <p>3. Tandai pesanan sebagai selesai dengan mengklik tombol "Complete"</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

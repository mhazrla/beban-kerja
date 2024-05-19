@extends('layouts.auth')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pegawai Baru</h1>
    <p class="mb-4">"Proses integrasi pegawai baru di departemen sumber daya manusia (SDM) merupakan langkah penting untuk
        memastikan bahwa pegawai baru dapat beradaptasi dengan baik dengan budaya perusahaan, memahami kebijakan SDM, dan
        mendapatkan dukungan yang diperlukan selama masa orientasi. <a target="_blank"
            href="https://ditsdm.ipb.ac.id/">Direktorat Sumber Daya Manusia</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Data Pegawai Baru</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Nama -->
                <div class="form-group">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                </div>


                <!-- Username -->
                <div class="form-group">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="form-control" type="text" name="username" :value="old('username')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2 text-danger" />
                </div>

                <!-- Jabatan -->
                <div class="form-group">
                    @php
                        $jabatanOptions = [
                            '2' => 'Verifikator',
                            '3' => 'Administrasi Keuangan',
                            '4' => 'Supervisor Jaminan Mutu',
                            '5' => 'Staff Administrasi',
                            '6' => 'Staff Rekrutmen Pegawai',
                            '7' => 'Staff Pengelolaan Kinerja Karyawan',
                            '8' => 'Supervisor Human Resource',
                        ];
                    @endphp

                    <x-select-input id="role_id" name="role_id" :options="$jabatanOptions" :selected="old('role_id')">
                        {{ __('Jabatan') }}
                    </x-select-input>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="form-control" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <!-- Confirmation Password -->
                <div class="form-group">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="form-control" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                </div>

                <!-- Kontak -->
                <div class="form-group">
                    <x-input-label for="contact" :value="__('Contact')" />
                    <x-text-input id="contact" class="form-control" type="text" name="contact" :value="old('contact')"
                        autofocus autocomplete="contact" />
                    <x-input-error :messages="$errors->get('contact')" class="mt-2 text-danger" />
                </div>


                <!-- Foto -->
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" class="form-control-file" id="photo" accept="image/*" name="photo">
                    <x-input-error :messages="$errors->get('photo')" class="mt-2 text-danger" />
                </div>

                <!-- Tombol Aksi -->
                <div class="form-group">
                    <button type="button" class="btn btn-danger" onclick="history.back()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

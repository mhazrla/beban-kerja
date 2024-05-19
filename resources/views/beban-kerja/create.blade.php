@extends('layouts.auth')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">Yth Bapak/Ibu yang kami hormati, bersama ini kami mohon untuk dapat mengisikan data di bawah ini
        terkait pekerjaan Bapak/Ibu sekalian sehari-hari pada kolom Output, Volume dan Time allocated / alokasi waktu
        dan mohon dapat dicoret aktivitas yang tidak dilakukan atau pun ada aktivitas yang keliru dan dapat juga
        Bapak/Ibu menambahkan jika ada aktivitas lain yang dilakukan dalam rangka penyelesaian tugas dan fungsinya,
        kami ucapkan terima kasih atas partisipasi informasi dan kesediaannya.</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Analisis Beban Kerja</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('beban-kerja.store') }}" method="POST">
                <div class="table-responsive">
                    @csrf
                    <select class="form-control mb-3" name="tahun" id="tahun" required>
                        <option value="">Pilih Tahun</option>
                    </select>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Tugas Rutin</th>
                                <th>Output</th>
                                <th>Volume</th>
                                <th>Time Allocated</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($beban_kerja as $bk)
                                <tr>
                                    <td>{{ $bk->name }}</td>
                                    <td>{{ $bk->tugas_rutin }}</td>
                                    <input type="hidden" name="bk_id[]" value="{{ $bk->id }}">
                                    <!-- Ubah bk_id menjadi array -->
                                    <td>
                                        <input required type="text"
                                            class="form-control @error('beban_kerja.' . $bk->id . '.output') is-invalid @enderror"
                                            name="beban_kerja[{{ $bk->id }}][output]"
                                            value="{{ old('beban_kerja.' . $bk->id . '.output') }}" />
                                        @error('beban_kerja.' . $bk->id . '.output')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input required type="text"
                                            class="form-control @error('beban_kerja.' . $bk->id . '.volume') is-invalid @enderror"
                                            name="beban_kerja[{{ $bk->id }}][volume]"
                                            value="{{ old('beban_kerja.' . $bk->id . '.volume') }}" />
                                        @error('beban_kerja.' . $bk->id . '.volume')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input required type="text"
                                            class="form-control @error('beban_kerja.' . $bk->id . '.time_allocated') is-invalid @enderror"
                                            name="beban_kerja[{{ $bk->id }}][time_allocated]"
                                            value="{{ old('beban_kerja.' . $bk->id . '.time_allocated') }}" />
                                        @error('beban_kerja.' . $bk->id . '.time_allocated')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        <script>
            var startYear = 2021;
            var endYear = 2024;
            var select = document.getElementById("tahun");

            for (var year = startYear; year <= endYear; year++) {
                var option = document.createElement("option");
                option.text = year;
                option.value = year;
                select.appendChild(option);
            }
        </script>
    </div>
@endsection

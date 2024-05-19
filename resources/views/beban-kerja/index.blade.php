@extends('layouts.auth')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        @if ($user_bk && $user_bk->is_verified === 1)
            <a href="{{ route('beban-kerja.report', ['tahun' => $user_bk->tahun]) }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        @endif
    </div>

    <p class="mb-4"> </a></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Analisis Beban Kerja</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="tahun">Filter Tahun:</label>
                <select class="form-control" id="tahun" onchange="filterByYear()">
                    <option value="">Semua Tahun</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tugas Rutin</th>
                            <th>Output/KPI</th>
                            <th>Volume</th>
                            <th>Time Allocated</th>
                            <th>Daily Volume</th>
                            <th>Daily Time</th>
                            <th>Daily Used</th>
                            <th>FTE</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beban_kerja as $bk)
                            <tr>
                                <td>{{ $bk->tugasRutin->name }}</td>
                                <td>{{ $bk->tugasRutin->tugas_rutin }}</td>
                                <td>{{ $bk->output }}</td>
                                <td>{{ $bk->volume }} x /tahun</td>
                                <td>{{ $bk->time_allocated }}</td>
                                <td>{{ $bk->daily_volume }}</td>
                                <td>{{ $bk->daily_time }}</td>
                                <td>{{ $bk->daily_used }}</td>
                                <td>{{ $bk->fte }}</td>
                                <td>{{ $bk->tahun }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function filterByYear() {
            var year = document.getElementById('tahun').value;
            window.location.href = '{{ route('beban-kerja.index') }}?tahun=' + year;
        }
    </script>
@endsection

@extends('layouts.auth')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4"> </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Analisis Beban Kerja</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Verifikasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user_beban_kerja as $item)
                            <!-- Modal -->
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->role->name }}</td>
                                <td class="d-flex">
                                    <form action="{{ route('beban-kerja.verifikasi') }}" method="POST" class="mx-2">
                                        @csrf
                                        <input type="hidden" name="beban_kerja_id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger" name="action"
                                            onclick="alert('Apakah Anda yakin ingin tolak verifikasi ini?')"
                                            value="tolak">Tolak</button>
                                    </form>
                                    <form action="{{ route('beban-kerja.verifikasi') }}" method="POST" class="mx-2">
                                        @csrf
                                        <input type="hidden" name="beban_kerja_id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-success" name="action"
                                            value="verifikasi">Verifikasi</button>
                                    </form>
                                    <div class="modal fade" id="verifikasiModal-{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="verifikasiModal-{{ $item->id }}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verifikasiModal-{{ $item->id }}Label">
                                                        Detail
                                                        Verifikasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- DataTales Example -->
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Analisis Beban Kerja
                                                        </h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="dataTable"
                                                                width="100%" cellspacing="0">
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
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($item->user->analisisBebanKerja as $abk)
                                                                        <tr>
                                                                            <td>{{ $abk->tugasRutin->name }}</td>
                                                                            <td>{{ $abk->output }}</td>
                                                                            <td>{{ $abk->volume }}</td>
                                                                            <td>{{ $abk->time_allocated }}</td>
                                                                            <td>{{ $abk->daily_volume }}</td>
                                                                            <td>{{ $abk->daily_time }}</td>
                                                                            <td>{{ $abk->daily_used }}</td>
                                                                            <td>{{ $abk->fte }}</td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="button" class="btn btn-success">Selesai</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->is_verified === 0 ? 'Belum diverifikasi' : 'Sudah diverifikasi' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Belum ada data...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnalisisBebanKerja;
use App\Models\MasterBebanKerja;
use App\Models\UserBebanKerja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AnalisisBebanKerjaController extends Controller
{
    public function dashboard(): View
    {
        $user_id = Auth::user()->id;
        $years = AnalisisBebanKerja::where('user_id', $user_id)->orderByDesc('tahun')->pluck('tahun')->unique()->take(4);

        return view('dashboard', [
            'years' => $years,
        ]);
    }

    public function index(Request $request): View
    {
        $user_id = Auth::user()->id;
        $years = AnalisisBebanKerja::where('user_id', $user_id)->pluck('tahun')->unique();

        $analisisBebanKerja = AnalisisBebanKerja::where('user_id', $user_id);
        $userBebanKerja = null;

        if ($request->has('tahun')) {
            $analisisBebanKerja->where('tahun', $request->tahun);
            $userBebanKerja = UserBebanKerja::where('user_id', $user_id)
                ->where('tahun', $request->tahun)
                ->first();
        }

        $beban_kerja = $analisisBebanKerja->get();

        return view('beban-kerja.index', [
            'beban_kerja' => $beban_kerja,
            'years' => $years,
            'user_bk' => $userBebanKerja,
        ]);
    }

    public function create(): View
    {
        $beban_kerja = MasterBebanKerja::get();

        return view('beban-kerja.create', [
            'beban_kerja' => $beban_kerja,
        ]);
    }

    public function store(Request $request)
    {
        $existingRecord = AnalisisBebanKerja::where('user_id', $request->user()->id)
            ->where('tahun', $request->tahun)
            ->exists();

        if ($existingRecord) {
            Alert::error('Gagal menambahkan data', 'Analisis Beban Kerja untuk tahun ' . $request->tahun . ' sudah pernah diisi');
            return back();
        }

        foreach ($request->beban_kerja as $id => $fields) {
            $validator = Validator::make($fields, [
                'output' => 'required|string|max:255',
                'volume' => 'required|integer',
                'time_allocated' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $daily_time = $fields['time_allocated'] * 60;
            $daily_used = ($fields['time_allocated'] * 60) / $fields['volume'];
            $periode_in_minutes = 1 * 8 * 60;
            $total_work_minutes_per_period = 8 * 60;
            $fte = ($daily_used / $total_work_minutes_per_period) * $periode_in_minutes;

            AnalisisBebanKerja::create([
                'bk_id' => $id,
                'output' => $fields['output'],
                'volume' => $fields['volume'],
                'time_allocated' => $fields['time_allocated'],
                'user_id' => $request->user()->id,
                'tahun' => $request->tahun,
                'daily_volume' => $fields['volume'],
                'daily_time' => $daily_time,
                'daily_used' => $daily_used,
                'fte' => $fte,
            ]);
        }

        UserBebanKerja::create([
            'user_id' => $request->user()->id,
            'tahun' => $request->tahun,
        ]);
        Alert::success('Success!', 'Beban Kerja Berhasil Ditambahkan');
        return Redirect::route('beban-kerja.index');
    }

    public function list(): View
    {
        $userBebanKerja = UserBebanKerja::get();

        return view('beban-kerja.list', [
            'user_beban_kerja' => $userBebanKerja,
        ]);
    }

    public function verifikasi(Request $request)
    {
        $bebanKerjaId = $request->input('beban_kerja_id');
        $action = $request->input('action');

        if ($action === 'tolak') {
            $u_beban_kerja = UserBebanKerja::findOrFail($bebanKerjaId);
            AnalisisBebanKerja::where('user_id', $u_beban_kerja->user_id)
                ->where('tahun', $u_beban_kerja->tahun)
                ->delete();
            $u_beban_kerja->delete();
            Alert::success('Success!', 'Beban Kerja Berhasil Ditolak');
        } elseif ($action === 'verifikasi') {
            UserBebanKerja::where('id', $bebanKerjaId)->update(['is_verified' => true]);
            Alert::success('Success!', 'Beban Kerja Berhasil Diverifikasi');
        }

        return back();
    }

   public function generatePDF(Request $request, $tahun)
    {
        $beban_kerja = AnalisisBebanKerja::where('tahun', $tahun)->get();
        $pdf = Pdf::loadView('beban-kerja.report', ['beban_kerja' => $beban_kerja]);
        return $pdf->download('report-'.$tahun.'.pdf');
    }
}

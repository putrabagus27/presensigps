<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();
        $historibulanini = DB::table('presensi')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi')
            ->get();
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00", 1, 0)) as jmlterlambat')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();
        $leaderboard = DB::table('presensi')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->where('tgl_presensi', $hariini)
            ->orderBy('jam_in')
            ->get();
        $namabulan = [
            "", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ];
        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status="i", 1,0)) as jmlizin, SUM(IF(status="s", 1,0)) as jmlsakit')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
            ->where('status_approved', 1)
            ->first();
        return view('dashboard.dashboard', compact(
            'presensihariini',
            'historibulanini',
            'namabulan',
            'bulanini',
            'tahunini',
            'rekappresensi',
            'leaderboard',
            'rekapizin'
        ));
    }

    public function dashboardadmin(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = [
            "", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ];
        $karyawan = Karyawan::all();
        $absensi = Presensi::all();
        $hariini = ("Y-m-d");
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00",1,0)) as jmlterlambat')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->first();
        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
            ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
            ->whereRaw('status_approved', 1)
            ->first();
        $categories = [];
        $data = [];
        $dataa = [];
        foreach ($karyawan as $k) {
            $categories[] = $k->nama_lengkap;
        }
        foreach ($absensi as $a) {
            $data[] = $a->tgl_presensi;
        }

        //Total Hadir
        $thnik1 = DB::table('presensi')
            ->where('nik', '1')
            ->selectRaw('Count(nik) as thnik1')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik1');
        $thnik2 = DB::table('presensi')
            ->where('nik', '2')
            ->selectRaw('Count(nik) as thnik2')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik2');
        $thnik3 = DB::table('presensi')
            ->where('nik', '3')
            ->selectRaw('Count(nik) as thnik3')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik3');
        $thnik4 = DB::table('presensi')
            ->where('nik', '4')
            ->selectRaw('Count(nik) as thnik4')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik4');
        $thnik5 = DB::table('presensi')
            ->where('nik', '5')
            ->selectRaw('Count(nik) as thnik5')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik5');
        $thnik6 = DB::table('presensi')
            ->where('nik', '6')
            ->selectRaw('Count(nik) as thnik6')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik6');
        $thnik7 = DB::table('presensi')
            ->where('nik', '7')
            ->selectRaw('Count(nik) as thnik7')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik7');
        $thnik8 = DB::table('presensi')
            ->where('nik', '8')
            ->selectRaw('Count(nik) as thnik8')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik8');
        $thnik9 = DB::table('presensi')
            ->where('nik', '9')
            ->selectRaw('Count(nik) as thnik9')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik9');
        $thnik10 = DB::table('presensi')
            ->where('nik', '10')
            ->selectRaw('Count(nik) as thnik10')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik10');
        $thnik11 = DB::table('presensi')
            ->where('nik', '11')
            ->selectRaw('Count(nik) as thnik11')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik11');
        $thnik12 = DB::table('presensi')
            ->where('nik', '12')
            ->selectRaw('Count(nik) as thnik12')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik12');
        $thnik13 = DB::table('presensi')
            ->where('nik', '13')
            ->selectRaw('Count(nik) as thnik13')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik13');
        $thnik99 = DB::table('presensi')
            ->where('nik', '99')
            ->selectRaw('Count(nik) as thnik99')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('thnik99');

        //Total Terlambat
        $ttnik1 = DB::table('presensi')
            ->where('nik', '1')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik1')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik1');
        $ttnik2 = DB::table('presensi')
            ->where('nik', '2')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik2')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik2');
        $ttnik3 = DB::table('presensi')
            ->where('nik', '3')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik3')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik3');
        $ttnik4 = DB::table('presensi')
            ->where('nik', '4')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik4')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik4');
        $ttnik5 = DB::table('presensi')
            ->where('nik', '5')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik5')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik5');
        $ttnik6 = DB::table('presensi')
            ->where('nik', '6')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik6')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik6');
        $ttnik7 = DB::table('presensi')
            ->where('nik', '7')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik7')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik7');
        $ttnik8 = DB::table('presensi')
            ->where('nik', '8')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik8')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik8');
        $ttnik9 = DB::table('presensi')
            ->where('nik', '9')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik9')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik9');
        $ttnik10 = DB::table('presensi')
            ->where('nik', '10')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik10')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik10');
        $ttnik11 = DB::table('presensi')
            ->where('nik', '11')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik11')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik11');
        $ttnik12 = DB::table('presensi')
            ->where('nik', '12')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik12')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik12');
        $ttnik13 = DB::table('presensi')
            ->where('nik', '13')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik13')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik13');
        $ttnik99 = DB::table('presensi')
            ->where('nik', '99')
            ->selectRaw('Count(nik), CAST(SUM(IF(jam_in > "07:00",1,0)) as INT) as ttnik99')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->pluck('ttnik99');
        //dd($hadir);
        //dd($total_hadir);
        //dd($data);
        //dd($data1);
        //dd($dataa);
        //dd($categories);
        //dd($totalhadir);
        //dd($totalterlambat);
        //dd($thnik1);
        //dd($ttnik3);
        //dd($thnik99);
        return view('dashboard.dashboardadmin', compact(
            'rekappresensi',
            'rekapizin',
            'categories',
            'data',
            'thnik1',
            'thnik2',
            'thnik3',
            'thnik4',
            'thnik5',
            'thnik6',
            'thnik7',
            'thnik8',
            'thnik9',
            'thnik10',
            'thnik11',
            'thnik12',
            'thnik13',
            'thnik99',
            'ttnik1',
            'ttnik2',
            'ttnik3',
            'ttnik4',
            'ttnik5',
            'ttnik6',
            'ttnik7',
            'ttnik8',
            'ttnik9',
            'ttnik10',
            'ttnik11',
            'ttnik12',
            'ttnik13',
            'ttnik99',
            'namabulan'
        ));
    }
}

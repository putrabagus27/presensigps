<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use League\CommonMark\Extension\Table\Table;
use SebastianBergmann\CodeCoverage\Node\CrapIndex;

class GajiController extends Controller
{
    public function gaji()
    {
        $namabulan = [
            "", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ];
        return view('karyawan.gaji', compact('namabulan'));
    }
    public function getgaji(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
        $show = DB::table('gaji')
            ->whereRaw('MONTH(tgl_gaji)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_gaji)="' . $tahun . '"')
            ->where('nik', $nik)
            ->orderBy('tgl_gaji')
            ->get();
        //dd($show);
        return view('karyawan.getgaji', compact('show'));
    }
    public function cetakgaji(Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = [
            "", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ];
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)
            ->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept')
            ->first();
        $gaji = DB::table('gaji')
            ->whereRaw('MONTH(tgl_gaji)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_gaji)="' . $tahun . '"')
            ->where('nik', $nik)
            ->orderBy('tgl_gaji')
            ->get();
        //dd($bulan);
        return view('karyawan.cetakgaji', compact('bulan', 'tahun', 'namabulan', 'karyawan', 'gaji'));
    }
    public function index(Request $request)
    {
        /*
        $gaji = DB::table('gaji')
            ->join('karyawan', 'gaji.nik', '=', 'karyawan.nik')
            ->join('departemen', 'gaji.kode_dept', '=', 'departemen.kode_dept')
            ->orderBy('id')
            ->get();          
        $departemen = DB::table('departemen')->get();
        
        return view('gaji.index', compact('gaji', 'departemen'));
        */
        $query = Gaji::query();
        $query->select('id', 'tgl_gaji', 'gaji.nik', 'nama_lengkap', 'jabatan', 'nama_dept', 'gaji_pokok', 'gaji_lembur', 'uang_makan', 'pot_gaji', 'total');
        $query->join('karyawan', 'gaji.nik', '=', 'karyawan.nik');
        $query->join('departemen', 'gaji.kode_dept', '=', 'departemen.kode_dept');
        if (!empty($request->tanggal)) {
            $query->where('tgl_gaji', $request->tanggal);
        }
        if (!empty($request->nama_karyawan)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }
        if (!empty($request->kode_dept)) {
            $query->where('karyawan.kode_dept', $request->kode_dept);
        }
        $query->orderBy('nik');
        $gaji = $query->paginate(5);
        $gaji->appends($request->all());
        $departemen = DB::table('departemen')->get();

        return view('gaji.index', compact('gaji', 'departemen'));
    }
    public function input(Request $request)
    {
        $nik = $request->nik;
        $kode_dept = $request->kode_dept;
        $tgl_gaji = date("Y-m-d");
        $gaji_pokok = $request->gaji_pokok;
        $gaji_lembur = $request->gaji_lembur;
        $uang_makan = $request->uang_makan;
        $pot_gaji = $request->pot_gaji;
        $total = $request->total;
        try {
            $data = [
                'nik' => $nik,
                'kode_dept' => $kode_dept,
                'tgl_gaji' => $tgl_gaji,
                'gaji_pokok' => $gaji_pokok,
                'gaji_lembur' => $gaji_lembur,
                'uang_makan' => $uang_makan,
                'pot_gaji' => $pot_gaji,
                'total' => $total
            ];
            $simpan = DB::table('gaji')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            //dd($e);
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }
    public function delete($id)
    {
        $delete = DB::table('gaji')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $gaji = DB::table('gaji')->where('id', $id)->first();
        $departemen = DB::table('departemen')->get();
        return view('gaji.edit', compact('gaji', 'departemen'));
    }
    public function update($id, Request $request)
    {
        $id = $request->id;
        $kode_dept = $request->kode_dept;
        $tgl_gaji = date("Y-m-d");
        $gaji_pokok = $request->gaji_pokok;
        $gaji_lembur = $request->gaji_lembur;
        $uang_makan = $request->uang_makan;
        $pot_gaji = $request->pot_gaji;
        $total = $request->total;
        $data = [
            'tgl_gaji' => $tgl_gaji,
            'kode_dept' => $kode_dept,
            'tgl_gaji' => $tgl_gaji,
            'gaji_pokok' => $gaji_pokok,
            'gaji_lembur' => $gaji_lembur,
            'uang_makan' => $uang_makan,
            'pot_gaji' => $pot_gaji,
            'total' => $total,
        ];
        $update = DB::table('gaji')->where('id', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }
}

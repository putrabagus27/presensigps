<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .tabeldatakaryawan {
            margin-top: 50px;
        }

        .tabeldatakaryawan td {
            padding: 5px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi tr th {
            border: 1px solid #131212;
            padding: 8px;
            background-color: #dbdbdb;
        }

        .tabelpresensi tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: 12px;
        }

        .foto {
            width: 40px;
            height: 30px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td style="width:30px">
                    <img src="{{ asset('assets/img/logopresensi.png') }}" width="70" height="70" alt="">
                </td>
                <td>
                    <span id="title">
                        LAPORAN GAJI PEGAWAI <br>
                        PERIODE {{ strtoupper ($namabulan[$bulan]) }} {{ $tahun }} <br>
                        PT. BALI SUMMER MANUFACTURE <br>
                    </span>
                    <span>
                        <i>Jalan Raya Muding Mundeh</i>
                    </span>
                </td>
            </tr>
        </table>
        <table class="tabeldatakaryawan">
            <tr>
                <td rowspan="8">
                    @php
                    $path = Storage::url('uploads/karyawan/'. $karyawan->foto);
                    @endphp
                    <img src="{{ $path }}" alt="" width="140" height="180">
                </td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $karyawan->nik }}</td>
            </tr>
            <tr>
                <td>Nama Pegawai</td>
                <td>:</td>
                <td>{{ $karyawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $karyawan->jabatan }}</td>
            </tr>
            <tr>
                <td>Nama Departemen</td>
                <td>:</td>
                <td>{{ $karyawan->nama_dept }}</td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td>{{ $karyawan->no_hp }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $karyawan->alamat }}</td>
            </tr>
        </table>
        <table class="tabelpresensi">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Gaji Pokok</th>
                <th>Gaji Lembur</th>
                <th>Uang Makan</th>
                <th>Potongan Gaji (Tidak Absen)</th>
                <th>Total Gaji</th>
            </tr>
            @foreach ($gaji as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y", strtotime($d->tgl_gaji)) }}</td>
                <td>@uang($d->gaji_pokok)</td>
                <td>@uang($d->gaji_lembur)</td>
                <td>@uang($d->uang_makan)</td>
                <td>@uang($d->pot_gaji)</td>
                <td>@uang($d->total)</td>
            </tr>
            @endforeach
        </table>
        <table width="100%" style="margin-top:100px">
            <tr>
                <td colspan="2" style="text-align: right">Denpasar, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: bottom" height="100px">
                    <u>Putra</u><br>
                    <i><b>HRD</b></i>
                </td>
                <td style="text-align: center; vertical-align: bottom" height="100px">
                    <u>Putra</u><br>
                    <i><b>HRD</b></i>
                </td>
            </tr>
        </table>
    </section>

</body>

</html>
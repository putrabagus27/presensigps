<title>Dashboard Admin</title>
@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title 
                <div class="page-pretitle">
                    Overview
                </div>
                -->
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>

        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="/panel/dashboardadmin" method="GET">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <select name="bulan" id="bulan" class="form-select">
                                                            <option value="">Bulan</option>
                                                            @for ($i=1; $i<=12; $i++) <option value="{{ $i }}" {{ date("m") == $i ? 'selected' : '' }}>{{ $namabulan[$i] }}</option>
                                                                @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <select name="tahun" id="tahun" class="form-select">
                                                            <option value="">Tahun</option>
                                                            @php
                                                            $tahunmulai = 2022;
                                                            $tahunskrg = date("Y");
                                                            @endphp
                                                            @for ($tahun=$tahunmulai; $tahun<=$tahunskrg; $tahun++) <option value="{{ $tahun }}" {{ date("Y") == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                                                @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary w-100" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                                <path d="M21 21l-6 -6"></path>
                                                            </svg>
                                                            Cari Data
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3"></path>
                                        <path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6"></path>
                                        <path d="M12 11v2a14 14 0 0 0 2.5 8"></path>
                                        <path d="M8 15a18 18 0 0 0 1.8 6"></path>
                                        <path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $rekappresensi->jmlhadir }}
                                </div>
                                <div class="text-muted">
                                    Pegawai Hadir
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        <path d="M9 9l1 0"></path>
                                        <path d="M9 13l6 0"></path>
                                        <path d="M9 17l6 0"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $rekapizin->jmlizin !=null ? $rekapizin->jmlizin : 0 }}
                                </div>
                                <div class="text-muted">
                                    Pegawai Izin
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-sick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18z"></path>
                                        <path d="M9 10h-.01"></path>
                                        <path d="M15 10h-.01"></path>
                                        <path d="M8 16l1 -1l1.5 1l1.5 -1l1.5 1l1.5 -1l1 1"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $rekapizin->jmlsakit !=null ? $rekapizin->jmlsakit : 0 }}
                                </div>
                                <div class="text-muted">
                                    Pegawai Sakit
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M16 6.072a8 8 0 1 1 -11.995 7.213l-.005 -.285l.005 -.285a8 8 0 0 1 11.995 -6.643zm-4 2.928a1 1 0 0 0 -1 1v3l.007 .117a1 1 0 0 0 .993 .883h2l.117 -.007a1 1 0 0 0 .883 -.993l-.007 -.117a1 1 0 0 0 -.993 -.883h-1v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor"></path>
                                        <path d="M6.412 3.191a1 1 0 0 1 1.273 1.539l-.097 .08l-2.75 2a1 1 0 0 1 -1.273 -1.54l.097 -.08l2.75 -2z" stroke-width="0" fill="currentColor"></path>
                                        <path d="M16.191 3.412a1 1 0 0 1 1.291 -.288l.106 .067l2.75 2a1 1 0 0 1 -1.07 1.685l-.106 -.067l-2.75 -2a1 1 0 0 1 -.22 -1.397z" stroke-width="0" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $rekappresensi->jmlterlambat }}
                                </div>
                                <div class="text-muted">
                                    Pegawai Terlambat
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div id="chartPegawai"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    var categories = <?php echo json_encode($categories) ?>;
    //Total Hadir
    var thnik1 = <?php echo json_encode($thnik1) ?>;
    var thnik2 = <?php echo json_encode($thnik2) ?>;
    var thnik3 = <?php echo json_encode($thnik3) ?>;
    var thnik4 = <?php echo json_encode($thnik4) ?>;
    var thnik5 = <?php echo json_encode($thnik5) ?>;
    var thnik6 = <?php echo json_encode($thnik6) ?>;
    var thnik7 = <?php echo json_encode($thnik7) ?>;
    var thnik8 = <?php echo json_encode($thnik8) ?>;
    var thnik9 = <?php echo json_encode($thnik9) ?>;
    var thnik10 = <?php echo json_encode($thnik10) ?>;
    var thnik11 = <?php echo json_encode($thnik11) ?>;
    var thnik12 = <?php echo json_encode($thnik12) ?>;
    var thnik13 = <?php echo json_encode($thnik13) ?>;
    var thnik99 = <?php echo json_encode($thnik99) ?>;
    //Total Terlambat
    var ttnik1 = <?php echo json_encode($ttnik1) ?>;
    var ttnik2 = <?php echo json_encode($ttnik2) ?>;
    var ttnik3 = <?php echo json_encode($ttnik3) ?>;
    var ttnik4 = <?php echo json_encode($ttnik4) ?>;
    var ttnik5 = <?php echo json_encode($ttnik5) ?>;
    var ttnik6 = <?php echo json_encode($ttnik6) ?>;
    var ttnik7 = <?php echo json_encode($ttnik7) ?>;
    var ttnik8 = <?php echo json_encode($ttnik8) ?>;
    var ttnik9 = <?php echo json_encode($ttnik9) ?>;
    var ttnik10 = <?php echo json_encode($ttnik10) ?>;
    var ttnik11 = <?php echo json_encode($ttnik11) ?>;
    var ttnik12 = <?php echo json_encode($ttnik12) ?>;
    var ttnik13 = <?php echo json_encode($ttnik13) ?>;
    var ttnik99 = <?php echo json_encode($ttnik99) ?>;

    Highcharts.chart('chartPegawai', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Chart Pegawai'
        },
        xAxis: {
            categories: categories,
            crosshair: true
        },
        yAxis: {
            min: 0,
            max: 30,
            title: {
                text: 'Hari'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f} hari</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true,
            theme: 'dark'
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Kehadiran',
            data: [thnik1, thnik2, thnik3, thnik4, thnik5, thnik6, thnik7, thnik8, thnik9, thnik10, thnik11, thnik12, thnik13, thnik99]

        }, {
            name: 'Telambat',
            data: [ttnik1, ttnik2, ttnik3, ttnik4, ttnik5, ttnik6, ttnik7, ttnik8, ttnik9, ttnik10, ttnik11, ttnik12, ttnik13, ttnik99]



        }]
    });
</script>
@endsection
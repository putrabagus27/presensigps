<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rekap Absensi Seluruh Pegawai</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
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
            font-size: 10px;
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

<body class="A3">
    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        list($h, $m, $s) = explode(":", $jam_masuk);
        $dtAwal = mktime($h, $m, $s, "1", "1", "1");
        list($h, $m, $s) = explode(":", $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode(".", $totalmenit / 60);
        $sisamenit = ($totalmenit / 60) - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ":" . round($sisamenit2);
    }
    ?>

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
                        REKAP ABSENSI PEGAWAI <br>
                        PERIODE {{ strtoupper ($namabulan[$bulan]) }} {{ $tahun }} <br>
                        PT. BALI SUMMER MANUFACTURE <br>
                    </span>
                    <span>
                        <i>Jalan Raya Muding Mundeh III No 30 Kerobokan Kaja</i>
                    </span>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="container-xl">
                <div id="chartPegawai">

                </div>
            </div>
        </div>
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
        <table width="100%" style="margin-top:100px">
            <tr>
                <td colspan="2" style="text-align: right">Denpasar, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: right; vertical-align: bottom" height="100px">
                    <u>Agus Natha</u><br>
                    <i><b>Komisaris</b></i>
                </td>
            </tr>
        </table>
        <!-- <p style="margin: top 50px;px">NB : <br> TT (Total Terlambat), TH (Total Hadir) <br> Warna Merah = Terlambat</p> -->

    </section>

</body>

</html>
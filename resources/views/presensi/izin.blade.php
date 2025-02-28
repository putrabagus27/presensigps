@extends('layouts.presensi')

<head>
    <title>Pengajuan Cuti</title>
</head>
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Data Cuti</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
        @endphp
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess }}
        </div>
        @endif
        @if(Session::get('error'))
        <div class="alert alert-danger">
            {{ $messageerror }}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        @foreach ($dataizin as $d)
        <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            <b>{{ date("d-m-Y", strtotime($d->tgl_izin)) }} ({{ $d->status == "s" ? "Sakit" : "Izin" }})</b>
                            <br>
                            <small class="text-muted">{{ $d->keterangan }}</small>
                        </div>
                        @if($d->status_approved == 0)
                        <span class="badge bg-warning">Menunggu</span>
                        @elseif($d->status_approved == 1)
                        <span class="badge bg-success">Disetujui</span>
                        @elseif($d->status_approved == 2)
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                        <span>
                            <form action="/presensi/{{ $d->id }}/delete" method="POST">
                                @csrf
                                <a class="btn btn-danger btn-sm delete-confirm">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                            </form>
                        </span>
                    </div>
                </div>
            </li>
        </ul>
        @endforeach
    </div>
</div>
<div class="icon"></div>
<div class="fab-button bottom-right" style="margin-bottom: 70px">
    <a href="/presensi/buatizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>
@endsection
@push('myscript')
<script>
    $(function() {
        $(".delete-confirm").click(function(e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: 'Yakin Ingin Dihapus?',
                text: "Data Ini Akan Terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus',
                        'success'
                    )
                }
            })
        });
    });
</script>
@endpush
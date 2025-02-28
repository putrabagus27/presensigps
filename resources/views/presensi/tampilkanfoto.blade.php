@foreach ($cuti as $d)
@php
$foto = Storage::url('uploads/cuti/'.$d->foto);
@endphp
<div class="foto">
    <img src="{{ url($foto) }}" alt="">
</div>
@endforeach
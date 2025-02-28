@if ($show->isEmpty())
<div class="alert alert-outline-warning">
    <p>Data Gaji Belum Ada</p>
</div>
@endif
@foreach ($show as $d)
<div class="col">
    <table class="table">
        <tr>
            <td>
                <h3>
                    <b>Tanggal Gaji</b>
                </h3>
            </td>
            <td colspan="2" class="text-right">
                <span>
                    <h4>{{ date("d-m-Y", strtotime($d->tgl_gaji)) }}</h4>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <b>Gaji Pokok</b>
                </h3>
            </td>
            <td colspan="2" class="text-right">
                <span>
                    <h4>@uang($d->gaji_pokok)</h4>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <b>Gaji Lembur</b>
                </h3>
            </td>
            <td colspan="2" class="text-right">
                <span>
                    <h4>@uang($d->gaji_lembur)</h4>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <b>Uang Makan</b>
                </h3>
            </td>
            <td colspan="2" class="text-right">
                <span>
                    <h4>@uang($d->uang_makan)</h4>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <b>Potongan Gaji</b>
                </h3>
            </td>
            <td colspan="2" class="text-right">
                <span>
                    <h4>@uang($d->pot_gaji )</h4>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    <b>Total Gaji</b>
                </h3>
            </td>
            <td colspan="2" class="text-right">
                <span>
                    <h4>@uang($d->total)</h4>
                </span>
            </td>
        </tr>
    </table>

</div>

@endforeach
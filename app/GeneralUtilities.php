<?php

namespace App;

class GeneralUtilities
{
    public function total($d)
    {
        return $d->gaji_pokok + $d->gaji_lembur + $d->uang_makan - $d->pot_gaji;
    }
}

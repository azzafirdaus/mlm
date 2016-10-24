<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ResetKartu extends Model
{
    protected $table = 'reset_kartu';
    public $timestamps = false;

    public static function getTotal($idperiode) {
        return DB::table('reset_kartu')->where('idperiode', $idperiode)->sum('saldo');
    }

    public static function clear() {
        DB::table('reset_kartu')->truncate();
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class RelasiKaki extends Model
{
    //
    protected $table = 'relasi_kaki';
    public $timestamps = false;
    
    public static function getKaki($id){
        $feet = DB::table('relasi_kaki')->where('idkepala', $id)->get();
        return $feet;
    }

    public static function getJumlahKaki($id){
        $feetcount = DB::table('relasi_kaki')->where('idkepala', $id)->count();
        return $feetcount;
    }

    public static function cekBukanKaki($idkepala, $idkaki){
        $feet = RelasiKaki::getKaki($idkepala);
        $status = True;

        foreach ($feet as $key => $foot) {
            if($foot->idkaki == $idkaki)
                $status = False;
        }

        return $status;
    }
}
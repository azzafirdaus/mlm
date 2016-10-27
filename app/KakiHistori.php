<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KakiHistori extends Model
{
    //
    protected $table = 'kaki_histori';
    public $timestamps = false;
    
    public static function deleteTuple($id) {
        DB::table('kaki_histori')->where('id', $id)->delete();   
    }
    
    /*public static function getId($noGelang) {
        return DB::table('kaki_histori')->where('id', $noGelang)->pluck('id_customer');
    }*/
    
     public static function clear() {
        DB::table('kaki_histori')->truncate();
    }
    
    /*public static function getTotalOn($id) {
        return DB::table('kaki_histori')->where('id', $id)->sum('total');
    }*/

    /*public static function getLaporanKasir() {
        return DB::table('kaki_histori')
        ->select('namakasir', DB::raw('count(case jenis when "Registrasi" then 1 else null end) as total_berapa, sum(total) as total_kasir'))
        ->groupBy('namakasir')
        ->where('idperiode', Periode::getActive())
        ->get();
    }*/
}
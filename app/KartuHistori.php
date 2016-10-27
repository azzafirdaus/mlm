<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KartuHistori extends Model
{
    //
    protected $table = 'kartu_histori';
    public $timestamps = false;
    
    public static function getAllTransaksi(){
        return DB::table('kartu_histori')->get();
    }

    public static function getTotalTransaksi(){
        return DB::table('kartu_histori')->count();
    }

    public static function getTotalOn($id) {
        return DB::table('kartu_histori')->where('idperiode', $id)->sum('total');
    }

    public static function getTotalTopupOn($id) {
        return DB::table('kartu_histori')->where('idperiode', $id)->where('jenis', 'Top Up')->sum('total');
    }

    public static function getTotalRegistrasiOn($id) {
        return DB::table('kartu_histori')->where('idperiode', $id)->where('jenis', 'Registrasi')->sum('total');
    }

    public static function getTotalTarikOn($id) {
        return DB::table('kartu_histori')->where('idperiode', $id)->where('jenis', 'Tarik Tunai')->sum('total');
    }

    public static function deleteTuple($id) {
        DB::table('kartu_histori')->where('id', $id)->delete();   
    }
    
    /*public static function getId($noGelang) {
        return DB::table('kartu_histori')->where('id', $noGelang)->pluck('id_customer');
    }*/
    
    public static function clear() {
        DB::table('kartu_histori')->truncate();
    }
    
    public static function getLaporanKasir() {
        return DB::table('kartu_histori')
        ->select('namakasir', DB::raw('count(case jenis when "Registrasi" then 1 else null end) as total_berapa, sum(total) as total_kasir'))
        ->groupBy('namakasir')
        ->where('idperiode', Periode::getActive())
        ->get();
    }
}
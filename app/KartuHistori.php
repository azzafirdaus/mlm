<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KartuHistori extends Model
{
    //
    protected $table = 'kartu_histori';
    public $timestamps = false;
    
    public static function getTotalTransaksi(){
        $transactions = DB::table('kartu_histori')->count();
        return $transactions;
    }

    public static function getAllTransaksi(){
        $transactions = DB::table('kartu_histori')->get();
        return $transactions;
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
    
    public static function getTotalOn($id) {
        return DB::table('kartu_histori')->where('id', $id)->sum('total');
    }

    public static function getLaporanKasir() {
        return DB::table('kartu_histori')
        ->select('namakasir', DB::raw('count(case jenis when "Registrasi" then 1 else null end) as total_berapa, sum(total) as total_kasir'))
        ->groupBy('namakasir')
        ->where('idperiode', Periode::getActive())
        ->get();
    }
}
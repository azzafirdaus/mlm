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

    public static function getTotalTransaksi($id){
        return DB::table('kartu_histori')->where('idperiode', $id)->count();
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
    
    public static function getLaporanKasir($idperiode = null) {
        if($idperiode == null){
            $idperiode = Periode::getLastId();
        }

        return DB::table('kartu_histori')
        ->select('namakasir', DB::raw('count(case jenis when "Registrasi" then 1 else null end) as totalregister,
            sum(case jenis when "Registrasi" then total else null end) as jumlahregistrasi,
            sum(case jenis when "Top Up" then total else null end) as jumlahtopup, 
            sum(case jenis when "Tarik Tunai" then total else null end) as jumlahtarik'))
        ->groupBy('namakasir')
        ->where('idperiode', $idperiode)
        ->get();
    }

    public static function getByDate($startdate = null, $enddate = null){
        $periods = DB::table('kartu_histori')
            ->whereBetween('tanggal', [$startdate, $enddate])
            ->distinct()
            ->lists('idperiode');

        return $periods;
    }

    public static function getJumlahRegistrasi($id){
        return DB::table('kartu_histori')->where('idperiode', $id)->where('jenis', 'Registrasi')->count();
    }
}
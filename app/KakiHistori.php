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
    
    public static function getByDate($startdate = null, $enddate = null){
        $periods = DB::table('kaki_histori')
            ->whereBetween('tanggal', [$startdate, $enddate])
            ->distinct()
            ->lists('idperiode');

        return $periods;
    }
}
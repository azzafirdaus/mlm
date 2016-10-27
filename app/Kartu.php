<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kartu extends Model
{
    //
    protected $table = 'kartu';
    public $timestamps = false;
    
    public static function checkAvailable($id)
    {
        $availability = DB::table('kartu')->where('id', '=', $id)->count();
        return $availability;
    }
    
    public static function getSaldo($id) {
        return DB::table('kartu')->where('id', $id)->pluck('saldo');
    }  
    
    public static function addSaldo($id, $jumlah) {
        $saldo = Kartu::getSaldo($id);
        DB::table('kartu')->where('id', $id)->update(['saldo' => $saldo + $jumlah]);
    }  
    
    public static function minSaldo($id, $jumlah) {
        $saldo = Kartu::getSaldo($id);
        DB::table('kartu')->where('id', $id)->update(['saldo' => $saldo - $jumlah]);
    }

    public static function resetSaldo($id) {
        $saldo = Kartu::getSaldo($id);
        DB::table('kartu')->where('id', $id)->update(['saldo' => 0]);
        
        return $saldo;
    }

    public static function isActive($id) {
        $status = DB::table('kartu')->where('id', $id)->pluck('isactive');
        
        return $status;
    }

    public static function isKaki($id) {
        $status = DB::table('kartu')->where('id', $id)->pluck('iskaki');
        
        return $status;
    }

    
}
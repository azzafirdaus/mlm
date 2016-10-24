<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tarif extends Model
{
    //
    protected $table = 'tarif';
    public $timestamps = false;
    
    public static function add($nama, $price) {

        $item = new Tarif;

        $item->nama = $nama;
        $item->harga = $price;
        
        $item->save();
    }
    
    public static function getNama($id) {
        return DB::table('tarif')->where('id', $id)->pluck('nama');;
    } 
                                        
    public static function getHarga($nama) {
        return DB::table('tarif')->where('nama', $nama)->pluck('harga');;
    }
    
    public static function updateNama($id, $nama) {
        DB::table('tarif')->where('id', $id)->update(['nama' => $nama]);;
    }
                                        
    public static function updateHarga($id, $price) {
        DB::table('tarif')->where('id', $id)->update(['harga' => $price]);;
    }
                                        
    public static function deleteItem($id) {        
        DB::table('tarif')->where('id', $id)->delete();
    }
}
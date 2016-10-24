<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kartu;
use App\KartuHistori;
use App\Periode;
use App\Tarif;
use App\RelasiKaki;
use Validator, Input, Auth;

class PlayerController extends Controller{

    public function saldo(){
        if(Periode::activeExist() == 1) {
            return view('player.saldo');     
        } else {
            return redirect('player')
            	->withErrors('Transaksi belum dibuka');
        }
    }

    public function cekSaldo(){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('player/saldo')->withErrors($validator);
        } else{
            $idkartu = Input::get('idkartu');

            if(Kartu::checkAvailable($idkartu) == 0) {            
                return redirect('player/saldo')->withErrors("No kartu belum terdaftar");
            } elseif(!Kartu::isActive($idkartu)){
                return redirect('player/saldo')->withErrors("Status kartu masih disable, anda belum dapat melihat saldo");
            } else{
                return view('player.saldo-show')
                    ->with('saldo', Kartu::getSaldo($idkartu));   
            }
        }
    }

    public function kaki(){

       	if(Periode::activeExist() == 1) {
            return view('player.kaki');     
        } else {
            return redirect('player')->withErrors('Transaksi belum dibuka');
        }
    }

    public function cekKaki(){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('player/kaki')->withErrors($validator);
        } else{
            $idkartu = Input::get('idkartu');

            if(Kartu::checkAvailable($idkartu) == 0) {            
                return redirect('player/kaki')->withErrors("No kartu belum terdaftar");
            }else{
                return view('player.kaki-show')
                    ->with('jumlahkaki', RelasiKaki::getJumlahKaki($idkartu));   
            }
        }
    }
}
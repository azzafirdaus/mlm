<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kartu;
use App\KartuHistori;
use App\KakiHistori;
use App\Periode;
use App\Tarif;
use App\RelasiKaki;
use Validator, Input, Auth;

class PlayerController extends Controller{

    /**
     * Saldo page.
     *
     * @return void
     */
    public function saldo(){
        if(Periode::activeExist() == 1) {
            return view('player.saldo');     
        }   
        return redirect('player')->withErrors('Transaksi belum dibuka');
    }

    /**
     * Show saldo.
     *
     * @return void
     */
    public function cekSaldo(){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()){
            $idkartu = Input::get('idkartu');

            if(Kartu::checkAvailable($idkartu) != 0) {            
                if(Kartu::isActive($idkartu)) {
                    return view('player.saldo-show')->with('saldo', Kartu::getSaldo($idkartu));
                }
                return redirect('player/saldo')->withErrors("Status kartu masih disable, anda belum dapat melihat saldo");
            } 
            return redirect('player/saldo')->withErrors("No kartu belum terdaftar");
        }
        return redirect('player/saldo')->withErrors($validator);
    }

    /**
     * Daftar kaki initialized.
     *
     * @return void
     */
    public function daftar(){
        if(Periode::activeExist() == 1) {
            return view('player.daftar')
                ->with('jumlahkaki', 3)
                ->with('idkepala', '');     
        }
        return redirect('player')->withErrors('Transaksi belum dibuka');
    }

    /**
     * Daftar kepala page.
     *
     * @return void
     */
    public function daftarKepala(){
        if(Periode::activeExist() == 1) {
            return view('player.partial.form-kepala');
        } 
        return redirect('player')->withErrors('Transaksi belum dibuka');
    }

    /**
     * Daftar kepala proceed.
     *
     * @return void
     */
    public function submitKepala(Request $request){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()){
            $idkartu = Input::get('idkartu');

            if(Kartu::checkAvailable($idkartu) != 0) {     
                if(Kartu::isKaki($idkartu) == true) {
                    if(RelasiKaki::getJumlahKaki($idkartu) < 2) {
                        $request->session()->put('idkepala', $idkartu);

                        return view('player.daftar')
                            ->with('jumlahkaki', RelasiKaki::getJumlahKaki($idkartu))
                            ->with('success', 'Nomor kartu kepala berhasil dimasukkan')
                            ->with('idkepala', $idkartu);
                    }
                    return view('player.daftar')
                        ->with('jumlahkaki', RelasiKaki::getJumlahKaki($idkartu))
                        ->with('success', 'Nomor kartu kepala sudah memiliki dua kaki')
                        ->with('idkepala', $idkartu);
                }
                return redirect('player/daftar/kepala')->withErrors("No kartu belum menjadi kaki");
            } 
            return redirect('player/daftar/kepala')->withErrors("No kartu belum terdaftar");
        } 
        return redirect('player/daftar/kepala')->withErrors($validator);
    }
    
    /**
     * Daftar kaki page.
     *
     * @return void
     */
    public function daftarKaki(){
        if(Periode::activeExist() == 1) {
            
            return view('player.partial.form-kaki');
        
        } 
        return redirect('player')->withErrors('Transaksi belum dibuka');
    }    

    /**
     * Daftar kaki proceed.
     *
     * @return void
     */
    public function submitKaki(Request $request){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()){

            $idkaki = Input::get('idkartu');
            $idkepala = $request->session()->get('idkepala');

            if(Kartu::checkAvailable($idkaki) != 0) {
                
                if($idkaki != $idkepala) {
                
                    if(Kartu::isKaki($idkaki) == false) {
                
                        if(Kartu::getSaldo($idkaki) >= 500000 ) {
                
                            // if(RelasiKaki::cekBukanKaki($idkaki, $idkepala)) {

                                //ubah status iskaki kartu menjadi aktif
                                $kaki = Kartu::where('id', $idkaki)->first();
                                $kaki->iskaki = true;
                                $kaki->isactive = false;
                                $kaki->save();

                                //hapus semua relasi sebelumnya
                                RelasiKaki::where('idkepala', $idkaki)->delete();

                                //tambah kurang saldo
                                $badmin = Tarif::getHarga('Administrasi');
                                $bkaki = Tarif::getHarga('Kaki');

                                Kartu::minSaldo($idkaki, ($badmin + $bkaki));
                                Kartu::addSaldo($idkepala, $bkaki);

                                //bikin relasi baru
                                $relasikaki = new RelasiKaki;
                                $relasikaki->idkepala = $idkepala;
                                $relasikaki->idkaki =  $idkaki;
                                $relasikaki->save();

                                //pencatatan transaksi kaki
                                $kakihistori = new KakiHistori;
                                $kakihistori->idkepala = $idkepala;
                                $kakihistori->idkaki =  $idkaki;
                                $kakihistori->total =  $badmin;
                                $kakihistori->idperiode = Periode::getActive();
                                $kakihistori->save();

                                //taro data di session
                                $request->session()->put('idkepala', $idkepala);
                                $request->session()->put('idkaki', $idkaki);

                                //ubah status iskaki kepala menjadi false, sampe dia daftar jadi kaki lagi
                                if(RelasiKaki::getJumlahKaki($idkepala) == 1){
                                    $kepala = Kartu::where('id', $idkepala)->first();
                                    $kepala->isactive = false;
                                    $kepala->save();
                                }
                                elseif(RelasiKaki::getJumlahKaki($idkepala) == 2){
                                    $kepala = Kartu::where('id', $idkepala)->first();
                                    $kepala->iskaki = false;
                                    $kepala->isactive = true;
                                    $kepala->save();
                                }

                                return view('player.daftar')
                                    ->with('jumlahkaki', RelasiKaki::getJumlahKaki($idkepala))
                                    ->with('success', 'Nomor kartu kaki berhasil dimasukkan')
                                    ->with('idkepala', $idkepala);
                            // }
                            // return redirect('player/daftar/kaki')->withErrors("Kartu kepala tidak dapat dijadikan kaki");
                        }
                        return redirect('player/daftar/kaki')->withErrors("Maaf saldo anda tidak mencukupi");
                    }
                    return redirect('player/daftar/kaki')->withErrors("No kartu sudah menjadi kaki");
                }
                return redirect('player/daftar/kaki')->withErrors("Kartu kaki tidak boleh sama dengan kepala"); 
            } 
            return redirect('player/daftar/kaki')->withErrors("No kartu belum terdaftar");
        } 
        return redirect('player/daftar/kaki')->withErrors($validator);
    }

    /**
     * Kaki page.
     *
     * @return void
     */
    public function kaki(){
        if(Periode::activeExist() == 1) {
            return view('player.kaki');        
        }  
        return redirect('player')->withErrors('Transaksi belum dibuka');
    }

    /**
     * Kaki show proceed.
     *
     * @return void
     */
    public function cekKaki(){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()){
            $idkartu = Input::get('idkartu');

            if(Kartu::checkAvailable($idkartu) != 0) {            
                return view('player.kaki-show')->with('jumlahkaki', RelasiKaki::getJumlahKaki($idkartu));   
            }
            return redirect('player/kaki')->withErrors("No kartu belum terdaftar");
        } 
        return redirect('player/kaki')->withErrors($validator);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth, Validator, Input;
use App\Periode;
use App\Kartu;
use App\Tarif;
use App\User;
use App\KartuHistori;
use App\ResetKartu;
use Form;

class PembayaranController extends Controller{
    //

    public function pembayaran(){

    	if(Auth::check()){

        if(Periode::activeExist() == 1) {
		  	return view('pembayaran')->with('Form', new Form);     
        } else {
            return redirect('cashierMenu')->withErrors('Transaksi belum dibuka');
        }
    	}

    	return redirect('/auth/cashierLogin')->with('loginError', 'Please login first!');
    }

    public function pendapatan_terapis(){

        return view('pendapatan-terapis')->with('success', '');
    }

    public function pendapatan_terapis_show(){
        
        $rules = array(
            'noTerapis' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);


        if($validator->fails()){

            return redirect('pendapatan-terapis')->withErrors($validator)->with('success', '');
        }

        $terapis = Input::get('noTerapis');
        if (Terapis::countExist($terapis) == 0) {
            return redirect('pendapatan-terapis')->withErrors('No. Kartu terapis tidak terdaftar')->with('success', '');
        }
        
        $transaksi = TransaksiMassage::getByTerapis($terapis, Periode::getLastId());
        
            $total = 0;
            $data = array();
            $count = 0;
            
            foreach($transaksi as $terapi) {
                $count++;
                $total += $terapi->refund * 0.1 ;
            }
        
            
            array_push($data, 
                      [
                        'qty' => $count,
                        'isi' => 'Massage',                      
                        'jumlah' => $total
                      ]
                      );
        
        return view('pendapatan-terapis-show')->with('noTerapis', Input::get('noTerapis'))->with('transaksi', $data)->with('total', $total)->with('ob', Fasilitas::getHarga('OB', ''));
    }

    public function printTopUp() {
        
        return view('cashierMenuClose')->with('success', 'Top Up saldo berhasil');
    }
    
    public function pembayaran_show(){
        
        $rules = array(
			'noGelang' => 'required',
			'jmlTopUp' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);


		if($validator->fails()){

			return redirect('pembayaran')->withErrors($validator);
		}
        
        $noGelang = Input::get('noGelang');
        $jumlah = Input::get('jmlTopUp');
        
        if(Kartu::checkAvailable($noGelang) == 0) {
            
			return redirect('pembayaran')->withErrors("No kartu belum dipakai");
        }
        
        $saldo = Kartu::getSaldo($noGelang);
        
        
        Kartu::addSaldo($noGelang, $jumlah);
        
        
        $transaksi = new KartuHistori;
        $transaksi->idkartu = $noGelang;
        $transaksi->jenis = 'Top Up';
        $transaksi->total = $jumlah;
        $transaksi->namakasir = User::getName(Auth::user()->username);
        $transaksi->idperiode = Periode::getActive();
        $transaksi->save();

        return view('pembayaran-show')
            ->with('noKartu', $noGelang)
            ->with('sebelum', $saldo)
            ->with('jumlah', $jumlah);
    }
    
    public function pendapatanPrint(){
            return view('pendapatan-terapis')->with('success', 'Pembayaran terapis berhasil');
    }

    public function kosongkanKartu(){

        if(Auth::check()){
            if(Periode::activeExist() == 1) {
                return view('cashier.kosongkan-kartu')->with('saldo', 0)->with('jumlah', ResetKartu::getTotal(Periode::getActive()));     
            } else {
                return redirect('cashierMenu')->withErrors('Transaksi belum dibuka');
            }
        }

        return redirect('/auth/cashierLogin')->with('loginError', 'Please login first!');
    }

    public function kosongkanSaldo(){
        
        $rules = array(
            'noGelang' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);  

        if($validator->fails()){

            return view('cashier.kosongkan-kartu')->withErrors($validator)->with('jumlah', ResetKartu::getTotal(Periode::getActive()))->with('saldo', 0);
        }
        
        $noGelang = Input::get('noGelang');
        
        
        if(Kartu::checkAvailable($noGelang) == 0) {
            return view('cashier.kosongkan-kartu')->withErrors("No kartu belum dipakai")->with('jumlah', ResetKartu::getTotal(Periode::getActive()))->with('saldo', 0);
        } else{    
            $sisaSaldo = Kartu::resetSaldo($noGelang);

            $transaksi = new ResetKartu;
            $transaksi->id_gelang = $noGelang;
            $transaksi->saldo = $sisaSaldo;
            $transaksi->id_periode = Periode::getActive();
            $transaksi->save();

            return view('cashier.kosongkan-kartu')
                ->with('saldo', $sisaSaldo)
                ->with('jumlah', ResetKartu::getTotal(Periode::getActive()));
        
        }
    }

    public function pendapatanTerapisOtomatis(){

        return view('terapis.terapis-pendapatan')->with('success', '');
    }

    public function pendapatanTerapisShow(){
        
        $rules = array(
            'noTerapis' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);


        if($validator->fails()){

            return view('terapis.terapis-pendapatan')->withErrors($validator)->with('success', '');
        }

        $terapis = Input::get('noTerapis');
        if (Terapis::countExist($terapis) == 0) {
            return view('terapis.terapis-pendapatan')->withErrors('No. Kartu terapis tidak terdaftar')->with('success', '');
        }
        
        $transaksi = TransaksiMassage::getByTerapis($terapis, Periode::getLastId());
        
            $total = 0;
            $data = array();
            $count = 0;
            
            foreach($transaksi as $terapi) {
                $count++;
                $total += $terapi->refund * 0.1 ;
            }
        
            
            array_push($data, 
                      [
                        'qty' => $count,
                        'isi' => 'Massage',                      
                        'jumlah' => $total
                      ]
                      );
        
        return view('terapis.terapis-pendapatan-show')->with('noTerapis', Input::get('noTerapis'))->with('transaksi', $data)->with('total', $total)->with('ob', Fasilitas::getHarga('OB', ''));
    }

    public function printPendapatan(){
            return view('terapis.terapis-pendapatan')->with('success', 'Pembayaran terapis berhasil');
    }
}

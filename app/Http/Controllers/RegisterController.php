<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Kartu;
use App\Periode;
use App\KartuHistori;
use Validator, Input, Redirect, Auth, Hash; 

class RegisterController extends Controller {

	public function register(){
        if(Periode::activeExist() == 1) {
		  	return view('auth/register');     
        } else {
            return redirect('cashierMenu')->withErrors('Transaksi belum dibuka');
        }
	}

	public function regisProcess(){
		
		$rules = array(
			'saldoKartu' => 'required',
			'noGelang' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){

			return redirect('auth/register')->withErrors($validator);
		}

		$saldo = Input::get('saldoKartu');
		$no_gelang = Input::get('noGelang'); 
		
        if(Kartu::checkAvailable($no_gelang) != 0) {
            return redirect('auth/register')->withErrors('Nomer kartu telah digunakan');
        }
        
		$customer = new Kartu;
        $customer->id = $no_gelang;
        $customer->saldo = $saldo;
        $customer->isactive = false;
        $customer->save();
        
        $transaksi = new KartuHistori;
        $transaksi->idkartu = $no_gelang;
        $transaksi->jenis = 'Registrasi';
        $transaksi->total = $saldo;
        $transaksi->namakasir = User::getName(Auth::user()->username);
        $transaksi->idperiode = Periode::getActive();
        $transaksi->save();
        
        
//        $id = Customer::getId($nama, $tglLahir);
//        
//        $KartuHistori = new KartuHistori;
//        $KartuHistori->id_customer = $id;
//        $KartuHistori->id_gelang = $no_gelang;
//        $KartuHistori->save();
//        
//        Periode::plus();
        
        return view('auth/registerInvoice')
        ->with('noKartu', $no_gelang)
        ->with('saldo', $saldo);
		
	}

	public function regisPrint(){

		return view('cashierMenuClose')->with('success', 'Registrasi customer berhasil');
	}
}


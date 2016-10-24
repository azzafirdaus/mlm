<?php

namespace App\Http\Controllers;

use Auth, Validator, Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Periode;
use App\User;
use App\Kartu;
use App\ResetKartu;
use App\KartuHistori;
use App\RelasiKaki;
use Form;

class CashierController extends Controller{

    public function login(){
        
        $rules = array(
            'username' => 'required',           
            'password' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('auth/cashierlogin')->withErrors($validator);
        }
        else{
            $user = array(
                'username' => Input::get('username'),
                'password' => Input::get('password') 
            );        
            
            if(Auth::attempt($user)){
                $role = User::getRole(Input::get('username'));
                
                if ($role == "cashier") {
                    
                    $isopen = Periode::activeExist() == 1 ? True : False;
                
                    return redirect('/cashier');
                }
            }
            return redirect('auth/cashierlogin')
                ->with('loginError', 'Wrong username or password');    
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('auth/cashierlogin');
    }

    public function menu(){

    	if(Auth::check()){
            $id = Auth::user()->id; 
            $role = User::getRoles($id);
            
            if ($role == "cashier") {
                if(Periode::activeExist() == 1) {
                    return view('cashier.menu-close')
                        ->with('success', '');
                } else {
                    return view('cashier.menu')
                        ->with('success', '');
                }
            }
    	} 

    	return redirect('auth/cashierlogin')->with('loginError', 'Please login first!');
    }
    
    public function open() {
        $password = Input::get('password');
        $user = User::where('role', 'anton')->take(1);

        /*$user = array(
			'username' => ($username = User::where('role', 'anton')->take(1)->pluck('username')),
			'password' => Input::get('password') 
		);*/    
        
        if(Hash::check($password, $user->pluck('password'))){
            Periode::start();
            if (Periode::getLastId() % 3 == 0) {
                //kalo ada data table yg mau dihapus
                // ResetKartu::clear();
                // KartuHistori::clear();
            } 
            return redirect('cashier/open');
        }
        
        return view('cashier.menu')
            ->withErrors('Wrong password')
            ->with('success', '');
        
    }
    
    public function close() {
                
        $password = Input::get('password');
        $user = User::where('role', 'anton')->take(1);

        /*$user = array(
            'username' => ($username = User::where('role', 'anton')->take(1)->pluck('username')),
            'password' => Input::get('password') 
        );*/    
        
        if(Hash::check($password, $user->pluck('password'))){
            Periode::stop();
            return redirect('cashier/close');
		}
        
        return view('cashier.menu-close')
            ->withErrors('Wrong password')
            ->with('success', '');
    }

    public function topup(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.topup')->with('Form', new Form);     
            } else {
                return redirect('cashier')->withErrors('Transaksi belum dibuka');
            }
        }

        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    public function topupShow(){
        
        $rules = array(
            'idkartu' => 'required',
            'jumlahtopup' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){

            return redirect('cashier/topup')->withErrors($validator);
        } else{
            $idkartu = Input::get('idkartu');
            $jumlahtopup = Input::get('jumlahtopup');
            
            if(Kartu::checkAvailable($idkartu) == 0) {
                
                return redirect('cashier/topup')->withErrors("No kartu belum terdaftar");
            }
            
            $saldo = Kartu::getSaldo($idkartu);
            
            Kartu::addSaldo($idkartu, $jumlahtopup);
            
            
            $transaksi = new KartuHistori;
            $transaksi->idkartu = $idkartu;
            $transaksi->jenis = 'Top Up';
            $transaksi->total = $jumlahtopup;
            $transaksi->namakasir = User::getName(Auth::user()->username);
            $transaksi->idperiode = Periode::getActive();
            $transaksi->save();

            return view('cashier.topup-show')
                ->with('idkartu', $idkartu)
                ->with('sebelum', $saldo)
                ->with('jumlahtopup', $jumlahtopup);
        }
    }

    public function saldo(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.saldo');     
            } else {
                return redirect('cashier')->withErrors('Transaksi belum dibuka');
            }
        }

        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    public function cekSaldo(){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('cashier/saldo')->withErrors($validator);
        } else{
            $idkartu = Input::get('idkartu');

            if(Kartu::checkAvailable($idkartu) == 0) {            
                return redirect('cashier/saldo')->withErrors("No kartu belum terdaftar");
            }elseif(!Kartu::isActive($idkartu)){
                return redirect('cashier/saldo')->withErrors("Status kartu masih disable");
            }else{
                return view('cashier.saldo-show')
                    ->with('saldo', Kartu::getSaldo($idkartu));   
            }
        }
    }

    public function kaki(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.kaki');     
            } else {
                return redirect('cashier')->withErrors('Transaksi belum dibuka');
            }
        }

        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    public function cekKaki(){
        
        $rules = array(
            'idkartu' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('cashier/kaki')->withErrors($validator);
        } else{
            $idkartu = Input::get('idkartu');

            if(Kartu::checkAvailable($idkartu) == 0) {            
                return redirect('cashier/kaki')->withErrors("No kartu belum terdaftar");
            }else{
                return view('cashier.kaki-show')
                    ->with('jumlahkaki', RelasiKaki::getJumlahKaki($idkartu));   
            }
        }
    }

    public function reset(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.reset-kartu');     
            } else {
                return redirect('cashier')->withErrors('Transaksi belum dibuka');
            }
        }

        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    public function resetKartu(){
        
        $rules = array(
            'idkartu' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);  

        if($validator->fails()){
            return view('cashier.reset-kartu-show')
                ->withErrors($validator)
                ->with('jumlah', ResetKartu::getTotal(Periode::getActive()))
                ->with('saldo', 0);
        }else{
            $idkartu = Input::get('idkartu');
        
            if(Kartu::checkAvailable($idkartu) == 0) {
                return view('cashier.reset-kartu-show')
                    ->withErrors("No kartu belum dipakai")
                    ->with('jumlah', ResetKartu::getTotal(Periode::getActive()))
                    ->with('saldo', 0);
            } elseif(!Kartu::isActive($idkartu)){
                return view('cashier.reset-kartu-show')
                    ->withErrors("Status kartu belum aktif, jumlah kaki belum mencukupi")
                    ->with('jumlah', ResetKartu::getTotal(Periode::getActive()))
                    ->with('saldo', 0);
            } else{
                $sisaSaldo = Kartu::resetSaldo($idkartu);

                if($sisaSaldo > 0) {
                    $transaksi = new ResetKartu;
                    $transaksi->idkartu = $idkartu;
                    $transaksi->saldo = $sisaSaldo;
                    $transaksi->idperiode = Periode::getActive();
                    $transaksi->save();  
                }
                
                return view('cashier.reset-kartu-show')
                    ->with('saldo', $sisaSaldo)
                    ->with('idkartu', $idkartu)
                    ->with('jumlah', ResetKartu::getTotal(Periode::getActive()));
            
            }
        } 
    }

    public function register(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.register');     
            } else {
                return redirect('cashier')->withErrors('Transaksi belum dibuka');
            }
        }

        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    public function registerProcess(){
        
        $rules = array(
            'idkartu' => 'required',
            'saldo' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('cashier/register')->withErrors($validator);
        }else{
            $saldo = Input::get('saldo');
            $idkartu = Input::get('idkartu'); 
            
            if(Kartu::checkAvailable($idkartu) != 0) {
                return redirect('cashier/register')->withErrors('Nomer kartu telah digunakan');
            } else {    
                $member = new Kartu;
                $member->id = $idkartu;
                $member->saldo = $saldo;
                $member->isactive = false;
                $member->save();
                
                $transaksi = new KartuHistori;
                $transaksi->idkartu = $idkartu;
                $transaksi->jenis = 'Registrasi';
                $transaksi->total = $saldo;
                $transaksi->namakasir = User::getName(Auth::user()->username);
                $transaksi->idperiode = Periode::getActive();
                $transaksi->save();
                
                return view('cashier.register-invoice')
                    ->with('idkartu', $idkartu)
                    ->with('saldo', $saldo);
            
            }
        }
    }
}

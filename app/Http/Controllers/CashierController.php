<?php

namespace App\Http\Controllers;

use Auth, Validator, Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Periode;
use App\User;
use App\Kartu;
use App\ResetKartu;
use App\KartuHistori;
use App\RelasiKaki;
use Form;

class CashierController extends Controller{

    /**
     * Cashier login
     *
     * @return void
     */
    public function login(){
        
        $rules = array(
            'username' => 'required',           
            'password' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()){
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
            return redirect('auth/cashierlogin')->with('loginError', 'Wrong username or password');
        }
        return redirect('auth/cashierlogin')->withErrors($validator);
    }

    /**
     * Logout.
     *
     * @return void
     */
    public function logout(){
        Auth::logout();
        return redirect('auth/cashierlogin');
    }

    /**
     * Menu.
     *
     * @return void
     */
    public function menu(){

    	if(Auth::check()){
            $id = Auth::user()->id; 
            $role = User::getRoles($id);
            
            if ($role == "cashier") {
                if(Periode::activeExist() == 1) {
                    return view('cashier.menu-close');
                }
                return view('cashier.menu');
            }
    	} 
    	return redirect('auth/cashierlogin')->with('loginError', 'Please login first!');
    }
    
    /**
     * Open transaction.
     *
     * @return void
     */
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
        return view('cashier.menu')->withErrors('Wrong password');        
    }
    
    /**
     * Close transaction.
     *
     * @return void
     */
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
        return view('cashier.menu-close')->withErrors('Wrong password');
    }

    /**
     * Registration page.
     *
     * @return void
     */
    public function register(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.register');     
            }
            return redirect('cashier')->withErrors('Transaksi belum dibuka');
        }
        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Register new member/kartu.
     *
     * @return void
     */
    public function registerProcess(){
        
        $rules = array(
            'idkartu' => 'required',
            'saldo' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()){
            $idkartu = Input::get('idkartu'); 
            $saldo = Input::get('saldo');
            
            if(Kartu::checkAvailable($idkartu) == 0) {
                $kartu = new Kartu;
                $kartu->id = $idkartu;
                $kartu->saldo = $saldo;
                $kartu->isactive = true;
                $kartu->save();
                
                $transaksi = new KartuHistori;
                $transaksi->idkartu = $idkartu;
                $transaksi->jenis = 'Registrasi';
                $transaksi->total = $saldo;
                $transaksi->namakasir = User::getName(Auth::user()->username);
                $transaksi->idperiode = Periode::getActive();
                $transaksi->save();
                
                return view('cashier.register-invoice')
                    ->with('idkartu', $idkartu)
                    ->with('saldo', $saldo)
                    ->with('date', Periode::getLastDate());
            }    
            return redirect('cashier/register')->withErrors('Nomer kartu telah digunakan');            
        }
        return redirect('cashier/register')->withErrors($validator);
    }

    /**
     * Topup page.
     *
     * @return void
     */
    public function topup(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.topup')->with('Form', new Form);     
            }
            return redirect('cashier')->withErrors('Transaksi belum dibuka');
        }

        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Topup saldo.
     *
     * @return void
     */
    public function topupShow(){
        
        $rules = array(
            'idkartu' => 'required',
            'jumlahtopup' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if(!$validator->fails()){
            $idkartu = Input::get('idkartu');
            $jumlahtopup = Input::get('jumlahtopup');
            
            if(Kartu::checkAvailable($idkartu) != 0) {
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
                    ->with('jumlahtopup', $jumlahtopup)
                    ->with('date', Periode::getLastDate());   
            }
            return redirect('cashier/topup')->withErrors("No kartu belum terdaftar");
        }
        return redirect('cashier/topup')->withErrors($validator);
    }

    /**
     * Saldo page.
     *
     * @return void
     */
    public function saldo(){

        if(Auth::check()){
            if(Periode::activeExist() == 1) {
                return view('cashier.saldo');     
            }   
            return redirect('cashier')->withErrors('Transaksi belum dibuka');
        }
        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Saldo results.
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
            
                    return view('cashier.saldo-show')->with('saldo', Kartu::getSaldo($idkartu));   
                }
                return redirect('cashier/saldo')->withErrors("Status kartu masih disable");
            }
            return redirect('cashier/saldo')->withErrors("No kartu belum terdaftar");
        }   
        return redirect('cashier/saldo')->withErrors($validator);
    }

    /**
     * Tarik tunai page.
     *
     * @return void
     */
    public function tarik(){

        if(Auth::check()){

            if(Periode::activeExist() == 1) {
                return view('cashier.tarik');     
            }  
            return redirect('cashier')->withErrors('Transaksi belum dibuka');
        }
        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Tarik tunai result.
     *
     * @return void
     */
    public function tarikSaldo(){
        
        $rules = array(
            'idkartu' => 'required',
            'jumlahtarik' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);  

        if(!$validator->fails()){
            $idkartu = Input::get('idkartu');
            $jumlahtarik = Input::get('jumlahtarik');

            if(Kartu::checkAvailable($idkartu) != 0) {
                if(Kartu::isActive($idkartu)){
                    $saldo = Kartu::getSaldo($idkartu);

                    if($saldo >= $jumlahtarik) {
                        Kartu::minSaldo($idkartu, $jumlahtarik);                        

                        $transaksi = new KartuHistori;
                        $transaksi->idkartu = $idkartu;
                        $transaksi->jenis = 'Tarik Tunai';
                        $transaksi->total = $jumlahtarik;
                        $transaksi->namakasir = User::getName(Auth::user()->username);
                        $transaksi->idperiode = Periode::getActive();
                        $transaksi->save();

                        return view('cashier.tarik-show')
                            ->with('idkartu', $idkartu)
                            ->with('saldo', $saldo)
                            ->with('jumlahtarik', $jumlahtarik)
                            ->with('date', Periode::getLastDate());
                    }
                    return redirect('cashier/tarik')->withErrors("Saldo anda kurang dari jumlah tarikan");
                }
                return redirect('cashier/tarik')->withErrors("Status kartu belum aktif, jumlah kaki belum mencukupi");
            } 
            return redirect('cashier/tarik')->withErrors("No kartu belum dipakai");
        }
        return redirect('cashier/tarik')->withErrors($validator);
    }

    /**
     * Kaki page.
     *
     * @return void
     */
    public function kaki(){
        if(Auth::check()){
            if(Periode::activeExist() == 1) {
                return view('cashier.kaki');     
            }   
            return redirect('cashier')->withErrors('Transaksi belum dibuka');
        }
        return redirect('/auth/cashierlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Kaki result.
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
                return view('cashier.kaki-show')->with('jumlahkaki', RelasiKaki::getJumlahKaki($idkartu)); 
            }
            return redirect('cashier/kaki')->withErrors("No kartu belum terdaftar");    
        } 
        return redirect('cashier/kaki')->withErrors($validator);
    }
}

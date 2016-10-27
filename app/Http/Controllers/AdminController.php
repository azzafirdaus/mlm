<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth, Validator, Input, DB;
use App\User;
use App\Tarif;
use App\Periode;
use App\KartuHistori;
use App\KakiHistori;
use App\Kartu;

class AdminController extends Controller{
   
    /**
     * Admin login
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
                return redirect('admin')->with('activePage', 'home');
            }
            return redirect('auth/adminlogin')->with('loginError', 'Wrong username or password');
        }
        return redirect('auth/cashierlogin')->withErrors($validator);
    }
    
    /**
     * Admin logout.
     *
     * @return void
     */
    public function logout(){
        Auth::logout();
        return redirect('auth/adminlogin');
    }

    /**
     * Admin dashboard.
     *
     * @return void
     */
    public function dashboard(){
        if(Auth::check()){
            return view('admin.pages.dashboard')
                ->with('total', KartuHistori::getTotalTransaksi(Periode::getLastId()))
                ->with('activePage', 'dashboard');  
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan keseluruhan.
     *
     * @return void
     */
    public function laporan($tanggal = null){
        if(Auth::check()){   
            $date = date('Y-m-d', strtotime(Periode::getLastDate()));
            
            $totalTopup = KartuHistori::getTotalTopupOn(Periode::getLastId());
            $totalRegister = KartuHistori::getTotalRegistrasiOn(Periode::getLastId());
            $totalTarik = KartuHistori::getTotalTarikOn(Periode::getLastId());
            
            return view('admin.pages.laporan.kas')
                ->with('lastDate', $date)
                ->with('totalTopup', $totalTopup)
                ->with('totalRegister', $totalRegister)
                ->with('totalTarik', $totalTarik)
                ->with('activePage', 'laporan')
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan topup.
     *
     * @return void
     */
    public function topup(){
        if(Auth::check()){   
            $startdate = date('Y-m-d', strtotime(Periode::getLastDate()));

            return view('admin.pages.laporan.topup')
                ->with('data', KartuHistori::all()->where('jenis', 'Top Up')->where('idperiode', Periode::getLastId()))
                ->with('activePage', 'lap-topup')
                ->with('startdate', $startdate)
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan topup tanggal.
     *
     * @return void
     */
    public function topupTanggal(){
        if(Auth::check()){   
            $startdate = Input::get('startdate');
            $enddate = Input::get('enddate');

            $periods = KartuHistori::getByDate($startdate, $enddate);

            return view('admin.pages.laporan.topup')
                ->with('data', DB::table('kartu_histori')
                    ->where('jenis', 'Top Up')
                    ->whereIn('idperiode', $periods)
                    ->get())
                ->with('activePage', 'lap-topup')
                ->with('startdate', $startdate)
                ->with('enddate', $enddate)
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan registrasi.
     *
     * @return void
     */
    public function register(){
        if(Auth::check()){   
            $startdate = date('Y-m-d', strtotime(Periode::getLastDate()));

            return view('admin.pages.laporan.register')
                ->with('data', KartuHistori::all()
                    ->where('jenis', 'Registrasi')
                    ->where('idperiode', Periode::getLastId()))
                ->with('activePage', 'lap-register')
                ->with('startdate', $startdate)
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan registrasi tanggal.
     *
     * @return void
     */
    public function registrasiTanggal(){
        if(Auth::check()){   
            $startdate = Input::get('startdate');
            $enddate = Input::get('enddate');

            $periods = KartuHistori::getByDate($startdate, $enddate);

            return view('admin.pages.laporan.register')
                ->with('data', DB::table('kartu_histori')
                    ->where('jenis', 'Registrasi')
                    ->whereIn('idperiode', $periods)
                    ->get())
                ->with('activePage', 'lap-register')
                ->with('startdate', $startdate)
                ->with('enddate', $enddate)
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan tarik.
     *
     * @return void
     */
    public function tarik($tanggal = null){
        if(Auth::check()){   
            $startdate = date('Y-m-d', strtotime(Periode::getLastDate()));

            return view('admin.pages.laporan.tarik')
                ->with('data', KartuHistori::all()
                    ->where('jenis', 'Tarik Tunai')
                    ->where('idperiode', Periode::getLastId()))
                ->with('activePage', 'lap-tarik')
                ->with('startdate', $startdate)
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan tarik tanggal.
     *
     * @return void
     */
    public function tarikTanggal(){
        if(Auth::check()){   
            $startdate = Input::get('startdate');
            $enddate = Input::get('enddate');

            $periods = KartuHistori::getByDate($startdate, $enddate);

            return view('admin.pages.laporan.tarik')
                ->with('data', DB::table('kartu_histori')
                    ->where('jenis', 'Tarik Tunai')
                    ->whereIn('idperiode', $periods)
                    ->get())
                ->with('activePage', 'lap-tarik')
                ->with('startdate', $startdate)
                ->with('enddate', $enddate)
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan kasir.
     *
     * @return void
     */
    public function kasir(){
        if(Auth::check()){   
            return view('admin.pages.laporan.kasir')
                ->with('data', KartuHistori::getLaporanKasir())
                ->with('activePage', 'kasir')
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan setoran.
     *
     * @return void
     */
    public function setoran(){
        if(Auth::check()){
            $date = date('Y-m-d', strtotime(Periode::getLastDate()));
            
            $totalTopup = KartuHistori::getTotalTopupOn(Periode::getLastId());
            $totalRegister = KartuHistori::getTotalRegistrasiOn(Periode::getLastId());
            $totalTarik = KartuHistori::getTotalTarikOn(Periode::getLastId());
            
            return view('admin.pages.laporan.setoran')
                ->with('lastDate', $date)
                ->with('totalKas', ($totalTopup + $totalRegister - $totalTarik))
                ->with('totalKartu', (KartuHistori::getJumlahRegistrasi(Periode::getLastId()) * Tarif::getHarga('Kartu')))
                ->with('activePage', 'setoran')
                ->with('peran', 0);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Index pengguna.
     *
     * @return void
     */
    public function pengguna(){
        if(Auth::check()){
            return view('admin.pages.pengguna.index')
                ->with('accountList', User::all())
                ->with('activePage', 'pengguna');
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }
    
    /**
     * Create pengguna.
     *
     * @return void
     */
    public function penggunaCreate(){
        if(Auth::check()){
            User::add(Input::get('nama'), Input::get('username'), \Hash::make(Input::get('password')), Input::get('role'));
            return $this->pengguna();
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }
    
    /**
     * Delete pengguna.
     *
     * @return void
     */
    public function penggunaDelete(){
        if(Auth::check()){
            User::deleteUser(Input::get('id'));
            return $this->pengguna();
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Update pengguna.
     *
     * @return void
     */
    public function penggunaUpdate(){
        if(Auth::check()){
            $id = Input::get('id');
            return view('admin.pages.pengguna.update')
                ->with('id', $id)
                ->with('username', User::getUsername($id))
                ->with('password', User::getPassword($id))
                ->with('nama', User::getNama($id))
                ->with('role', User::getRoles($id))
                ->with('activePage', 'pengguna');
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }
    
    /**
     * Update pengguna.
     *
     * @return void
     */
    public function penggunaUpdateData(){
        if(Auth::check()){
            $id = Input::get('id');
            $username = Input::get('username');
            $password = Input::get('password');
            $nama = Input::get('nama');
            $role = Input::get('role');
            
            User::updateUsername($id, $username);
            User::updateNama($id, $nama);
            User::updateRole($id, $role);
            
            if(User::getPassword($id) != $password) {
                User::updatePassword($id, \Hash::make($password));
            }
            
            return $this->pengguna();   
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }    
    
    /**
     * Index fasilitas.
     *
     * @return void
     */
    public function fasilitas(){
        return view('admin.pages.fasilitas.index')
            ->with('itemList', Tarif::all())
            ->with('activePage', 'fasilitas')
            ->with('peran', 1);
    }

    /**
     * Create fasilitas.
     *
     * @return void
     */
    public function fasilitasCreate(){

        return view('admin.pages.fasilitas.create')
            ->with('activePage', 'fasilitas')
            ->with('peran', 1);
    }

    /**
     * Create fasilitas.
     *
     * @return void
     */
    public function fasilitasAdd(){
        
        Tarif::add(Input::get('namaItem'), Input::get('harga'));
        
        return view('admin.pages.fasilitas.index')
            ->with('itemList', Tarif::all())
            ->with('activePage', 'fasilitas')
            ->with('peran', 1);
    }

    /**
     * Update fasilitas.
     *
     * @return void
     */
    public function fasilitasUpdate(){
    	return view('admin.pages.fasilitas.update')
            ->with('id', Input::get('id'))
            ->with('nama', Tarif::getNama(Input::get('id')))
            ->with('harga', Tarif::getHarga(Tarif::getNama(Input::get('id'))))
            ->with('activePage', 'fasilitas')
            ->with('peran', 1);
    }
    
    /**
     * Update fasilitas.
     *
     * @return void
     */
    public function fasilitasUpdateData(){
        
        $id = Input::get('id');
        $nama = Input::get('nama');
        $price = Input::get('harga');
        
        Tarif::updateNama($id, $nama);
        Tarif::updateHarga($id, $price);
        
        return view('admin.pages.fasilitas.index')
            ->with('itemList', Tarif::all())
            ->with('activePage', 'fasilitas')
            ->with('peran', 1);   
    }
    
    /**
     * Delete fasilitas.
     *
     * @return void
     */
    public function fasilitasDelete(){
        
        Tarif::deleteItem(Input::get('id'));
        return view('admin.pages.fasilitas.index')
            ->with('itemList', Tarif::all())
            ->with('activePage', 'fasilitas')
            ->with('peran', 1);
    }    

    /**
     * Admin laporan kaki.
     *
     * @return void
     */
    public function kaki(){
        if(Auth::check()){   
            $startdate = date('Y-m-d', strtotime(Periode::getLastDate()));
            $data = KakiHistori::all()->where('idperiode', Periode::getLastId());

            return view('admin.pages.kaki.index')
                ->with('data', $data)
                ->with('jumlahKaki', count($data))
                ->with('activePage', 'kaki')
                ->with('startdate', $startdate)
                ->with('peran', 1);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan kaki tanggal.
     *
     * @return void
     */
    public function kakiTanggal(){
        if(Auth::check()){   
            $startdate = Input::get('startdate');
            $enddate = Input::get('enddate');

            $periods = KakiHistori::getByDate($startdate, $enddate);
            $data = DB::table('kaki_histori')
                    ->whereIn('idperiode', $periods)
                    ->get();

            return view('admin.pages.kaki.index')
                ->with('data', $data)
                ->with('jumlahKaki', count($data))
                ->with('activePage', 'kaki')
                ->with('startdate', $startdate)
                ->with('enddate', $enddate)
                ->with('peran', 1);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    /**
     * Admin laporan kaki.
     *
     * @return void
     */
    public function disable(){
        if(Auth::check()){   
            $date = date('Y-m-d', strtotime(Periode::getLastDate()));
            $data = Kartu::all()->where('isactive', 0);

            return view('admin.pages.kaki.disable')
                ->with('data', $data)
                ->with('jumlahDisable', count($data))
                ->with('activePage', 'disable')
                ->with('date', $date)
                ->with('peran', 1);
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

}

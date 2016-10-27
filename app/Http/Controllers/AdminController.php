<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth, Validator, Input;
use App\User;
use App\Tarif;
use App\Periode;
use App\KartuHistori;
use App\Kartu;
use DB;

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
                ->with('total', KartuHistori::getTotalTransaksi())
                ->with('activePage', 'dashboard');  
        }
        return redirect('auth/adminlogin')->with('loginError', 'Please login first!');
    }

    public function pengguna(){
        if(Auth::check()){
            return view('admin.pages.pengguna')
                ->with('accountList', User::all())
                ->with('activePage', 'pengguna');
        }
        return redirect('auth/adminlogin')
            ->with('loginError', 'Please login first!');
    }
    
    public function penggunaCreate(){
        if(Auth::check()){
            User::add(Input::get('nama'), Input::get('username'), \Hash::make(Input::get('password')), Input::get('role'));
            return $this->pengguna();
        }
        return redirect('auth/adminlogin')
            ->with('loginError', 'Please login first!');
    }
    
    public function penggunaDelete(){
        if(Auth::check()){
            User::deleteUser(Input::get('id'));
            return $this->pengguna();
        }
        return redirect('auth/adminlogin')
            ->with('loginError', 'Please login first!');
    }

    public function penggunaUpdate(){
        if(Auth::check()){
            $id = Input::get('id');
            return view('admin.pages.pengguna-update')
                ->with('id', $id)
                ->with('username', User::getUsername($id))
                ->with('password', User::getPassword($id))
                ->with('nama', User::getNama($id))
                ->with('role', User::getRoles($id))
                ->with('activePage', 'pengguna');
        }
        return redirect('auth/adminlogin')
            ->with('loginError', 'Please login first!');
    }
    
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
        return redirect('auth/adminlogin')
            ->with('loginError', 'Please login first!');
    }

    public function laporan(){

        $ldate = date('Y-m-d H:i:s');
        list($date, $time) = preg_split('/[ ]/', $ldate);
        
        $totalBar = TransaksiBar::getTotalTransaksiOn(Periode::getLastId());
        $totalBar2 = TransaksiBar2::getTotalTransaksiOn(Periode::getLastId());
        $totalBar3 = TransaksiBar3::getTotalTransaksiOn(Periode::getLastId());
        $totalMassage = TransaksiMassage::getTotalTransaksiOn(Periode::getLastId());
        $totalKaraoke = TransaksiKaraoke::getTotalTransaksiOn(Periode::getLastId());
        
        return view('admin/pages/transaksi-keseluruhan')
            ->with('lastDate', $date)
            ->with('totalBar', $totalBar)
            ->with('totalBar2', $totalBar2)
            ->with('totalBar3', $totalBar3)
            ->with('totalKaraoke', $totalKaraoke)
            ->with('totalMassage', $totalMassage)
            ->with('activePage', 'trans-keseluruhan')
            ->with('peran', 0);
    }

    public function setoran(){

        $ldate = date('Y-m-d H:i:s');
        list($date, $time) = preg_split('/[ ]/', $ldate);
        
        $totalKartu = GelangCustomer::getTotalOn(Periode::getLastId());
        $transaksi = TransaksiMassage::all()->where('id_periode', Periode::getLastId());
        $totalTerapis = 0;
        
        foreach($transaksi as $ehem) {
            $totalTerapis += $ehem->refund*0.1;
        }
        
        return view('admin/pages/setoran')
            ->with('lastDate', $date)
            ->with('totalKartu', $totalKartu)
            ->with('totalTerapis', $totalTerapis)
            ->with('activePage', 'setoran')
            ->with('peran', 0);
    }
    
    

    public function terapis(){

        return view('admin/pages/terapis')->with('itemList', Terapis::all())->with('activePage', 'terapis')->with('peran', 0);
    }

    public function terapis_create(){

        return view('admin/pages/terapis-create')->with('activePage', 'terapis')->with('peran', 0);
    }
    
    public function terapis_add(){

        if (Terapis::countExist(Input::get('noKartu')) == 0) {
            Terapis::add(Input::get('noKartu'), Input::get('nama'));
            return view('admin/pages/terapis')->with('itemList', Terapis::all())->with('activePage', 'terapis')->with('peran', 0);
        } else {
            return view('admin/pages/terapis')->with('itemList', Terapis::all())->withErrors('No kartu terapis sudah dipakai')->with('activePage', 'terapis')->with('peran', 0);
        }
    }

    public function terapis_update(){

        return view('admin/pages/terapis-update')->with('activePage', 'terapis')->with('peran', 0);
    }

    public function terapis_absen(){

        return view('admin/pages/terapis-absen')->with('activePage', 'terapis-absen')->with('peran', 0);
    }
    
    public function terapis_absen_hasil(){

        $data = array();
        $periode = Periode::all();
        foreach($periode as $period) {
            
            list($date, $time) = preg_split('/[ ]/', $period->start);
            list($year, $month, $day) = preg_split('/[-]/', $date);
            
            list($year1, $month1, $day1) = preg_split('/[-]/', Input::get('startDate'));
            
            list($year2, $month2, $day2) = preg_split('/[-]/', Input::get('endDate'));
            
            if ($year >= $year1 && $year <= $year2) {
                if ($month >= $month1 && $month <= $month2) {
                    if ($day >= $day1 && $day <= $day2) {
                        array_push($data, 
                      [
                        'periode' => $period->id_periode,
                        'tanggal' => $date
                      ]);
                    }
                }
            }
        }
        
        $absen = array();
        
        foreach($data as $datanya) {
            
            $dataAbsen = Absen::getAbsen($datanya['periode']);
            
            foreach($dataAbsen as $hmmm) {
                array_push($absen, 
                      [
                        'id' => $hmmm->id_therapist,
                        'tanggal' => $datanya['tanggal']
                      ]
                      );
            }
            
        }
        
        
        return view('admin/pages/terapis-absen-hasil')->with('data', $absen)->with('activePage', 'terapis-absen')->with('peran', 0);
    }

    public function terapis_laporan(){

        list($date, $time) = preg_split('/[ ]/', Periode::getLastDate());
        return view('admin/pages/terapis-laporan')->with('itemList', TransaksiMassage::all()->where('id_periode', Periode::getLastId()))->with('lastDate', $date)->with('activePage', 'terapis-laporan')->with('peran', 0);
    }

    public function makanan(){
        return view('admin/pages/makanan')->with('itemList', Item::all())->with('activePage', 'makanan')->with('peran', 1);
    }

    public function makanan_create(){

        return view('admin/pages/makanan-create')->with('activePage', 'makanan')->with('peran', 1);
    }

    public function makanan_add(){
        if(Item::exists(Input::get('id')) == 0) {
        Item::add(Input::get('nama'), Input::get('price'), Input::get('id'));
        return view('admin/pages/makanan')->with('itemList', Item::all())->with('activePage', 'makanan')->with('peran', 1);
        } else {
            return view('admin/pages/makanan')->with('itemList', Item::all())->withErrors('Id makanan sudah terdaftar')->with('activePage', 'makanan')->with('peran', 1);
        }
    }

    public function makanan_update(){
    	return view('admin/pages/makanan-update')
            ->with('id', Input::get('id'))
            ->with('nama', Item::getNama(Input::get('id')))
            ->with('price', Item::getPrice(Input::get('id')))
            ->with('activePage', 'makanan')
            ->with('peran', 1);
    }
    
    public function makanan_update_data(){
        
        $id = Input::get('id');
        $nama = Input::get('nama');
        $price = Input::get('price');
        
        
        Item::updateNama($id, $nama);
        Item::updatePrice($id, $price);
        
        return view('admin/pages/makanan')->with('itemList', Item::all())->with('activePage', 'makanan')->with('peran', 1);   
    }
    
    
    public function makanan_delete(){
        
        Item::deleteItem(Input::get('id'));
        return view('admin/pages/makanan')->with('itemList', Item::all())->with('activePage', 'makanan')->with('peran', 1);
    }
    
    
    public function fasilitas(){
        return view('admin/pages/fasilitas')->with('itemList', Fasilitas::all())->with('activePage', 'fasilitas')->with('peran', 0);
    }

    public function fasilitas_create(){

        return view('admin/pages/fasilitas-create')->with('activePage', 'fasilitas')->with('peran', 0);
    }

    public function fasilitas_add(){
        
        Fasilitas::add(Input::get('namaItem'), Input::get('harga'), Input::get('menit'));
        return view('admin/pages/fasilitas')->with('itemList', Fasilitas::all())->with('activePage', 'fasilitas')->with('peran', 0);
    }

    public function fasilitas_update(){
    	return view('admin/pages/fasilitas-update')
            ->with('id', Input::get('id'))
            ->with('nama', Fasilitas::getNama(Input::get('id')))
            ->with('menit', Fasilitas::getMenit(Input::get('id')))
            ->with('harga', Fasilitas::getHarga(Fasilitas::getNama(Input::get('id')), Fasilitas::getMenit(Input::get('id'))))
            ->with('activePage', 'fasilitas')
            ->with('peran', 0);
    }
    
    public function fasilitas_update_data(){
        
        $id = Input::get('id');
        $nama = Input::get('nama');
        $menit = Input::get('menit');
        $price = Input::get('harga');
        
        
        Fasilitas::updateNama($id, $nama);
        Fasilitas::updateHarga($id, $price);
        Fasilitas::updateMenit($id, $menit);
        
        return view('admin/pages/fasilitas')->with('itemList', Fasilitas::all())->with('activePage', 'fasilitas')->with('peran', 0);   
    }
    
    public function fasilitas_delete(){
        
        Fasilitas::deleteItem(Input::get('id'));
        return view('admin/pages/fasilitas')->with('itemList', Fasilitas::all())->with('activePage', 'fasilitas')->with('peran', 0);
    }

    public function kartu(){

        return view('admin/pages/kartu')->with('data', GelangCustomer::all()->where('id_periode', Periode::getLastId()))->with('activePage', 'kartu')->with('peran', 0);
    }   

    public function laporanOb(){

        list($date, $time) = preg_split('/[ ]/', Periode::getLastDate());

        $id_periode = Periode::getLastId();

        $transaksi = DB::table('transaksi_massage')
                 ->select('no_kartu', DB::raw('count(*) as total'))
                 ->where('id_periode', $id_periode)
                 ->groupBy('no_kartu')
                 ->get();

        return view('admin/pages/laporanOb')->with('data', $transaksi)
            ->with('lastDate', $date)
            ->with('activePage', 'laporanOb')->with('peran', 0);
    }    

    public function kasir_laporan(){

        return view('admin/pages/kasir-laporan')
        ->with('data', GelangCustomer::getLaporanKasir())
        ->with('activePage', 'kasir')
        ->with('peran', 0);
    }
    
}

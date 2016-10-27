<!-- BEGIN SIDEBAR -->
<div class="page-sidebar navbar-collapse collapse">
    <br />
      <!-- BEGIN SIDEBAR MENU -->        
      <ul class="page-sidebar-menu">
        <li class="start @if('dashboard' === $activePage) active @endif ">
            <a href="{{ url('admin') }}">
            <i class="fa fa-home"></i> 
            <span class="title">Dashboard</span>
            <span class="selected"></span>
            </a>
        </li>
        @if(Auth::user()->role == 'admin') 
        <li class="@if('laporan' === $activePage) active @endif ">
            <a href="{{ url('admin/laporan') }}">
            <i class="fa fa-plus"></i> 
            <span class="title">Transaksi Keseluruhan</span>
            <span class="selected"></span>
            </a>
        </li>

        <li class="@if('kartu' === $activePage) active @endif ">
            <a href="#">
                <i class="fa fa-credit-card"></i> 
                <span class="title">Laporan Kartu</span>
                <span class="selected"></span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="@if('topup' === $activePage) active @endif">
                    <a href="{{ url('admin/laporan/topup') }}">
                    Laporan Top Up</a>
                </li>
                <li class="@if('registrasi' === $activePage) active @endif">
                    <a href="{{ url('admin/laporan/registrasi') }}">
                    Laporan Registrasi</a>
                </li>
                <li class="@if('tarik' === $activePage) active @endif">
                    <a href="{{ url('admin/laporan/tarik') }}">
                    Laporan Tarik Tunai</a>
                </li>
            </ul>
        </li>

        <li class="@if('kasir' === $activePage) active @endif ">
            <a href="{{ url('admin/laporan/kasir') }}">
            <i class="fa fa-money"></i> 
            <span class="title">Kasir</span>
            <span class="selected"></span>
            </a>
        </li>
        
        <li class="@if('setoran' === $activePage) active @endif ">
            <a href="{{ url('admin/laporan/setoran') }}">
            <i class="fa fa-gavel"></i> 
            <span class="title">Setoran</span>
            <span class="selected"></span>
            </a>
        </li>
        @else
        <li class="@if('pengguna' === $activePage) active @endif ">
            <a href="{{ url('admin/pengguna') }}">
            <i class="fa fa-user"></i> 
            <span class="title">Pengguna</span>
            <span class="selected"></span>
            </a>
        </li>

        <li class="@if('tarif' === $activePage) active @endif ">
            <a href="{{ url('admin/fasilitas') }}">
            <i class="fa fa-dollar"></i> 
            <span class="title">Tarif</span>
            <span class="selected"></span>
            </a>
        </li>

        <li class="@if('kaki' === $activePage) active @endif ">
            <a href="{{ url('admin/laporan/kaki') }}">
            <i class="fa fa-gears"></i> 
            <span class="title">Kaki Bawah</span>
            <span class="selected"></span>
            </a>
        </li>
        @endif
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
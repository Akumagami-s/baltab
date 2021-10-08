BEGIN MAIN MENU
<div id="menubar" class="animate menubar-inverse">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="{{ url('/') }}">
                <span class="text-lg text-bold text-primary ">BPTWP - AD</span>
            </a>
        </div>
    </div>

    <div class="menubar-scroll-panel">
        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">

            <!-- BEGIN DASHBOARD -->
            <li>
                <a href="{{ url('/') }}" class="{{ App\Helpers\UrlHelper::activeNav(['dashboard']) }}">
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title">Dashboard</span>
                </a>
            </li><!--end /menu-li -->
            <!-- END DASHBOARD -->

            <!-- BEGIN DATA POKOK -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-accessibility "></i></div>
                    <span class="title">Data Pokok Prajurit</span>
                </a>

                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('datapokok') }}" class="{{ App\Helpers\UrlHelper::activeNav(['datapokok', 'datapokok/view/{id}', 'datapokok/edit/{id}']) }}"><span class="title">Index</span></a></li>
                    <li><a href="{{ url('datapokok/cari') }}" class="{{ App\Helpers\UrlHelper::activeNav(['datapokok/cari']) }}"><span class="title">Cari</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END DATA POKOK -->

            <!-- BEGIN REKAYASA DATA -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-healing"></i></div>
                    <span class="title">Rekayasa Data</span>
                </a>

                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('import') }}" class="{{ App\Helpers\UrlHelper::activeNav(['import']) }}"><span class="title">Import</span></a></li>
                    <li><a href="{{ url('verifikasi') }}" class="{{ App\Helpers\UrlHelper::activeNav(['verifikasi', 'verifikasi/edit/{id}']) }}"><span class="title">Verifikasi</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END REKAYASA DATA -->

            <!-- BEGIN PENGAJUAN -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-settings-phone"></i></div>
                    <span class="title">Pengajuan</span>
                </a>

                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('pengajuan/input') }}" class="{{ App\Helpers\UrlHelper::activeNav(['pengajuan/input']) }}"><span class="title">Input</span></a></li>
                    <li><a href="{{ url('pengajuan') }}" class="{{ App\Helpers\UrlHelper::activeNav(['pengajuan', 'pengajuan/view/{id}', 'pengajuan/edit/{id}']) }}"><span class="title">Index</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END PENGAJUAN -->

            <!-- BEGIN SPRIN -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-settings-input-composite"></i></div>
                    <span class="title">Pembayaran</span>
                </a>

                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('sprin/persetujuan') }}" class="{{ App\Helpers\UrlHelper::activeNav(['sprin/persetujuan','sprin/view-persetujuan/{id}','sprin/edit-persetujuan/{id}']) }}"><span class="title">Persetujuan</span></a></li>
                    <li><a href="{{ url('sprin/pembayaran') }}" class="{{ App\Helpers\UrlHelper::activeNav(['sprin/pembayaran','sprin/view-pembayaran/{id}','sprin/edit-pembayaran/{id}']) }}"><span class="title">Pembayaran</span></a></li>
                    <li><a href="{{ url('sprin-list') }}" class="{{ App\Helpers\UrlHelper::activeNav(['sprin-list']) }}"><span class="title">List</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END SPRINT -->

            @if(App\Models\User::current()['email'] == 'superadmin')
            <!-- BEGIN ANGGOTA -->
            <li>
                <a href="{{ url('anggota') }}" class="{{ App\Helpers\UrlHelper::activeNav(['anggota']) }}">
                    <div class="gui-icon"><i class="md md-local-play"></i></div>
                    <span class="title">Anggota</span>
                </a>
            </li><!--end /menu-li -->
            <!-- END ANGGOTA -->
            @endif

            <!-- BEGIN MASTER -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
                    <span class="title">Master</span>
                </a>

                <!--start submenu -->
                <ul>

                    <!-- BEGIN INSTITUSI -->
                    <li class="gui-folder">
                        <a href="javascript:void(0);">
                            <span class="title">Institusi</span>
                        </a>
                        <!--start submenu -->
                        <ul>
                            <li><a href="{{ url('pangkat') }}" class="{{ App\Helpers\UrlHelper::activeNav(['pangkat','pangkat/create','pangkat/{pangkat}/edit']) }}"><span class="title">Pangkat</span></a></li>
                            <li><a href="{{ url('kesatuan') }}" class="{{ App\Helpers\UrlHelper::activeNav(['kesatuan','kesatuan/create','kesatuan/{kesatuan}/edit']) }}"><span class="title">Kesatuan</span></a></li>
                            <li><a href="{{ url('corp') }}" class="{{ App\Helpers\UrlHelper::activeNav(['corp','corp/create','corp/{corp}/edit']) }}"><span class="title">Korp</span></a></li>
                        </ul><!--end /submenu -->
                    </li><!--end /submenu-li -->
                    <!-- END INSTITUSI -->

                    <!-- BEGIN DISTRIK -->
                    <li class="gui-folder">
                        <a href="javascript:void(0);">
                            <span class="title">Distrik</span>
                        </a>
                        <!--start submenu -->
                        <ul>
                            <li><a href="{{ url('kodim') }}" class="{{ App\Helpers\UrlHelper::activeNav(['kodim']) }}"><span class="title">Kodim</span></a></li>
                            <li><a href="{{ url('korem') }}" class="{{ App\Helpers\UrlHelper::activeNav(['korem']) }}"><span class="title">Korem</span></a></li>
                            <li><a href="{{ url('kodam') }}" class="{{ App\Helpers\UrlHelper::activeNav(['kodam']) }}"><span class="title">Kodam</span></a></li>
                        </ul><!--end /submenu -->
                    </li><!--end /submenu-li -->
                    <!-- END DISTRIK -->

                    <!-- BEGIN LOKASI -->
                    <li class="gui-folder">
                        <a href="javascript:void(0);">
                            <span class="title">Lokasi</span>
                        </a>
                        <!--start submenu -->
                        <ul>
                            <li><a href="{{ url('provinsi') }}" class="{{ App\Helpers\UrlHelper::activeNav(['provinsi']) }}"><span class="title">Provinsi</span></a></li>
                            <li><a href="{{ url('kota') }}" class="{{ App\Helpers\UrlHelper::activeNav(['kota']) }}"><span class="title">Kota / Kabupaten</span></a></li>
                        </ul><!--end /submenu -->
                    </li><!--end /submenu-li -->
                    <!-- END DISTRIK -->

                    <li><a href="{{ url('kategori') }}" class="{{ App\Helpers\UrlHelper::activeNav(['kategori']) }}"><span class="title">Kategori</span></a></li>
                    <li><a href="{{ url('kotama') }}" class="{{ App\Helpers\UrlHelper::activeNav(['kotama']) }}"><span class="title">Kotama</span></a></li>
                    <li><a href="{{ url('satminkal') }}" class="{{ App\Helpers\UrlHelper::activeNav(['satminkal']) }}"><span class="title">Satminkal</span></a></li>
                    <li><a href="{{ url('bunga') }}" class="{{ App\Helpers\UrlHelper::activeNav(['bunga']) }}"><span class="title">Bunga</span></a></li>
                    <li><a href="{{ url('potongan') }}" class="{{ App\Helpers\UrlHelper::activeNav(['potongan']) }}"><span class="title">Potongan</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END LEVELS -->

            @if(App\Models\User::current()['email'] == 'superadmin')
            <!-- BEGIN ACTIVITY -->
            <li>
                <a href="{{ url('activity') }}" class="{{ App\Helpers\UrlHelper::activeNav(['activity']) }}">
                    <div class="gui-icon"><i class="md md-access-time"></i></div>
                    <span class="title">Activity Log</span>
                </a>
            </li><!--end /menu-li -->
            <!-- END ACTIVITY -->
            @endif

        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-75">Copyright © 2018</span> <strong>BPTWP-AD</strong>
            </small>
        </div>
    </div>
</div>

 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Reservasi<sup>Hotel</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-home"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Menu Aplikasi
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-table"></i>
        <span>Sistem</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sistem:</h6>
            <a class="collapse-item" href="<?=site_url('pengguna')?>">Pengguna Sistem</a>
            <a class="collapse-item" href="<?=site_url('tamu')?>">Tamu</a>
            <a class="collapse-item" href="<?=site_url('negara')?>">Negara</a>
            <a class="collapse-item" href="<?=site_url('metodebayar')?>">Metode bayar</a>
            <a class="collapse-item" href="<?=site_url('pemesanan')?>">Pemesanan</a>
            <a class="collapse-item" href="<?=site_url('pemesananstatus')?>">Pemesananstatus</a>
            <a class="collapse-item" href="<?=site_url('pembayaran')?>">Pembayaran</a>
        </div>
    </div>
</li>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-table"></i>
        <span>Informasi Kamar</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">tipetarif:</h6>
            <a class="collapse-item" href="<?=site_url('tipetarif')?>">Tipetarif</a>
            <a class="collapse-item" href="<?=site_url('kamar')?>">Kamar</a>
            <a class="collapse-item" href="<?=site_url('kamartipe')?>">Kamar Tipe</a>
            <a class="collapse-item" href="<?=site_url('kamartarif')?>">Kamar Tarif</a>
            <a class="collapse-item" href="<?=site_url('kamarstatus')?>">Kamar Status</a>
            <a class="collapse-item" href="<?=site_url('kamardipesan')?>">Kamar Dipesan</a>
        </div>
    </div>
</li>
</ul>
<!-- End of Sidebar -->

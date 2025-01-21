<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3" href="index.html">

        <div class="sidebar-brand-text mx-3">DKRIUK Security Checkpoint</div>
    </a>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        QR CHECKPOINT
    </div>
    <li class="nav-item {{ Route::is('buattitikpoint') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('buattitikpoint') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Buat Titik Point</span></a>
    </li>
    <li class="nav-item {{ Route::is('listtitikpoint') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('listtitikpoint') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>List Titik Point</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        DATA SCAN QR CHECKPOINT
    </div>

    <!-- Nav Item - Add -->
    <li class="nav-item {{ Route::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Semua Data</span></a>
    </li>

    <li class="nav-item {{ Route::is('validqr') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('validqr') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Valid {{ $valid->count() }}</span></a>
    </li>
    <li class="nav-item {{ Route::is('invalidqr') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('invalidqr') }}">
            <i class="fas fa-fw fa-table"></i>
            <span> Invalid <span class=" text-danger">{{ $invalid->count() }}</span></span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-table"></i>
            <span>Tambah Manual</span></a>
    </li> --}}
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Security
    </div>

    <!-- Nav Item - Add -->
    <li class="nav-item {{ Route::is('listsecurityuser') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('listsecurityuser') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>List Security</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Divider -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->

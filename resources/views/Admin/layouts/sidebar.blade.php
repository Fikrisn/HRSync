<div class="sidebar">
  <!--- SidebarSearch Form-->
  <div class="form-inline mt-2">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="{{ url('/')}}" class="nav-link {{($activeMenu == 'dashboard')? 'active' : ''}}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header">Data Pengguna</li>
        <li class="nav-item">
          <a href="{{ url('/pengguna')}}" class="nav-link {{($activeMenu == 'pengguna')? 'active' : ''}}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>Jenis User</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/user')}}" class="nav-link {{($activeMenu == 'user')? 'active' : ''}}">
            <i class="nav-icon fas fa-user"></i>
            <p>Data User</p>
          </a>
        </li>
      <li class="nav-header">Kegiatan</li>
      <li class="nav-item">
        <a href="{{ url('/kegiatanAg')}}" class="nav-link {{($activeMenu == 'kegiatanAg')? 'active' : ''}}">
          <i class="nav-icon fas fa-bookmark"></i>
          <p>Kegiatan Agenda</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/barang')}}" class="nav-link {{($activeMenu == 'barang')? 'active' : ''}}">
          <i class="nav-icon fas fa-list-alt"></i>
          <p>Kegiatan Progress</p>
        </a>
      </li>
      <li class="nav-header">Repository</li>
      <li class="nav-item">
        <a href="{{ url('/stok')}}" class="nav-link {{($activeMenu == 'stok')? 'active' : ''}}">
          <i class="nav-icon fas fa-cubes"></i>
          <p>Surat Tugas</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/penjualan')}}" class="nav-link {{($activeMenu == 'penjualan')? 'active' : ''}}">
          <i class="nav-icon fas fa-cash-register"></i>
          <p>Proposal Tugas</p>
        </a>
      </li>
    </ul>
  </nav>
</div>
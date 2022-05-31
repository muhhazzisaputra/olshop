<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      	<img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      	<span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    	<!-- Sidebar user panel (optional) -->
	    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
	        </div>
	        <div class="info">
	          <a href="#" class="d-block">Alexander Pierce</a>
	        </div>
	    </div>

	    <!-- Sidebar Menu -->
	    <nav class="mt-2">
	        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	          	<li class="nav-item">
		            <a href="/dashboard" class="nav-link{{ Request::is('dashboard') ? ' active' : '' }}">
			            <i class="nav-icon fas fa-tachometer-alt"></i>
			            <p>Dashboard</p>
		            </a>
	          	</li>
	          	<li class="nav-item">
		            <a href="pages/widgets.html" class="nav-link">
			            <i class="nav-icon fas fa-th"></i>
			            <p>
			                Widgets
			                <span class="right badge badge-danger">New</span>
			            </p>
		            </a>
	          	</li>
	          	<li class="nav-item">
		            <a href="" class="nav-link">
		              	<i class="nav-icon fas fa-copy"></i>
		              	<p>Produk<i class="fas fa-angle-left right"></i></p>
		            </a>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="/admin/category" class="nav-link">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Kategori</p>
			                </a>
			                <a href="/admin/merk" class="nav-link">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Merek</p>
			                </a>
			                <a href="/admin/size" class="nav-link">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Ukuran</p>
			                </a>
		              		<a href="/admin/product" class="nav-link">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Data Produk</p>
			                </a>
		              	</li>
		            </ul>
	          	</li>
	          	<li class="nav-header">HALAMAN WEB</li>
	          	<li class="nav-item">
		            <a href="/admin/page/tentang-kami" class="nav-link">
		              	<i class="far fa-circle nav-icon"></i>
		              	<p>Tentang Kami</p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <a href="/admin/page/kontak-kami" class="nav-link">
		              	<i class="far fa-circle nav-icon"></i>
		              	<p>Kontak Kami</p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <a href="/admin/page/syarat-dan-ketentuan" class="nav-link">
		              	<i class="far fa-circle nav-icon"></i>
		              	<p>Syarat Dan Ketentuan</p>
		            </a>
		        </li>
	          	<li class="nav-item">
		            <a href="/adminlogout" class="nav-link">
		              	<i class="nav-icon fas fa-sign-out-alt"></i>
		              	<p>Logout</p>
		            </a>
		        </li>
	       	</ul>
	    </nav>
	</div>
</aside>
@extends('admin/layouts/main')

@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<section class="content-header">
  	<div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0">Kategori Produk</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="#">Home</a></li>
	              	<li class="breadcrumb-item active">Kategori Produk</li>
	            </ol>
          	</div>
        </div>
  	</div>
</section>

<!-- Main content -->
<section class="content">
  	<div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
        		@if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ session('success') }}
                </div>
                @endif
	          	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Data Kategori Produk</h3>
	                	<div class="card-tools">
			              	<a href="/admin/category/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
			            </div>
	              	</div>
	              	<div class="card-body">
	                	<table id="tbl-category" class="table table-bordered table-striped">
	                  		<thead>
			                  	<tr>
				                    <th class="text-center">#</th>
				                    <th class="text-center">Nama Kategori</th>
				                    <th class="text-center">Slug</th>
				                    <th class="text-center">Opsi</th>
			                  	</tr>
	                  		</thead>
	                  		<tbody>
	                  			@foreach($categories as $category)
			                  	<tr>
				                    <td>{{ $loop->iteration }}</td>
				                    <td>{{ $category->name }}</td>
				                    <td>{{ $category->slug }}</td>
				                    <td class="project-actions text-center">
			                          	<a href="/admin/category/{{ $category->slug }}/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
			                          	<form action="/admin/category/{{ $category->slug }}" method="post" class="d-inline">
				                        	@method('delete')
				                        	@csrf
				                          	<button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">
				                              <i class="fas fa-trash"></i> Hapus
				                          	</button>
				                        </form>
				                    </td>
			                  	</tr>
			                  	@endforeach
	                  		</tbody>
	                	</table>
	              </div>
            	</div>
            </div>
        </div>
  	</div>
</section>

<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  	$(function () {

	    $("#tbl-category").DataTable({
	      	"responsive": true,
	      	"lengthChange": false,
	      	"autoWidth": false
	    });

	    $(document).on('click', '.btn-edit', function() {
	    	var id = $(this).val();
	    	$.get('/product/category',{id: id}, function(res) {
	    		console.log(res);
	    	});
	    });

  	});

</script>
@endsection
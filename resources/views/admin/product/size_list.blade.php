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
            	<h1 class="m-0">Ukuran Produk</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="#">Home</a></li>
	              	<li class="breadcrumb-item active">Ukuran Produk</li>
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
        		<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Data Ukuran Produk</h3>
	                	<div class="card-tools">
			              	<button class="btn btn-sm btn-primary" onClick="create()"><i class="fas fa-plus"></i> Tambah Data</button>
			            </div>
	              	</div>
	              	<div class="card-body sizelist">
	                	
	              	</div>
            	</div>
            </div>
        </div>
  	</div>
</section>

<div class="modal fade" id="sizeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              	<h4 class="modal-title">Form Tambah Data</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="modal-body sizepage">

            </div>
        </div>
    </div>
</div>

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
    $(document).ready(function() {

        read();

    });

    // LOAD DATA
    function read() {
        $.get("{{ url('/admin/size/read') }}", {}, function(data, status) {
            $(".sizelist").html(data);
        });
    }

    // FORM CREATE
    function create() {
        $.get("{{ url('/admin/size/create') }}", {}, function(data, status) {
        	$(".modal-title").text('Form Tambah Data');
            $(".sizepage").html(data);
            $("#sizeModal").modal('show');
        });
    }

    // STORE PROCESS
    function store() {
        var name = $("#name").val();
        $.ajax({
            type: "get",
            url: "{{ url('/admin/size/store') }}",
            data: "name=" + name,
            success: function(data) {
                $(".close").click();
                read();
            }
        });
    }

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/admin/size/show') }}/" + id, {}, function(data, status) {
        	$(".modal-title").text('Form Edit Data');
            $(".sizepage").html(data);
            $("#sizeModal").modal('show');
        });
    }

    // UPDATE PROCESS
    function update(id) {
        var name = $("#name").val();
        $.ajax({
            type: "get",
            url: "{{ url('/admin/size/update') }}/" + id,
            data: "name=" + name,
            success: function(data) {
                $(".close").click();
                read();
            }
        });
    }

    // DESTROY DATA
    function destroy(id) {
        $.ajax({
            type: "get",
            url: "{{ url('/admin/size/destroy') }}/" + id,
            data: "name=" + name,
            success: function(data) {
                $(".close").click();
                read();
            }
        });
    }
</script>

@endsection
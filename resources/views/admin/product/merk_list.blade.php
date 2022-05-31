@extends('admin/layouts/main')

@section('content')

<section class="content-header">
  	<div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0">Merek Produk</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="#">Home</a></li>
	              	<li class="breadcrumb-item active">Merek Produk</li>
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
	                	<h3 class="card-title">Data Merek Produk</h3>
	                	<div class="card-tools">
			              	<a href="/admin/merk/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
			            </div>
	              	</div>
	              	<div class="card-body">
	                	<table id="tbl-category" class="table table-bordered table-striped">
	                  		<thead>
			                  	<tr>
				                    <th class="text-center">#</th>
				                    <th class="text-center">Logo Merek</th>
				                    <th class="text-center">Nama</th>
				                    <th class="text-center">Opsi</th>
			                  	</tr>
	                  		</thead>
	                  		<tbody>
	                  			@foreach($merks as $merk)
			                  	<tr>
				                    <td>{{ $loop->iteration }}</td>
				                    <td>
				                    	<img src="{{ asset('storage/'.$merk->logo) }}" width="90px">
				                    </td>
				                    <td>{{ $merk->name }}</td>
				                    <td class="project-actions text-center">
				                    	<a href="/admin/merk/{{ $merk->id }}/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
				                    	<form action="/admin/merk/{{$merk->id}}" method="post" class="d-inline">
				                        @method('delete')
				                        @csrf
				                          	<button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">
				                              <i class="fas fa-trash"></i> Delete
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

@endsection
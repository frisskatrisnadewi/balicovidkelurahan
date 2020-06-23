@extends('layouts.master')
	@if(session('sukses'))
		<div class="alert alert-success" role="alert">
		 {{'sukses'}}
			 <button type="button" class="close" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
@section('search')
<div class="row mt-4">
	<div class="col-sm-8">
		<div >
          	<div class="card-body">
           		<div class="col">
              		<blockquote class="blockquote text-center">
                		<h3><strong>PENYEBARAN DATA COVID-19 PROVINSI BALI</strong></h3>
                		<footer >
                  			<div class=" row justify-content-center">
                   				<img src="kalender.png" class="rounded float-left" style="width:10%">
                  
                  			</div>
                  			<h5 class="justify-content-center">{{$tanggalSekarang}}</h5> 
                        </footer>
              		</blockquote>                
				</div>
			</div>
		</div>		
	</div>
<!--     <div class="col-sm-4 " style="margin-bottom: 15px">
        <div class="col">
          <div>
            <strong>Cari Data Berdasarkan Tanggal</strong>
          </div>
          <hr>
          	<div class="row">
				<form action="/data/search" method="post" class="form-inline my-2 my-lg-0">
				@csrf
				    <input class="form-control mr-md-2 " type="date"  @if(isset($tanggal)) value="{{$tanggal}}" @endif name="tanggal" id="tanggalSearch"placeholder="Masukan tanggal" aria-label="Search" required>
				    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		 </div>      
              <div class="col">
          <div>
            <strong>Cari Data Berdasarkan Nama Kelurahan</strong>
          </div>
          <hr>
          	<div class="row">
				<form action="{{ url()->current() }}" method="GET" class="form-inline my-2 my-lg-0">
				@csrf
				    <input class="form-control mr-md-2 " type="input"   name="kelurahan" id="kelurahansearch"placeholder="Masukan kelurahan" aria-label="Search" required>
				    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		 </div>  
    </div> -->
</div>

	
@endsection

@section('content')
		<div>
			<div class="card-header ">
				<div class="row ">
					<div class="col-6">
						<h5>Tabel Sebaran Data {{$tanggalSekarang}}</h5>
					</div>

					<div class="col-6">
						<button type="button" class="btn btn-primary btn-md float-right" data-toggle="modal" data-target="#exampleModal">
						  Tambah Data
						</button>
					</div>

				</div>
			</div>
			<div class="card-body">
				
				<table class="table table-hover table-dark table-responsive-md shadow-sm rounded" id="tables" >		

					<tr class="bg-info text-light">
			            <th rowspan="2">No</th>
			            <th rowspan="2">Kabupaten</th>
			            <th rowspan="2">Kecamatan</th>
			            <th rowspan="2">Kelurahan</th>
			            <th rowspan="2">Level</th>
			            <th colspan="5">Penyebaran</th>
			            <th colspan="5">Kondisi</th>
									
					</tr>

			          <tr class="bg-info">
			            <th>PP-LN</th>
			            <th>PP-DN</th>
			            <th>TL</th>
			            <th>Lainnya</th>
			            <th>Total</th>
			            <th>Perawatan</th>
			            <th>Sembuh Covid</th>
			            <th>Meninggal</th>
			            <th>Total</th>
			            <th>Action</th>
			          </tr>
					
					<?php 
						if(count($data_covid)>0){
							$s	=	'';
							foreach($data_covid as $val){
								$s++;
					?>
					<tr>
						<td class="bg-secondary text-light" ><?php echo $s ?? '';?></td>
			            <td class="bg-secondary text-light">{{$val->nama_kab}}</td>
						<td class="bg-secondary text-light">{{$val->kecamatan}}</td>
			            <td class="bg-secondary text-light">{{$val->kelurahan}}</td>
			            <td class="bg-secondary text-light">{{$val->level}}</td>
			            <td class="bg-secondary text-light">{{$val->ppln}}</td>
			            <td class="bg-secondary text-light">{{$val->ppdn}}</td>
			            <td class="bg-secondary text-light">{{$val->tl}}</td>
			            <td class="bg-secondary text-light">{{$val->lainnya}}</td>
			            <td class="bg-secondary text-light">{{$val->positif}}</td>
						<td class="bg-secondary text-light">{{$val->rawat}}</td>
						<td class="bg-secondary text-light">{{$val->sembuh}}</td>
			            <td class="bg-secondary text-light">{{$val->meninggal}}</td>
						<td class="bg-secondary text-light">{{$val->positif}}</td>
			
						<td>
							<a href="/data/{{$val->id_data2}}/edit" class="btn btn-warning btn-sm">Edit</a> | 
							<a href="/data/{{$val->id_data2}}/delete "  class="btn btn-danger btn-sm" onClick="return confirm('Apakah yakin menghapus data?');"> Delete</a>
						</td>
					</tr>
					<?php 
							}
						}else{
					?>
						<tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
					<?php } ?>					
				
				</table>
				{{ $data_covid->links() }}

		</div>




<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">

						<h6 class="card-title"> Tanda <span class="text-danger">*</span> wajib diisi!</h6>

				        <form action="/data/create" method="POST">
				        	{{ csrf_field() }}
<!-- 						 	<div class="form-group">
								<label>Kabupaten <span class="text-danger">*</span></label>

								<select id="kabupaten" name="kabupaten" class="form-control" required>
									 <option value="" selected>Pilih</option>
									 @foreach($kabupaten as $item)
									 <option value="{{$item->id_kab}}" >{{$item->nama_kab}}</option>

									 @endforeach
									</select>
							</div>

							<div class="form-group">
								<label>Kecamatan <span class="text-danger">*</span></label>

								<select id="kecamatan" name="kecamatan" class="form-control" required>
									 <option value="" selected>Pilih</option>
									 @foreach($kecamatan as $item)
									 <option value="{{$item->kecamatan}}" >{{$item->kecamatan}}</option>

									 @endforeach
									</select>
							</div> -->

							<div class="form-group">
								<label>Kelurahan <span class="text-danger">*</span></label>

								<select id="kelurahan" name="kelurahan" class="form-control" required>
									 <option value="" selected>Pilih</option>
									 @foreach($kelurahan as $item)
									 <option value="{{$item->id_kel}}" >{{$item->kelurahan}}</option>

									 @endforeach
									</select>
							</div>


							<div class="form-group">
								<label>Tanggal <span class="text-danger">*</span></label>
								<input type="date" name="tanggal" id="tanggal" min="2020-04-01" class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="row">
							<div class="col-6">
								
							
							<div class="form-group">
								<label>Total Rawat <span class="text-danger">*</span></label>
								<input type="number" name="rawat" id="rawat" min="0" onKeyup="hitung();" class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="form-group">
								<label>Total Sembuh <span class="text-danger">*</span></label>
								<input type="number" name="sembuh" id="sembuh" min="0" onKeyup="hitung();" class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="form-group">
								<label>Total Meninggal <span class="text-danger">*</span></label>
								<input type="number" name="meninggal" id="meninggal" min="0" onKeyup="hitung();" class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="form-group">
								<label>Total Positif </label>
								<input type="number" name="positif" id="positif" onKeyup="hitung();" class="form-control" readonly="">
							</div>
				      		</div>

				      		<hr>

				      		<div class="col-6">
								
							
							<div class="form-group">
								<label>PPLN <span class="text-danger">*</span></label>
								<input type="number" name="ppln" id="ppln" min="0"  class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="form-group">
								<label>PPDN <span class="text-danger">*</span></label>
								<input type="number" name="ppdn" id="ppdn" min="0"  class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="form-group">
								<label>TL <span class="text-danger">*</span></label>
								<input type="number" name="tl" id="tl" min="0"  class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="form-group">
								<label>Lainnya </label>
								<input type="number" name="lainnya" id="lainnya" min="0"  class="form-control" placeholder="masukkan angka" required>
							</div>

							<div class="form-group">
								<label>Level <span class="text-danger">*</span></label>
								<input type="number" name="level" id="level" min="0"  class="form-control" placeholder="masukkan angka" required>
							</div>
				      		</div>
				      	</div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add Data</button>
				        </form>
				      </div>
				    </div>
				  </div>
				</div>
			


@endsection


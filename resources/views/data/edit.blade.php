@extends('layouts.masteredit')

@section('contentedit')
	   	@if(session('sukses'))
			<div class="alert alert-success" role="alert">
		 		{{'sukses'}}
			</div>
		@endif
		<h1><a></a></h1>
		@foreach($data_covid as $val)
			
		<div class="card shadow-sm">
			<div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Edit User</strong> <a href="index.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Home</a></div>
			<div class="card-body">
				<div class="row">
				<div class="col-sm-12">
					<h5 class="card-title">Tanda <span class="text-danger">*</span> harus diisi!</h5>

					<form action="/data/{{$val->id_data2}}/update" method="post">
						{{ csrf_field() }}
						<div class="form-group">

							<label>Kabupaten <span class="text-danger">*</span></label>

							<input type="text" name="kabupaten" id="kabupaten" class="form-control" value="{{ $val->nama_kab }}" readonly>

						</div>

						<div class="form-group">

							<label>Kecamatan <span class="text-danger">*</span></label>

							<input type="text" name="kecamatan" id="kecamatan" class="form-control" value="{{ $val->kecamatan }}" readonly>

						</div>

						<div class="form-group">

							<label>Kelurahan <span class="text-danger">*</span></label>

							<input type="text" name="kelurahan" id="kelurahan" class="form-control" value="{{ $val->kelurahan }}" readonly>

						</div>



						<div class="form-group">

							<label>Tanggal <span class="text-danger">*</span></label>

							<input type="date" name="tanggal" id="tanggal" min="2020-04-01" class="form-control" value="{{ $val->tanggal }}" readonly>

						</div>

						<div class="row">
							<div class="col-6">

						<div class="form-group">

							<label>Rawat <span class="text-danger">*</span></label>

							<input type="number" name="rawat" id="rawat" min="0" onKeyup="hitung();" class="form-control" value="{{ $val->rawat }}" required>

						</div>

						<div class="form-group">

							<label>Sembuh <span class="text-danger">*</span></label>

							<input type="number" name="sembuh" id="sembuh" min="0" onKeyup="hitung();" class="form-control" value="{{ $val->sembuh }}" required>

						</div>

						<div class="form-group">

							<label>Meninggal <span class="text-danger">*</span></label>

							<input type="number" name="meninggal" id="meninggal" min="0" onKeyup="hitung();" class="form-control" value="{{ $val->meninggal }}" required>

						</div>

						<div class="form-group">

							<label>Positif <span class="text-danger">*</span></label>

							<input type="number" name="positif" id="positif" onKeyup="hitung();" class="form-control" readonly="">

						</div>
					</div>

						<hr>

				      		<div class="col-6">
								
							
							<div class="form-group">
								<label>PPLN <span class="text-danger">*</span></label>
								<input type="number" name="ppln" id="ppln" min="0"  class="form-control" placeholder="masukkan angka" value="{{ $val->ppln }}" required>
							</div>

							<div class="form-group">
								<label>PPDN <span class="text-danger">*</span></label>
								<input type="number" name="ppdn" id="ppdn" min="0"  class="form-control" placeholder="masukkan angka" value="{{ $val->ppdn }}" required>
							</div>

							<div class="form-group">
								<label>TL <span class="text-danger">*</span></label>
								<input type="number" name="tl" id="tl" min="0"  class="form-control" placeholder="masukkan angka" value="{{ $val->tl }}"required>
							</div>

							<div class="form-group">
								<label>Lainnya </label>
								<input type="number" name="lainnya" id="lainnya" min="0"  class="form-control" placeholder="masukkan angka" value="{{ $val->lainnya }}" required>
							</div>

							<div class="form-group">
								<label>Level </label>
								<input type="number" name="level" id="level" min="0"  class="form-control" placeholder="masukkan angka" value="{{ $val->level }}" required>
							</div>

				      		</div>
				      	</div>
				      

						<div class="form-group">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-warning"><i class="fa fa-fw fa-edit"></i> Update Data</button>
						</div>
						</div>
					</form>
					
				</div>

				</div>
			</div>
			</div>
		</div>
		@endforeach
@endsection	



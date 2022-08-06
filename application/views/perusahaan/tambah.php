<div class="container mt-5 mb-5 pb-5 bg-light">
	
	<div class="row mt-3 mx-auto bg-item" style="width: 100%;">

		<div class="col-md-6 mx-auto" style="width: 100%;">


			<div class="card mt-5">
			  <div class="card-header">
			    Form Tambah Perusahaan
			  </div>

				  <div class="card-body">

					<form action="" method="post">

					<div class="form-group">
						<label for="perusahaan">Nama Perusahaan</label>
						<input type="text" name="perusahaan" class="form-control" id="perusahaan">
						<small class="form-text text-danger"><?= form_error('perusahaan') ?></small>
					</div>	

					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" class="form-control" id="alamat">
						<small class="form-text text-danger"><?= form_error('alamat') ?></small>
					</div>

					<div class="form-group">
						<label for="sektor">Sektor</label>
						<input type="text" name="sektor" class="form-control" id="sektor">
						<small class="form-text text-danger"><?= form_error('sektor') ?></small>
					</div>	

					<button type="submit" name="tambah" class="btn btn-primary float-right">Simpan</button>

					</form>

					

				  </div>
				  
			</div>

		

		</div>

	</div>

</div>
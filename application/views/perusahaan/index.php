<div class="container mt-5 mb-5 pb-5 bg-light">

	<?php if( $this->session->flashdata('data') ) : ?>

	<div class="row mt-3">
		<div class="col mt-6">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  Data Pelanggan<strong> Berhasil </strong><?= $this->session->flashdata('data'); ?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		</div>
	</div>

	<?php endif; ?>
	
	<div class="row mt-3 mx-auto bg-item" style="width: 100%;">

		<div class="col-md-6 mx-auto" style="width: 100%;">
			<table class=" container mx-auto table table-hover table-bordered" 
			style="width: 100%;">
			<h3 class="w3-center mt-4 mb-4">Barang Keluar</h3>

			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Nama Perusahaan</th>
			      <th scope="col">alamat</th>
			      <th scope="col">sektor</th>
			    </tr>
			  </thead>
				<?php foreach( $perusahaan2 as $phs2 ) : ?>
			  <tbody>
			    <tr>
			      <td><?= $phs2['nama_kostumer']; ?></td>
			      <td><?= $phs2['alamat_perusahaan']; ?></td>
			      <td><?= $phs2['id_sektor']; ?></td>
					
			    </tr>
			  </tbody>
			  	<?php endforeach; ?>

			</table>

		</div>

	</div>

	<div class="row mt-3 w3-center">
		<div class="col-md-6 mx-auto" style="width:  100%">
			<a href="<?= base_url(); ?>perusahaan/tambah" class="btn btn-info ">Tambah Perusahaan</a>
		</div>
	</div>

</div>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>warga">Warga</a></li>
                                        <li class="breadcrumb-item active">Tambah</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Tambah Data Warga</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Tambah Data Warga</h4>
                                <div class="card-body">
									<form method="POST" action="<?php echo base_url(); ?>warga/store">
										<div class="mb-3">
											<label for="simpleinput" class="form-label">Nama</label>
											<input type="text" name="nama" id="simpleinput" class="form-control" placeholder="Nama Lengkap">
										</div>

										<div class="mb-3">
											<label for="tempat_lahir" class="form-label">Tempat Lahir</label>
											<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
										</div>

										<div class="mb-3">
											<label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
											<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
										</div>
										
										<div class="mb-3">
											<label for="input_alamat" class="form-label">Alamat</label>
											<textarea class="form-control" name="alamat" id="input_alamat" rows="5" placeholder="Alamat"></textarea>
										</div>
										<div class="mb3">
											<div class="form-check form-check-inline">
												<input type="checkbox" name="pns" class="form-check-input" id="checkIsPns">
												<label class="form-check-label" for="checkIsPns">PNS</label>
											</div>
										</div>
										<div class="mb-3">
											<label for="input_gaji" class="form-label">Gaji</label>
											<input type="number" name="gaji" id="input_gaji" class="form-control" placeholder="Gaji Yang didapat">
										</div>
										<div class="mb-3">
											<button type="submit" class="btn btn-success btn-sm float-end">Simpan</button>
										</div>
										<div class="clearfix"></div>
									</form>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>document.write(new Date().getFullYear())</script> © Kelurahan <b>Pedurungan Tengah</b>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

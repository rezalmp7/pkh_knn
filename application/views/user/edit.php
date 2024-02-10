
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
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>user">Tables</a></li>
                                        <li class="breadcrumb-item active">Edit</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Edit Data User</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title">Tambah Data <?php echo $user->nama; ?></h4>
                                <div class="card-body">
									<form method="POST" action="<?php echo base_url(); ?>user/update/<?php echo $user->id; ?>">
										<div class="mb-3">
											<label for="simpleinput" class="form-label">Nama</label>
											<input type="text" name="nama" value="<?php echo $user->nama; ?>" id="simpleinput" class="form-control" placeholder="Nama Lengkap">
										</div>

										<div class="mb-3">
											<label for="username" class="form-label">Username</label>
											<input type="text" name="username" id="username" value="<?php echo $user->username; ?>" class="form-control" placeholder="Username">
										</div>

										<div class="mb-3">
											<label for="example-password" class="form-label">Ganti Password</label>
											<input type="password" name="password" id="example-password" class="form-control">
										</div>

										<div class="mb-3">
											<label for="example-password" class="form-label">Level</label>
											<select class="form-select" name="level" id="example-select">
												<option value="user" <?php if($user->level == 'user') echo "selected"; ?>>User</option>
												<option value="admin" <?php  if($user->level == 'admin') echo "selected";  ?>>Admin</option>
											</select>
										</div>

										<div class="mb-3">
											<button type="submit" class="btn btn-success btn-sm">Simpan</button>
										</div>

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

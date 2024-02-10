
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
                                        <li class="breadcrumb-item active">Calculate</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Calculate</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title d-inline">Data Wargas</h4>
                                <div class="card-body">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>PNS</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											foreach ($wargas as $key => $value) {
											?>
                                            <tr>
                                                <td><?php echo $value->nama; ?></td>
                                                <td><?php echo $value->is_pns ? 'PNS' : 'Non PNS'; ?></td>
                                                <td>Rp <?php echo number_format($value->gaji); ?></td>
                                            </tr>
											<?php
											}
											?>
                                        </tbody>
                                    </table>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="header-title d-inline">Data Normalized</h4>
									<div class="row d-inline float-end">
										<form action="<?php echo base_url(); ?>calculate/calculate" method="POST">
											<div class="input-group mb-3">
												<input type="number" name="k_value" class="form-control" placeholder="K Value" min="5" max="<?php echo $totalSampleData; ?>" required>
												<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Normalize</button>
											</div>
										</form>
									</div>
								</div>
                                <div class="card-body">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>PNS</th>
                                                <th>Gaji</th>
                                                <th>Tetangga Terdekat</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											foreach ($wargas_normalized as $key => $value) {
											?>
                                            <tr>
                                                <td><?php echo $value->nama; ?></td>
                                                <td><?php echo $value->is_pns; ?></td>
                                                <td><?php echo $value->type_gaji; ?></td>
                                                <td><?php echo $value->tetangga_terdekat; ?></td>
                                                <td><?php echo $value->status == 1? "Dapat Bantuan" : "Tidak Dapat Bantuan"; ?></td>
                                            </tr>
											<?php
											}
											?>
                                        </tbody>
                                    </table>
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


			<div class="page-content-wrapper">
				<div class="page-content">
					<h3 class="page-title">
					Dashboard
					</h3>
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo base_url('admin/admin');?>">Home</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Dashboard</a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
							<div class="alert alert-block alert-success fade in">
								<button type="button" class="close" data-dismiss="alert"></button>
								<h4 class="alert-heading">Selamat datang !!</h4>
								<p>
									Hai <?php echo $this->session->userdata('first_name');?>, selamat datang di halaman <?php echo $this->session->userdata('nama_group');?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php $this->load->view('admin/footer');?>
</body>
</html>
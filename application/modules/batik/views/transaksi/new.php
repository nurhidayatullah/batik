	<link rel="stylesheet" href="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.ui/jquery-ui.css">
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small><?php echo $this->page;?></small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url('admin/admin');?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="javascript:;"><?php echo $this->page;?></a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">New <?php echo $this->page;?></div>
							<div class="tools">
								<a href="javascript:;" class="fullscreen">
								</a>
							</div>
						</div>
						<div class="portlet-body">
						<?php if(!empty($msg)){?>
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<strong>Error</strong><?php echo $msg;?>
							</div>
						<?php } ?>
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a href="<?php echo base_url('batik/transaksi/index/'.$menu);?>" class="btn btn-danger">Cancel <i class="fa fa-mail-reply"></i></a>
										</div>
									</div>
								</div>
							</div>
							<form class="" method="post" role="form" action="<?php echo base_url('batik/transaksi/save/');?>">
								<div class="form-group">
									<label for="cust">Customers
									<input id="cust" class="form-control" type="text" name="cust" autocomplete="off" required />
									<input type="hidden" name="menu" value="<?php echo $menu;?>" required />
								</div>
								<div class="form-group">
									<label for="batik">Jenis Batik
									<input id="batik" class="form-control" type="text" name="batik" autocomplete="off" required />
								</div>
								<div class="form-group">
									<label for="ukuran">Ukuran
									<input class="form-control" type="text" name="ukuran" autocomplete="off" required />
								</div>
								<div class="form-group">
									<label for="jumlah">Jumlah
									<input class="form-control" type="number" name="jumlah" autocomplete="off" required />
								</div>
								<div class="form-group">
									<label for="keterangan">Keterangan
									<textarea class="form-control" name="keterangan"></textarea>
								</div>
								<div class="form-group">
								  <button type="submit" class="btn btn-success">Submit <i class="fa fa-download"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/footer');?>
  <script src="<?php echo $this->config->item('theme_url');?>global/plugins/jquery.ui/jquery-ui.js"></script>
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
	$(function(){
		if ( ! ('keterangan' in CKEDITOR.instances)) {
			CKEDITOR.replace('keterangan');
		}
		    
		$( "#cust" ).autocomplete({
		  source: "<?php echo base_url('data/get_cust');?>",
		  minLength: 2
		});
		$( "#batik" ).autocomplete({
		  source: "<?php echo base_url('data/get_batik');?>",
		  minLength: 2
		});
	})

</script>
</body>
</html>
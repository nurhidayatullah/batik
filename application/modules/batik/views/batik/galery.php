<style>
@media(max-width: 310px){
	.galery{
		width: 100%;
	}
}
</style>
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="modal fade" id="modal">						
					</div>
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
								<a href="#"><?php echo $this->page;?></a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="row">
								<?php foreach($galery as $data){ ?>
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 galery">
									<div class="thumbnail">
										<?php if(isset($data['foto'])){
											$img = $this->config->item('theme_url')."upload/batik/".$data['foto'];
										}else{
											$img = $this->config->item('theme_url')."img/up.jpg";
										} ?>
										<img src="<?php echo $img;?>" alt="" style="width: 100%; height: 200px;">
										<div class="caption">
											<h5><?php echo $data['nama_batik'];?></h5>
											<p>
												<a href="javascript:;" onclick="detail('<?php echo $this->my_encrypt->encode($data['id_batik']);?>')" class="btn btn-sm blue">Detail</a>
											</p>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div>
					<!-- END DASHBOARD STATS -->
					<div class="clearfix">
					</div>
				</div>
			</div>
		</div>
<?php $this->load->view('admin/footer');?>
<script>
	function detail(id){
		$("#modal").html(
			$.ajax({
				url:'<?php echo base_url();?>data/galery/'+id,async: false
				}).responseText);
		$("#modal").modal('show');
	}
</script>
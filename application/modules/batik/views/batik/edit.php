<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
<?php 
foreach($batik as $data){
	$id = $this->my_encrypt->encode($data['id_batik']);
	$nama = $data['nama_batik'];
	$keterangan = $data['keterangan'];
	$foto = $data['foto'];
}?>
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
							<div class="caption">Edit <?php echo $this->page;?></div>
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
											<a href="<?php echo base_url('batik/batik/index/'.$menu);?>" class="btn btn-danger">Cancel <i class="fa fa-mail-reply"></i></a>
										</div>
									</div>
								</div>
							</div>
							<form class="" method="post" role="form" action="<?php echo base_url('batik/batik/update/'.$id);?>" enctype="multipart/form-data">
								<div class="form-group">
									<label for="nama">Nama
									<input class="form-control" type="text" name="nama" value="<?php echo $nama;?>" required />
									<input type="hidden" name="menu" value="<?php echo $menu;?>" required />
								</div>
								<div class="form-group">
								<label for="foto">Foto
									<div class='controls'>
									<?php if(isset($foto)){
										$img = $this->config->item('theme_url')."upload/batik/".$foto;
									}else{
										$img = $this->config->item('theme_url')."img/up.jpg";
									} ?>
										<img src="<?php echo $img;?>" id="gambar" width="100px">
										<span class="btn btn-default btn-file">
											Browse Image <input id="foto" class="btn" type="file" name="foto" onchange="return preview_gambar();"/>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="keterangan">Keterangan
									<textarea class="form-control" name="keterangan"><?php echo $keterangan;?></textarea>
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
<script src="<?php echo $this->config->item('theme_url');?>global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
	function preview_gambar(){
		var reader = new FileReader();
		reader.readAsDataURL(document.getElementById("foto").files[0]);
		reader.onload = function(oFREvent){
			document.getElementById('gambar').src = oFREvent.target.result;
		};
	}
	$(function(){
		if ( ! ('keterangan' in CKEDITOR.instances)) {
			CKEDITOR.replace('keterangan');
		}
	})
</script>
</body>
</html>
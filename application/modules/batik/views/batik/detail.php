<?php 
foreach($detail as $data){
		$nama = $data['nama_batik'];
		$ket = $data['keterangan'];
		$foto = $data['foto'];
}?>
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title"><?php echo $nama;?></h4>
		</div>
		<div class="modal-body">
			 <div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<?php if(isset($foto)){
					$img = $this->config->item('theme_url')."upload/batik/".$foto;
				}else{
					$img = $this->config->item('theme_url')."img/up.jpg";
				} ?>
					<img src="<?php echo $img;?>" class="img-responsive" />
				</div>
				 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
					<?php echo $ket;?>
				 </div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
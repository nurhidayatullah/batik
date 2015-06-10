
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title">Detail Transaksi</h4>
		</div>
		<div class="modal-body">
			 <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="portlet box green-haze tasks-widget">
						<div class="portlet-title">
							<div class="caption">Detail Transaksi</div>
							<div class="tools">
								<a href="javascript:;" class="fullscreen">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
								</div>
							</div>
							<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="tb">
								<thead>
									<tr>
										<th>No.</th>
										<th>Tanggal</th>
										<th>Jenis Batik</th>
										<th>Ukuran</th>
										<th>Jumlah</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>
								<?php if(isset($detail)){
									$i=1;
									foreach($detail as $data){
										?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $data['tgl_transaksi'];?></td>
										<td><?php echo $data['nama_batik'];?></td>
										<td><?php echo $data['ukuran'];?></td>
										<td><?php echo $data['jumlah'];?></td>
										<td><a href="#" class="btn btn-primary" onclick="ket('<?php echo $data['id_transaksi'];?>')">detail</a></td>
									</tr>
									<?php $i++;
									}
								}?>
								</tbody>
							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
</div>
<script>
	function ket(id){
		$("#modal").html(
			$.ajax({
				url:'<?php echo base_url();?>data/ket/'+id,async: false
				}).responseText);
		$("#modal").modal('show');
	}
	function tutup(){
		$("#modal").modal('hide');
	}
</script>
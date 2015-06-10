<?php foreach($priv as $akses){
	$tambah = $akses['itambah'];
	$edit = $akses['iupdate'];
	$hapus = $akses['idelete'];
}?>
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="modal fade" id="portlet-config">
					</div>
					<div class="modal fade" id="modal" style="position:absolute;">						
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
							<div class="portlet box green-haze tasks-widget">
								<div class="portlet-title">
									<div class="caption"><?php echo $this->page;?></div>
									<div class="tools">
										<a href="javascript:;" class="fullscreen">
										</a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
											<?php if($tambah){?>
												<div class="btn-group">
													<a href="<?php echo base_url('batik/customers/new_data/'.$menu);?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
												</div>
											<?php }
											 if(!empty($msg)){ 
												if($msg==0){
													?>
												<div class="alert alert-warning alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
													<strong>Failed</strong>
												</div>
												<?php }else if($msg==1){?>
												<div class="alert alert-success alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
													<strong>Success</strong>
												</div>
												<?php }} ?>
											</div>
											<div class="col-md-6">
											</div>
										</div>
									</div>
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="tb">
										<thead>
											<tr>
												<th>No.</th>
												<th>Nama Customers</th>
												<th>Alamat</th>
												<th>Kota</th>
												<th>Telp</th>
												<th>Foto</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($customers)){
											$i=1;
											foreach($customers as $data){
												?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $data['nama_cust'];?></td>
												<td><?php echo $data['alamat'];?></td>
												<td><?php echo $data['kota'];?></td>
												<td><?php echo $data['telp'];?></td>
												<td><img src="<?php echo $this->config->item('theme_url');?>upload/cust/<?php echo $data['foto'];?>" width="40"/></td>
												<td>
												<?php if($edit){?>
													<a href="<?php echo base_url('batik/customers/edit/'.$menu.'/'.$this->my_encrypt->encode($data['id_cust']));?>" class="btn btn-xs purple">Edit <i class="fa fa-pencil-square-o"></i></a>&nbsp;
												<?php } 
												if($hapus){
												?>	
													<a href="<?php echo base_url('batik/customers/hapus/'.$menu.'/'.$this->my_encrypt->encode($data['id_cust']));?>" class="btn btn-xs red">Hapus <i class="fa fa-trash"></i></a>
												<?php } ?>
												<?php if($data['jumlah']>0){?>
													<a href="#" class="btn"onclick="detail('<?php echo $this->my_encrypt->encode($data['id_cust']);?>')">Detail<span class="badge badge-default"><?php echo $data['jumlah'];?></span></a>
												<?php } ?>
												</td>
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
					<!-- END DASHBOARD STATS -->
					<div class="clearfix">
					</div>
				</div>
			</div>
		</div>
<?php $this->load->view('admin/footer');?>
<script>
	function detail(cust){
		$("#portlet-config").html(
			$.ajax({
				url:'<?php echo base_url();?>data/detail/'+cust,async: false
				}).responseText);
		$("#portlet-config").modal('show');
	}
</script>
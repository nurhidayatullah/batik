<?php foreach($priv as $akses){
	$tambah = $akses['itambah'];
	$edit = $akses['iupdate'];
	$hapus = $akses['idelete'];
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
													<a href="<?php echo base_url('batik/transaksi/new_data/'.$menu);?>" class="btn green">Add New <i class="fa fa-plus"></i></a>
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
												<th>Tanggal</th>
												<th>Nama Customers</th>
												<th>Nama Batik</th>
												<th>Ukuran</th>
												<th>Jumlah</th>
												<th>Keterangan</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($transaksi)){
											$i=1;
											foreach($transaksi as $data){
												?>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo $data['tgl_transaksi'];?></td>
												<td><?php echo $data['nama_cust'];?></td>
												<td><?php echo $data['nama_batik'];?></td>
												<td><?php echo $data['ukuran'];?></td>
												<td><?php echo $data['jumlah'];?></td>
												<td><?php echo substr($data['keterangan'],0,20);?></td>
												<td>
												<?php if($edit){?>
											<!--		<a href="<?php echo base_url('batik/transaksi/edit/'.$menu.'/'.$this->my_encrypt->encode($data['id_transaksi']));?>" class="btn btn-xs purple">Edit <i class="fa fa-pencil-square-o"></i></a>&nbsp;-->
												<?php } 
												if($hapus){
												?>	
													<a href="<?php echo base_url('batik/transaksi/hapus/'.$menu.'/'.$this->my_encrypt->encode($data['id_transaksi']));?>" class="btn btn-xs red">Hapus <i class="fa fa-trash"></i></a></td>
												<?php } ?>
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
<?php $this->load->view('admin/footer');
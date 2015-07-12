<div id="content-header">
	<h1><?=lang('enter_financial_data')?></h1>
	<!--<div class="btn-group">
	<a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
	<a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
	<a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
	<a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
	</div>-->
</div>
<div id="breadcrumb">
	<a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
	<a href="#"><?=lang('financial_data')?></a>
	<a class="current" href="#"><?=lang('enter_financial_data')?></a>
</div>
<div class="widget-box" style="margin: 5px;">
	<div class="widget-title">
		<span class="icon">
			<i class="fa fa-th"></i>
		</span>
		<h5>Avaliable Forms</h5>
	</div>
	<div class="widget-content nopadding">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Form Name</th>
											
											
					<th>Form Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//var_dump($res);
				foreach($res as $row){?>
										
					<tr>
						<td><?=$row->FormCode;?> - <?=$row->Heading;?></td>
																	
						<td><button class="btn btn-success btn-sm" onclick="loadform('<?=base_url()?>forms/view/<?=$row->FormCode?>')">Open</button>&nbsp;<button class="btn btn-success btn-sm" onclick="window.open('<?=base_url()?>dataupload?FormCode=<?=$row->FormCode?>', '', 'width=400, height=200')"><i class="fa fa-upload"></i> Upload From TXT</button></td>

					</tr>
					<?php } ?>
			</tbody>
		</table>							
	</div>
</div>

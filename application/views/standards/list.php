<div id="content-header">
	<h1><?=lang('list_standards')?></h1>
	<!--<div class="btn-group">
	<a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
	<a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
	<a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
	<a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
	</div>-->
</div>
<div id="breadcrumb">
	<a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
	<a href="#"><?=lang('standards')?></a>
	<a class="current" href="#"><?=lang('list_standards')?></a>
</div>
<div class="widget-box" style="margin: 5px;">
	<div class="widget-title">
		<span class="icon">
			<i class="fa fa-th"></i>
		</span>
		<h5>Active Standards</h5>
	</div>
	<div class="widget-content nopadding">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Financial Statement Name</th>
					<th>Field Name</th>
					<th>Minimum Value</th>
					<th>Maximum Value</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//var_dump($res);
				foreach($res as $row){?>
					<tr>
						<td>
							<?=$row->Heading?>
						</td>
						<td>
							<?=$row->Description?>
						</td>
						<td>
							<?=$row->Min?>
						</td>
						<td>
							<?=$row->Max?>
						</td>
						<td><button class="btn btn-primary btn-sm" onclick="loadform('<?=base_url()?>standards/update/<?=$row->Id?>','Edit Standard')">Edit</button>&nbsp;<button onclick="deleteStandard('<?=$row->Id?>','<?=$row->Description;?>')" class="btn btn-danger btn-sm">Delete</button></td>
					</tr>
					<?php } ?>
			</tbody>
		</table>							
	</div>
</div>

<div id="content-header">
    <h1><?=lang('approval_queue')?></h1>
    <!--<div class="btn-group">
            <a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
            <a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
            <a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
            <a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
    </div>-->
</div>
<div id="breadcrumb">
    <a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
    <a href="#"><?=lang('forms')?></a>
    <a class="current" href="#"><?=lang('approval_queue')?></a>
</div>
<div id="accordion" class="accordion">
<div class="widget-box">
		<div class="widget-title">
			<a href="#">
				<span class="icon"><i class="fa fa-file-o"></i></span><h5><?=count($forms)?> Pending Forms</h5>
			</a>
		</div>
	
		<div class="widget-content">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Data ID</th>
						<th>Form Name</th>
						<th>Type</th>
						<th>Institution</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
												
		<?php
		foreach ($forms as $row) {
			
		
		?>								
					<tr>
						<td><?=$row->id?></td>
						<td><?=$row->FormCode?> - <?=$row->Heading?></td>
						<td><?=$row->TimePeriod?></td>
						<td><?=$row->Company?></td>
						<td><button class="btn btn-primary btn-sm" onclick="loadform('<?=base_url()?>forms/preview/<?=$row->FormCode?>/<?=$row->id?>')">View</button> <button class="btn btn-success btn-sm" onclick="loadform('<?=base_url()?>approve/approveForm/<?=$row->id?>')">Approve</button> <a href="#" onclick="loadform('http://localhost/hansi/approve/reject/Form/<?=$row->uid?>/<?=$row->id?>','Form Reject')" class="btn btn-danger btn-sm">Reject</a></td>

					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
		<?php
		if($this->aauth->is_allowed('Administrator')) {
			
		?>
	<div class="widget-box">
	
		<div class="widget-title">
			<a href="#">
				<span class="icon"><i class="fa fa-dashboard"></i></span><h5><?=count($standards)?> Pending Standards</h5>
			</a>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Standard Name</th>
						<th>NewMin-NewMax</th>
						<th>OldMin-OldMax</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
												
					<?php 
					foreach($standards as $row){
				
			
						?>								
						<tr>
							<td><?=$row->FormCode?> - <?=$row->Description?></td>
							<td><?=$row->NewMin?> - <?=$row->NewMax?></td>
							<td><?=$row->OldMin?> - <?=$row->OldMax?></td>
							<td><button class="btn btn-success btn-sm" onclick="loadform('<?=base_url()?>approve/approveStandard/<?=$row->RowID?>/<?=$row->id?>/<?=$row->NewMin?>/<?=$row->NewMax?>')">Approve</button> <a onclick="loadform('http://localhost/hansi/approve/reject/Standard/<?=$row->uid?>/<?=$row->id?>','Standard Reject')" class="btn btn-danger btn-sm">Reject</a></td>

						</tr>
						
						<?php 
					}
					?>
					
				</tbody>
			</table>
		</div>
	</div> 
	
	<div class="widget-box">
		<div class="widget-title">
			<a href="#">
				<span class="icon"><i class="fa fa-bell"></i></span><h5><?=count($alerts)?> Pending Alert</h5>
			</a>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Form Name</th>
						<th>Section</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
		foreach ($alerts as $row) {
			
		
		?>								
			
				
												
										
					<tr>
						<td><?=$row->FormCode?></td>
						<td><?=$row->Description?></td>
						<td><button class="btn btn-success btn-sm" onclick="loadform('<?=base_url()?>approve/approveAlert/<?=$row->id?>')">Approve and Send</button> <a href="#" onclick="loadform('http://localhost/hansi/approve/reject/Alert/<?=$row->uid?>/<?=$row->id?>','Alert Reject')" class="btn btn-danger btn-sm">Reject</a></td>
					</tr>
					<?php 
						
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	 } ?>
</div>
				
<script type="text/javascript">
	$( "#accordion" ).accordion({
			header: '.widget-title',
			animation: "easeInOutBounce",
			collapsible: true,
			heightStyle: "content"
		});
</script>

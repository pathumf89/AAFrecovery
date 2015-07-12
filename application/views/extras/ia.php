<div id="content-header">
	<h1><?=lang('institutional_analysis')?></h1>
	<!--<div class="btn-group">
	<a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
	<a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
	<a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
	<a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
	</div>-->
</div>
<div id="breadcrumb">
	<a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
   
	<a class="current" href="#"><?=lang('institutional_analysis')?></a>
</div>
<div id="accordion" class="accordion">
	<div class="widget-box">
		<div class="widget-title">
			<a href="#">
				<span class="icon"><i class="fa fa-play"></i></span><h5>Annual Financial Indicators</h5>
			</a>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>FormCode</th>
						<th>Feild Description</th>
						<th>Institution</th>
						<th>Current Value</th>
						<th>Standard Min</th>
						<th>Standard Max</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($res as $row){
					if($row->TimePeriod=="Y") {
						
					
						?>
						<tr>
					<td><?=$row->FormCode?></td>
						<td><?=$row->Description?></td>
						<td><?=$this->aauth->get_group_name($row->CompanyId)?></td>
						<td><div class="label <? if(($row->value/$row->Min)>0.5||($row->value/$row->Max)>0.5){echo 'label-danger';}else {echo 'label-warning';}?>"><?=$row->value?></div></td>
						<td><?=$row->Min?></td>
						<td><?=$row->Max?></td>
						</tr>
						<?php
					}}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="widget-box">
		<div class="widget-title">
			<a href="#">
				<span class="icon"><i class="fa fa-play"></i></span><h5>Monthly Financial Indicators</h5>
			</a>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>FormCode</th>
						<th>Feild Description</th>
						<th>Institution</th>
						<th>Current Value</th>
						<th>Alert Min</th>
						<th>Alert Max</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($res as $row){
					if($row->TimePeriod=="M") {
						
					
						?>
						<tr>
					<td><?=$row->FormCode?></td>
						<td><?=$row->Description?></td>
						<td><?=$this->aauth->get_group_name($row->CompanyId)?></td>
						<td><div class="label <? if(($row->value/$row->Min)>0.5||($row->value/$row->Max)>0.5){echo 'label-danger';}else {echo 'label-warning';}?>"><?=$row->value?></div></td>
						<td><?=$row->Min?></td>
						<td><?=$row->Max?></td>
						</tr>
						<?php
					}}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="widget-box">
		<div class="widget-title">
			<a href="#">
				<span class="icon"><i class="fa fa-play"></i></span><h5>Weekly Financial Indicators</h5>
			</a>
		</div>
		<div class="widget-content">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>FormCode</th>
						<th>Feild Description</th>
						<th>Institution</th>
						<th>Current Value</th>
						<th>Alert Min</th>
						<th>Alert Max</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($res as $row){
					if($row->TimePeriod=="W") {
						
					
						?>
						<tr>
					<td><?=$row->FormCode?></td>
						<td><?=$row->Description?></td>
						<td><?=$this->aauth->get_group_name($row->CompanyId)?></td>
						<td><div class="label <? if(($row->value/$row->Min)<0.5||($row->value/$row->Max)>0.5){echo 'label-danger';}else {echo 'label-warning';}?>"><?=$row->value?></div></td>
						<td><?=$row->Min?></td>
						<td><?=$row->Max?></td>
						</tr>
						<?php
					}}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
				
<script type="text/javascript">
	$( "#accordion" ).accordion({
			header: '.widget-title',
			animation: "easeInOutBounce",
			collapsible: true,
			heightStyle: "content"
		});
</script>

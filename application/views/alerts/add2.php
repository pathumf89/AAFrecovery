<div id="content-header">
	<h1><?=lang("new_alert")?></h1>
	<!--<div class="btn-group">
	<a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
	<a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
	<a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
	<a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
	</div>-->
</div>
<div id="breadcrumb">
	<a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
	<a href="#"><?= lang("alert")." ".lang("management") ?></a>
	<a class="current" href="#"><?=lang("new_alert")?></a>
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
					<th>Min</th>
					<th>Max</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//var_dump($res);
				foreach($res as $row){ ?>
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
						<td>
							<form method="post" name="form1"  id="<?=$row->Id?>" action="<?= base_url(); ?>alert/add">
							<input type="hidden" name="RowId" value="<?=$row->Id?>"/>
								<select name="DeptId">
									<?php
									foreach($groups as $group)
									{
										?>
										<option value="<?=$group->id?>"><?=$group->name?></option>
										<?php
										}	
									?>
								</select>
								<input class="btn btn-sm btn-success" value="Add Alert" type="submit"></input>
							</form>
						</td>
						
					</tr>
					<?php } ?>
			</tbody>
		</table>							
	</div>
</div>

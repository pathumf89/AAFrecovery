<div id="content-header">
    <h1>View Alerts</h1>
    <!--<div class="btn-group">
            <a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
            <a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
            <a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
            <a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
    </div>-->
</div>
<div id="breadcrumb">
    <a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
    <a href="#">Alerts</a></a>
    <a class="current" href="#">View Alerts</a>
</div>
<div class="widget-box" style="margin: 5px;">
							<div class="widget-title">
								<span class="icon">
									<i class="fa fa-th"></i>
								</span>
								<h5>Active Alerts</h5>
							</div>
	<div class="widget-content nopadding">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Financial Statement Name</th>
					<th>Field Name</th>
					<th>Alert Creator</th>
					<th>Alerting Institution</th>
					<th>Alert Created Date</th>
					<th>Alert Approver</th>
					<th>Alert Approved Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//var_dump($res);
				foreach($res as $row){?>
					<tr>
						<td>
							<?=$row['Heading']?>
						</td>
						<td>
							<?=$row['Description']?>
						</td>
						<td>
							<?=$row['UserId']?>
						</td>
						<td>
							<?=$this->aauth->get_group_name($row['Dept'])?>
						</td>
						<td>
							<?=$row['AlertDate']?>
						</td>
						<td>
							<?=$row['ApproverId']?>
						</td>
						<td>
							<?=$row['ApprovedDate']?>
						</td>
						<td></td>
					</tr>
					<?php } ?>
			</tbody>
		</table>							
	</div>
</div>

			<div style="margin: 5px;" class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="fa fa-th"></i>
		</span>
		<h5>Active Users</h5>
	</div>
	<div class="widget-content nopadding">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email (Login)</th>
					<th>Institution</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($USER_LIST as $row){
					?>
				
					<tr>
						<td><?=$row->name;?></td>
						<td><?=$row->email;?></td>
						<td><?=$this->aauth->get_group_name($this->aauth->get_company($row->id));?></td>
						<td><a  href="#" class="btn btn-danger btn-sm" onclick="rusure('Are You Sure to delete this user?','<?= base_url() ?>user/delete/<?=$row->id?>')">Delete</button></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>							
	</div>
</div>
			

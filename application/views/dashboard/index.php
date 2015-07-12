<div class="row text-center">
	<div class="col-xs-12">
		<div class="widget-box widget-plain">
			
			<img style="margin-left: auto; margin-right: auto;"  src="<?=base_url()?>ui/img/cbsl.png"/>	
							
		</div>
	</div>
</div>
<div class="row text-center">
	<div class="col-xs-12 center">
		<?php if(lang('login') == "Login"){
			$this->load->view('dashboard/welcome_en');
		}
		else {
			if(lang('login') == "உள்நுழைவூ")
			{
				
			$this->load->view('dashboard/welcome_ta');
		
			}
			else {
			$this->load->view('dashboard/welcome_si');
		}
		}
		?>
	</div>
</div>
<div class="row">
	<div style="text-align: center;" class="col-xs-12 center">					
		<ul class="quick-actions">
			<li>
				<a href="#">
					<i class="fa fa-file" style="color:red;font-size: 64px;"></i>
					<br/>
					<?= lang("financial") ?> <?= lang("statements") ?>
					<br/>
					<h4><?=$stat->Forms?></h4>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-dashboard" style="color:#f9c806;font-size: 64px;"></i>
					<br/>
					<?= lang("standards") ?>
					<br/>
					<h4><?=$stat->Standards?></h4>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-bell" style="color:#70a600;font-size: 64px;"></i>
					<br/>
					<?= lang("alert")?>
					<br/>
					<h4><?=$stat->Alerts?></h4>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-bar-chart-o" style="color:#0248bd;font-size: 64px;"></i>
					<br/>
					<?= lang("graphs")?>
					<br/>
					<h4><?=$reports?></h4>
				</a>
			</li>
						<li>
				<a href="#">
					<i class="fa fa-eye" style="color:#83058d;font-size: 64px;"></i>
					<br/>
					<?= lang("pending_tasks")?>
					<br/>
					<h4><?=$stat->PendingTasks?></h4>
				</a>
			</li>
		</ul>
	</div>
</div>
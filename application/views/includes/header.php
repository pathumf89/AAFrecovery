<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=lang("fdcas")?></title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="<?= base_url() ?>ui/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>ui/css/font-awesome.css" />
	<link rel="stylesheet" href="<?= base_url() ?>ui/css/jquery.jscrollpane.css" />	
	<link rel="stylesheet" href="<?= base_url() ?>ui/css/unicorn.css" />
	<link rel="stylesheet" href="<?= base_url() ?>ui/css/select2.css" />
	<link rel="stylesheet" href="<?= base_url() ?>ui/css/jquery-ui.css" />
	<link rel="stylesheet" href="<?= base_url() ?>ui/css/jquery-te-1.4.0.css" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="<?= base_url() ?>ui/js/respond.min.js"></script>
	<![endif]-->

</head>	
<body data-color="red" class="old">
<div id="wrapper">
<div id="header">
	<h1 style="color: #FFF5F5"></h1>	
	<a id="menu-trigger" href="#"><i class="fa fa-bars"></i></a>	
</div>

<div id="user-nav">
	<ul class="btn-group">
		<li class="btn" ><a title="" href="#"><i class="fa fa-user"></i> <span class="text"><?=
					lang('welcome')?> <?=$this->aauth->get_user()->name?></span></a></li>
		<li class="btn dropdown" id="menu-messages" >
			<!-- this will be filled by ajax pmload()-->			
		</li>
		<li class="btn"><a title="" href="#"><i class="fa fa-cog"></i> <span class="text"><?=
					lang('settings')?></span></a></li>
		<li class="btn"><a title="" href="<?=base_url()?>user/logout"><i class="fa fa-share"></i> <span class="text"><?=
					lang('logout')?></span></a></li>
	</ul>
</div>

<div id="switcher">
	<div id="switcher-inner">
		<h3>Theme Options</h3>
		<h4>Colors</h4>
		<p id="color-style">
			<a data-color="orange" title="Orange" class="button-square orange-switcher" href="#"></a>
			<a data-color="turquoise" title="Turquoise" class="button-square turquoise-switcher" href="#"></a>
			<a data-color="blue" title="Blue" class="button-square blue-switcher" href="#"></a>
			<a data-color="green" title="Green" class="button-square green-switcher" href="#"></a>
			<a data-color="red" title="Red" class="button-square red-switcher" href="#"></a>
			<a data-color="purple" title="Purple" class="button-square purple-switcher" href="#"></a>
			<a href="#" data-color="grey" title="Grey" class="button-square grey-switcher"></a>
		</p>
		<!--
		<h4>Background Patterns</h4>
		<h5>for boxed version</h5>
		<p id="pattern-switch">
		<a data-pattern="pattern1" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern1.png');" class="button-square" href="#"></a>
		<a data-pattern="pattern2" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern2.png');" class="button-square" href="#"></a>
		<a data-pattern="pattern3" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern3.png');" class="button-square" href="#"></a>
		<a data-pattern="pattern4" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern4.png');" class="button-square" href="#"></a>
		<a data-pattern="pattern5" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern5.png');" class="button-square" href="#"></a>
		<a data-pattern="pattern6" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern6.png');" class="button-square" href="#"></a>
		<a data-pattern="pattern7" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern7.png');" class="button-square" href="#"></a>
		<a data-pattern="pattern8" style="background-image:url('assets/<?= base_url() ?>ui/img/patterns/pattern8.png');" class="button-square" href="#"></a>
		</p>-->
		<h4 class="visible-lg">Layout Type</h4>
		<p id="layout-type">
			<a data-option="flat" class="button" href="#">Flat</a>
			<a data-option="old" class="button" href="#">Old</a>                    
		</p>
	</div>
	<div id="switcher-button">
		<i class="fa fa-cogs"></i>
	</div>
</div>

<div id="sidebar">
	<ul>
	<?php
	if($this->aauth->get_group_name($this->aauth->get_group_id($this->aauth->get_user_id()))=="APP_ADMIN"){
		?>

		<li class="submenu">
			<a href="#"><i class="fa fa-file"></i>User Management</span> <i class="arrow fa fa-chevron-right"></i></a>
			<ul>
				<li><a href="#" onclick="loadform('<?=base_url()?>user/add','Add User')">Add User</a></li>
				<li><a href="#" onclick="loadform('<?=base_url()?>user/assign','Assign Users')">Assign Users</a></li>
				
			</ul>
		</li>
		<?php 
	} 
	else{
	
	?>
	
	<li class="active"><a href="<?=base_url()?>dashboard"><i class="fa fa-home"></i> <span><?= lang("dashboard") ?></span></a></li>
	
	<?php if($this->aauth->is_allowed('DataContoller') || $this->aauth->is_allowed('Approver')){ ?>
	<li><a href="<?=base_url()?>extras/add_master_data/<?=$this->aauth->get_company()?>"><i class="fa fa-briefcase"></i><?=lang('master_data')?></a></li>
		<?
	}}
	?>
	<?php if($this->aauth->is_allowed('Administrator')){ ?>
	<li class="submenu">
			<a href="#"><i class="fa fa-file"></i> <span><?= lang("financial") ?> <?= lang("statements") ?></span> <i class="arrow fa fa-chevron-right"></i></a>
			<ul>
				<li><a href="<?=base_url()?>forms/add"><?= lang("new_form") ?></a></li>
				<li><a href="<?=base_url()?>forms/all"><?= lang("list_forms") ?></a></li>
			</ul>
		</li>
				<li class="submenu">
			<a href="#"><i class="fa fa-dashboard"></i> <span><?= lang("standards") ?></span> <i class="arrow fa fa-chevron-right"></i></a>
			<ul>
				<li><a href="#" onclick="loadform('<?=base_url()?>standards/add','Add Standard')"><?= lang("new_standard") ?></a></li>
				<li><a href="<?=base_url()?>standards/all"><?= lang("list_standards") ?></a></li>
			</ul>
		</li>
				<li class="submenu">
			<a href="#"><i class="fa fa-bell"></i><?= lang("alert")." ".lang("management") ?></span> <i class="arrow fa fa-chevron-right"></i></a>
			<ul>
				<li><a href="<?=base_url()?>alert/add"><?=lang("new_alert")?></a></li>
				<li><a href="<?=base_url()?>alert/all"><?=lang("list_alerts")?></a></li>
			</ul>
		</li>
		<li class="submenu">
			<a href="#"><i class="fa fa-bar-chart-o"></i> <span><?= lang("reports") ?>/<?= lang("graphs") ?></span> <i class="arrow fa fa-chevron-right"></i></a>
			<ul>
				<li><a href="<?=base_url()?>reports/jasper"><?= lang("new_report") ?></a></li>
				<li><a href="<?=base_url()?>reports"><?= lang("list_reports") ?></a></li>
				<li><a href="<?=base_url()?>reports/listall"><?=lang('dynamic_reports')?></a></a></li>
			</ul>
		</li>
		<li><a href="<?=base_url()?>extras/"><i class="fa fa-bullhorn" ></i><?=lang('financial_announcements');?></a></li>
<?php
}
?>
	
	<?php if($this->aauth->is_allowed('Approver')){ ?>
							
		<li class="submenu">
			<a href="#"><i class="fa fa-eye"></i><?= lang("pending_tasks") ?></span> <i class="arrow fa fa-chevron-right"></i></a>
			<ul>
				<li><a href="<?=base_url()?>approve"><?= lang("approval_queue") ?></a></li>
			</ul>
		</li>
		<li><a href="<?=base_url()?>extras/institutional_analysis"><i class="fa fa-bars" ></i><?=lang('institutional_analysis');?></a></li>

		<?php } ?>
		<?php if($this->aauth->is_allowed('DataEntry')){ ?>
							
		<li class="submenu">
			<a href="#"><i class="fa fa-file-text"></i><?= lang("financial_data") ?></span> <i class="arrow fa fa-chevron-right"></i></a>
			<ul>
				<li><a href="<?=base_url()?>forms/dataentry"><?= lang("enter_financial_data") ?></a></li>
			</ul>
		</li>
		<?php } ?>

</div>
<div id="content">
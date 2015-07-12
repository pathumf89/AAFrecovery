<div id="content-header">
	<h1><?=lang('new_form')?></h1>
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
	<a class="current" href="#"><?=lang('new_form')?></a>
</div>
<form  novalidate="novalidate" id="form_validate" name="basic_validate" action="#" method="post" class="form-horizontal" data-dpmaxz-eid="1">
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="fa fa-align-justify"></i>									
					</span>
					<h5><?=lang('basic_information')?></h5>

				</div>
				<div class="widget-content nopadding">

					<div class="form-group"><label class="col-sm-3 col-md-3 col-lg-2 control-label"><?=lang('code')?></label>
						<div class="col-sm-9 col-md-9 col-lg-10">
							<input style="text-transform: uppercase" type="text" id="FormCode" name="FormCode" class="form-control input-sm" data-dpmaxz-eid="2" onkeydown="this.value = this.value.replace(/ /g, '-');">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 col-md-3 col-lg-2 control-label"><?=lang('time')?> <?=lang('period')?></label>
						<div class="col-sm-9 col-md-9 col-lg-10">
							<select id="TimePeriod" name="TimePeriod">
							<option value="Y">Yearly</option>
							<option value="M">Monthly</option>
							<option value="W">Weekly</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 col-md-3 col-lg-2 control-label"><?=lang('heading')?></label>
						<div class="col-sm-9 col-md-9 col-lg-10">
							<input type="text" id="Heading" name="Heading" class="form-control input-sm" data-dpmaxz-eid="2">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 col-md-3 col-lg-2 control-label"><?=lang('sub')?> I</label>

						<div class="col-sm-9 col-md-9 col-lg-10">
							<input type="text" id="SubHeading1" name="SubHeading1" class="form-control input-sm" data-dpmaxz-eid="2">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 col-md-3 col-lg-2 control-label"><?=lang('sub')?> II</label>

						<div class="col-sm-9 col-md-9 col-lg-10">
							<input type="text" id="SubHeading2" name="SubHeading2" class="form-control input-sm" data-dpmaxz-eid="2">
						</div>
					</div>
					<div class="form-group"><label class="col-sm-3 col-md-3 col-lg-2 control-label"><?=lang('description')?></label>
						<div class="col-sm-9 col-md-9 col-lg-10">
							<input type="text" id="Description" name="Description" class="form-control input-sm" data-dpmaxz-eid="2">
						</div>
					</div>


				</div>
			</div>			
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon">
						<i class="fa fa-th"></i>
					</span>
					<h5><?=lang('add_form_fields')?></h5>
					<input class="btn btn-dark-red" name="input" type="button" onclick="addRow()" value="<?=lang('add_new_row')?>"/>
				</div>
				<div class="widget-content nopadding">

					<table align="left" class="table table-bordered table-striped table-hover" id="fdcasformdata">
						<thead>
							<tr>
								<th><?=lang('category')?>                                 
									<input id="newCat" type="button" onclick="fnnewCat()" value="+" disabled="disabled"/></th>
								<th><?=lang('sub')?> <?=lang('category')?> 1
									<input id="newSubCat1" type="button" onclick="fnnewSubCat1()" value="+" disabled="disabled"/></th>
								<th><?=lang('sub')?> <?=lang('category')?> 2
									<input id="newSubCat2" type="button" onclick="fnnewSubCat2()" value="+" disabled="disabled"/></th>
								<th><?=lang('sub')?> <?=lang('category')?> 3
									<input id="newSubCat3" type="button" onclick="fnnewSubCat3()" value="+" disabled="disabled"/></th>
								<th><?=lang('sub')?> <?=lang('category')?> 4
									<input id="newSubCat4" type="button" onclick="fnnewSubCat4()" value="+" disabled="disabled"/></th>
								<th><?=lang('sub')?> <?=lang('category')?> 5</th>
								<th><?=lang('description')?></th>
								
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="form-actions" align="center">
		<input type="submit" disabled="disabled" class="btn btn-primary" value="<?=lang('submit')?>" data-dpmaxz-eid="6">
	</div>
	</div>
</form>

<p></p>
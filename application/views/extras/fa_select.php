<div id="content-header">
	<h1><?=lang('financial_announcements')?></h1>
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
	<a class="current" href="#"><?=lang('financial_announcements')?></a>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-content nopadding">
			
			<?php if(@$error){ echo '<div class="alert alert-danger">'.$error.'</div>';} else{ if($upload_data){echo '<div class="alert alert-info"> Financial Announcement has been Successfully Sent.</div>';}}?>

			<?php echo form_open_multipart('extras/do_upload','class="form-horizontal"');?>

			<div class="form-group">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label"><?=lang('financial_announcements')?></label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<input type="file" name="userfile" size="1024" /><div class="label label-info">Max File Size Should be 1MB</div> 
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label">Message</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<textarea  name="msg" class="form-control" rows="5">Internal Circulation Only</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label">Please Select Banks/Institutions</label>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<select multiple name="groups[]">
						<?php foreach($groups as $row){ ?>
						<option value="<?= $row->id; ?>" selected><?= $row->name; ?></option>
						<?php
					}
					?>
					</select>
				</div>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary btn-sm" type="submit" data-dpmaxz-eid="34">Send Announcement</button> or <a href="#" class="text-danger">Cancel</a>
			</div>
			</form>
							
		</div>
	</div>
</div>


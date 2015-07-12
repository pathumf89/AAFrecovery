
<div id="content-header">
	<h1><?=lang('master_data')?></h1>
	<!--<div class="btn-group">
	<a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
	<a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
	<a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
	<a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
	</div>-->
</div>
<div id="breadcrumb">
	<a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
	<a href="#"><?=lang('master_data')?></a>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-content nopadding">
			<?php echo form_open('extras/add_master_data','class="form-horizontal"');?>
			<fieldset>

				<!-- Text input-->
				<?php
				if($this->aauth->is_allowed('Administrator'))
				{
				?>
				<div class="form-group">
					<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="sel-company">Select Institution</label>
					<select id="dynamic_select" >
							<?php foreach($groups as $row){
								?>
								<option value="<?=base_url()?>extras/add_master_data/<?=$row->id?>" <? if($row->id==$id) echo 'selected';?>><?=$row->name?></option>
								
								<?
							}
						
							?>
						</select>
						<button class="btn btn-success" onclick="goLocation()">Load Master Data</button>
				</div>
				<?php	
				}
				?>
				<div class="form-group">
					<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="company">Institution Name</label>
<?php
					if(@$id){
						
						echo '<input name="company" type="text" readonly value="'.$this->aauth->get_group_name($id).'">';
						echo '<input type="hidden" name="company" value="'.$id.'">';
					}?>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="vision">Vision</label>
					<div class="controls">
						<input class="col-sm-9 col-md-9 col-lg-10 controls" id="vision" name="vision" type="text" placeholder="ex. Banker for the Nation" class="input-xlarge" value="<?=@$res->vision?>" required>
							
					</div>
				</div>

				<!-- Textarea -->
				<div class="form-group">
					<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="mission">Mission</label>
					<div class="controls">                     
						<textarea class="col-sm-9 col-md-9 col-lg-10 controls" id="mission" name="mission" ><?=@$res->mission?></textarea>
					</div>
				</div>
				<br/>
				<!-- Textarea -->
				<div class="form-group">
					<label class="control-label" for="profile">Profile</label>
					<div>                     
						<textarea  id="wysiwyg" name="profile"><?=@$res->profile?></textarea>
					</div>
				</div>
				<br/>

				<!-- File Button 
				<div class="control-group">
				<label class="col-sm-3 col-md-3 col-lg-2 control-label" for="branches">Please Upload Branch Network PDF</label>
				<div class="col-sm-9 col-md-9 col-lg-10 controls">
				<input class="form-control input-sm" id="branches" class="input-file" type="file"  name="userfile" size="1024">
				</div>
				</div>
				--> 
				<br/>
				<div class="form-group">
					<div class="controls">
						<input class="btn btn-success" type="submit">
					</div>
				</div>
				<br/>
			</fieldset>
			</form>
			<p></p>
		</div>
	</div>
</div>
<script>
function goLocation()
{
	var sel = document.getElementById("dynamic_select");
	window.location = sel.value;
}
</script>

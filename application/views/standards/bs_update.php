<? if(!@$save){
	
	?>
	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="fa fa-th-list"></i>
			</span>
			<h5><?=$Description?></h5>
		</div>
		<div class="widget-content">
			<form action="<?=base_url()?>standards/update/<?=$Id?>" id="ajaxform">
				<div class="form-group">
					<label class="control-label">Min</label>
						
					<input type="text" name="Min" value="<?=@$Min?>" class="form-control input-sm" data-dpmaxz-eid="2">
						
				</div>
				<div class="form-group">
					<label class="control-label">Max</label>
						
					<input type="text"  value="<?=@$Max?>" name="Max" class="form-control input-sm" data-dpmaxz-eid="2">
						
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" onclick="saveform()" class="btn btn-success">Save Data</button>
	</div>

	<? 
}
if(@$res && @$save){
	?> 
	<div class="alert alert-success">
		<strong>SUCCESS!</strong> The Standard was Successfully Saved.
		
	</div>

	<?
	
}
elseif(!@$res && @$save){
	?>
	<div class="alert alert-danger">
		<strong>ERROR!</strong> Unable to Save the Standard.
	</div>
	<?
} 
?>
<div id="refresh"></div>


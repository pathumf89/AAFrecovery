<div class="widget-content nopadding">
	<form action="<?=base_url()?>user/pm" method="POST" id="ajaxform" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-6 col-md-6 col-lg-6 control-label">Please Select User</label>
			<div class="col-sm-6 col-md-6 col-lg-6">
				<select name="sendto" id='e1'>
					<?
					foreach($users as $user){
						?>
						<option value="<?=$user->id?>"><?=$user->name?></option>
						<?}
					?>		
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-6 col-md-6 col-lg-6 control-label">Please Enter Subject</label>
			<div class="col-sm-6 col-md-6 col-lg-6">
				<input name="subject" type="text" maxlength="20" required></input>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 col-md-3 col-lg-2 control-label">Message</label>
			<div class="col-sm-9 col-md-9 col-lg-10">
				<textarea  name="msg" class="form-control" rows="5" maxlength="500" required></textarea>
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="button" onclick="saveform()" class="btn btn-success">Send</i></button>
</div>
<script>
	$("#e1").select2();
</script>
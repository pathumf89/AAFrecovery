<div class="widget-content nopadding">
<h4>Rejection Success! Please Make sure to inform creater about it </h4>
	<form action="<?=base_url()?>user/pm" method="POST" id="ajaxform" class="form-horizontal">
		<input type="hidden" name="sendto" value="<?=$uid?>"></input>
		<div class="form-group">
			<label class="col-sm-6 col-md-6 col-lg-6 control-label">Subject</label>
			<div class="col-sm-6 col-md-6 col-lg-6">
				<input name="subject" type="text" maxlength="20" value="<?=$msg?>" required></input>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 col-md-3 col-lg-2 control-label">Message</label>
			<div class="col-sm-9 col-md-9 col-lg-10">
				<textarea  name="msg" class="form-control" rows="5" maxlength="500" required><?=$msg?></textarea>
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="button" onclick="saveform()" class="btn btn-danger">Send Reject Message</i></button>
</div>
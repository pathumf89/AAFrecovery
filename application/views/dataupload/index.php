<div class="widget-box" style="margin: 5px;">
	<div class="widget-title">
		<span class="icon">
			<i class="fa fa-th"></i>
		</span>
		<h5>Uploading Data To <?=$FormCode;?></h5>
	</div>
			
	<div class="widget-content nopadding">
		<?=$error?>
		<?php echo form_open_multipart('dataupload/do_upload/'.$FormCode,'id="ajaxform"');?>

		<input type="file" name="userfile" size="2000" />
		<input type="submit" value="Upload TXT" />
		<input type="hidden" name="FormCode" value="<?=$FormCode;?>"/>
		<a href="<?=base_url()?>dataupload/download_template/<?=$FormCode?>" >Click Here to Download TXT Template</a>
		</form>

	</div>
</div>
	<div class="widget-box" style="margin: 5px;">
	<div class="widget-title">
		<span class="icon">
			<i class="fa fa-cogs"></i>
		</span>
		<h5>Standard Addition Process</h5>
	</div>
	<div class="widget-content nopadding">
		<form action="<?=base_url()?>standards/add/" id="ajaxform">				<!--<label class="col-sm-3 col-md-3 col-lg-2 control-label">Select input</label>-->
					
			<?
			if($FormCode==-1){
						
				#$res=$this->form_model->getForm();
				?>
				<select  class="form-control">
					<option selected="selected">--Please Select the Financial Statement--</option>
					<?
					foreach($forms as $row){
				
						//echo .'<br>'.;
						?>
				
						<option onclick="$('#ajaxform').attr('action', '<?=base_url()?>standards/add/<?=$row->FormCode?>');"><?=$row->Heading?></option>
											
						<?
					}
		
					?>
				</select>
				<?} 
			elseif($FormCode!=-1&&$Max==NULL&&$Min==NULL){
				#$res=$this->form_model->getRows($FormCode);
				?>
				<select  class="form-control">
					<option selected="selected">--Please Select the required Field--</option>
					<?
					foreach($rows as $frow){
						?>						
						<option onclick="$('#ajaxform').attr('action', '<?=base_url()?>standards/update/<?=$frow->Id?>');"><?=$frow->MajorGroupId.".".$frow->SubGroupId1.".".$frow->SubGroupId2.".".$frow->SubGroupId3.".".$frow->SubGroupId4.".".$frow->SubGroupId5."-".$frow->Description?></opton>
						<?
					}
					?>
				</select>
				<?
			}
			?>					
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="button" onclick="saveform()" class="btn btn-success">Next <i class="fa fa-arrow-right"></i></button>
</div>
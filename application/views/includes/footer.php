<?php
function script_inject($data=""){
	?>
	<script><?=$data?></script>
	<?php
}
?>
</div>
<div class="row">
	<div id="footer" class="col-xs-12">
		<b><?= lang('copyright'); ?></b><br/><?= lang('languages'); ?> [ <a href="<?= base_url() ?>language/lang/english">English</a> | <a href="<?= base_url() ?>language/lang/sinhala">සිංහල</a> | <a href="<?= base_url() ?>language/lang/tamil">தமிழ்</a> ]
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Browser</h4>
			</div>
			<div class="modal-body">
				<div id="form_body">
        	
				</div>
			</div>
      
		</div>
	</div>
</div>
</div>

<!--
<script src="<?= base_url() ?>ui/js/excanvas.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery-ui.custom.js"></script>
<script src="<?= base_url() ?>ui/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.flot.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.flot.resize.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>ui/js/fullcalendar.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.nicescroll.min.js"></script>
<script src="<?= base_url() ?>ui/js/unicorn.js"></script>
<script src="<?= base_url() ?>ui/js/unicorn.dashboard.js"></script>

<script src="<?= base_url() ?>ui/js/jquery.validate.js"></script>
<script src="<?= base_url() ?>ui/js/unicorn.form_validation.js"></script>
<script src="<?= base_url() ?>ui/js/select2.min.js"></script>
-->

<script src="<?= base_url() ?>ui/js/fdcas-forms.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery-ui.custom.js"></script>
<script src="<?= base_url() ?>ui/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.icheck.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.validate.js"></script>
<script src="<?= base_url() ?>ui/js/jquery.nicescroll.min.js"></script>
<script src="<?= base_url() ?>ui/js/unicorn.jui.js"></script>
<script src="<?= base_url() ?>ui/js/unicorn.js"></script>
<script src="<?= base_url() ?>ui/js/unicorn.form_validation.js"></script>
<script src="<?= base_url() ?>ui/js/unicorn.form_common.js"></script>
<script src="<?= base_url() ?>ui/js/select2.min.js"></script>
<script src="<?= base_url() ?>ui/js/jquery-te-1.4.0.min.js"></script>
<?php script_inject(@$script); ?>
<script type="text/javascript">
	function loadform(url,name="Modal Window")
	{	$("#myModalLabel").text(name);
		$( "#form_body" ).html('Loading Form ... <img src="<?=base_url()?>ui/img/spinner.gif"></img>');
		$( "#form_body" ).load( url );
		$('#myModal').modal('show');
	}
	function saveform(formname=null)
	{
	
		$("#ajaxform").submit(function(e)
			{
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
				$.ajax(
					{
						url : formURL,
						type: "POST",
						data : postData,
						success:function(data, textStatus, jqXHR) 
						{
							//data: return data from server
							$( "#form_body" ).html(data);
						},
						error: function(jqXHR, textStatus, errorThrown) 
						{
							alert('Form Save Failed');
						}
					});
				e.validate();
				e.preventDefault(); //STOP default action
				e.unbind(); //unbind. to stop multiple form submit.
				
			});
 
		$("#ajaxform").submit(); //Submit  the FORM
		
	}

	function deleteForm(id,name)
	{
		var r = confirm("Are You Sure to Delete "+name+" ?");
		if (r == true) {
			window.open('<?=base_url()?>forms/delete/'+id,'_self');
		} else {
			return false;
		}
	}
	function deleteStandard(id,name)
	{
		var r = confirm("Are You Sure to Delete "+name+" ?");
		if (r == true) {
			window.open('<?=base_url()?>standards/delete/'+id,'_self');
		} else {
			return false;
		}
	}
		
	$('#myModal').on('hidden.bs.modal', function () {
			if ($("#refresh").length != 0) {
				location.reload();
			}
			
		})
		
	function pmload()
	{	 	 
		$.ajax(
			{
				url:"<?=base_url()?>user/getpm",
				//timeout:2000,
				//async:true,
				success:function(result)
				{
					$("#menu-messages").html(result);
					setTimeout(function(){pmload();}, 120000);
				}
					
			}
     
		);
	}
	pmload();
	
	function rusure(txt='Are you sure about this action?',mlink='/') {
    var check=confirm(txt);
     if(check)
    {
		window.open(mlink,"_self")
		//document.location(link);
		
	}
	else
	{
		return false;
	}
	}

	
</script>
</body>
</html>

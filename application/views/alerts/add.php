<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed');
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
//$this->aauth->create_perm('Administrator');/
//$this->aauth->create_perm('Manager');
//$this->aauth->create_perm('Approver');
//$this->aauth->create_perm('DataContoller');
?>
<div id="addform">

	<form method="post" name="form1"  id="ajaxform" action="<?= base_url(); ?>alert/add">
		<table align="center">
			<tr valign="baseline">
				<td nowrap align="right">Select Standard</td>
				<td><select name="RowId" id="e2">
						<?php foreach($res as $row){ ?>
							<option value="<?= $row->Id; ?>"><?=$row->FormCode?>|<?= $row->Description?></option>
							<?php
						}
						?>
					</select>
					<input name="DeptId" type="hidden" value="<?= $row->DeptId?>"/>
					
				</td>
			</tr>
                     
			<tr valign="baseline">
				<td align="right" >&nbsp;</td>
				<td><input class="btn btn-inverse" onclick="saveform()" type="button" value="Add Alert" id="submit"></td>
			</tr>
		</table>
	</form>
</div>
<p>&nbsp;</p>
<script>
	$("#e2").select2();
</script>


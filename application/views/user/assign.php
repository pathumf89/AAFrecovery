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

	<form method="post" name="form1"  id="ajaxform" action="<?= base_url(); ?>user/assign">
		<table align="center">
			<tr valign="baseline">
				<td nowrap align="right">Select User Name:</td>
				<td><select name="id" id='e1'>
						<?
						foreach($users as $user){
							?>
							<option value="<?=$user->id?>"><?=$user->name?></option>
							<?}
						?>		
					</select></td>
			</tr>
			<tr valign="baseline">
			<td nowrap align="right">Department:</td>
			<td><select name="department" id="e3">
					<?php foreach($groups as $row){ ?>
						<option value="<?= $row->id; ?>"><?= $row->name; ?></option>
						<?php
					}
					?>
				</select></td>
			<tr>
			<tr valign="baseline">
			<td nowrap align="right">Access Level:</td>
			<td><select name="role[]" id="e2" multiple>
					<?php foreach($priv as $row){ ?>
						<option value="<?= $row->id; ?>"><?= $row->name; ?></option>
						<?php
					}
					?>
				</select></td>
			<tr>
			<tr valign="baseline">
				<td align="right" >&nbsp;</td>
				<td><input class="btn btn-inverse" onclick="saveform()" type="button" value="Assign User" id="submit"></td>
			</tr>
		</table>
	</form>
</div>
<p>&nbsp;</p>
<script>
	$("#e1").select2();
	$("#e2").select2();
	$("#e3").select2();
</script>


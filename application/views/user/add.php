<?php
if (!defined('BASEPATH'))
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

   <form method="post" name="form1"  id="ajaxform" action="<?= base_url(); ?>user/add">
        <table align="center">
            	<tr valign="baseline">
                <td nowrap align="right">Full Name:</td>
                <td><input name="username" type="text" id="username" value="<?php echo set_value('username'); ?>" size="32">
<?= form_error('username', '<span class="label label-important">', '</span>') ?></td>
            </tr>
            <!--
            <tr valign="baseline">
                <td nowrap align="right">Full Name:</td>
                <td><input name="fullname" type="text" id="fullname" value="<?php echo set_value('fullname'); ?>" size="32">
<?= form_error('fullname', '<span class="label label-important">', '</span>') ?></td>
            </tr>
            -->
            <tr valign="baseline">
                <td nowrap align="right">Email:</td>
                <td><input name="email" type="text" id="email" value="<?php echo set_value('email'); ?>" size="32">
<?= form_error('email', '<span class="label label-important">', '</span>') ?></td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right">Password:</td>
                <td><input name="password" type="password" id="password" value="<?php echo set_value('password'); ?>" size="32">
<?= form_error('password', '<span class="label label-important">', '</span>') ?></td>
            </tr>
          
            <tr valign="baseline">
                <td align="right" >&nbsp;</td>
                <td><input class="btn btn-inverse" onclick="saveform()" type="button" value="Add User" id="submit"></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="">
    </form>
</div>
<p>&nbsp;</p>


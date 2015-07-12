<div id="content-header">
    <h1><?=lang('list_reports')?></h1>
    <!--<div class="btn-group">
            <a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
            <a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
            <a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
            <a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
    </div>-->
</div>
<div id="breadcrumb">
    <a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
    <a href="#"><?=lang('reports')?></a>
    <a class="current" href="#"><?=lang('list_reports')?></a>
</div>
<div class="widget-box" style="margin: 5px;">
							<div class="widget-title">
								<span class="icon">
									<i class="fa fa-th"></i>
								</span>
								<h5>Avaliable Reports</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Report Name</th>
											<th>Institution</th>
											<th>TimePeriod</th>
											<th>Report Actions</th>
										</tr>
									</thead>
									<tbody>
									<?php
									//var_dump($res);
										foreach ($res as $row) {
											//$this->load->model('form_model');
											//$l1=count($this->form_model->getRows($row->FormCode));
											//$l2=$this->form_model->getRowCount($row->FormCode);
											?>
										
										
										<tr>
											<td><?=$row->FormCode;?> - <?=$row->Heading;?></td>
											<td><?=$row->Institution?></td>
											<td><?=$row->TimePeriod?></td>
											<td><a class="btn btn-success btn-sm" href="<?=base_url()?>reports/view/<?=$row->FormCode?>/<?=$row->id?>">Open</a></td>

										</tr>
										<?php } ?>
									</tbody>
								</table>							
							</div>
						</div>

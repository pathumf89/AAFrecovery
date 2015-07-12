
<div id="content-header">
    <h1><?=lang('view_reports')?></h1>
    <!--<div class="btn-group">
            <a title="Manage Files" class="btn"><i class="fa fa-file"></i></a>
            <a title="Manage Users" class="btn"><i class="fa fa-user"></i></a>
            <a title="Manage Comments" class="btn"><i class="fa fa-comment"></i><span class="label label-danger">5</span></a>
            <a title="Manage Orders" class="btn"><i class="fa fa-shopping-cart"></i></a>
    </div>-->
</div>
<div id="breadcrumb">
    <a class="tip-bottom" title="" href="<?= base_url() ?>dashboard" data-original-title="Go to Home"><i class="fa fa-home"></i><?=lang('dashboard')?></a>
    <a href="#"><?=lang('forms')?></a>
    <a class="current" href="#"><?=lang('view_reports')?></a>
</div>
<?
foreach($ds as $drow){
	

	?>
	<div class="widget-box">
	<div class="widget-title">
		<span class="icon">
			<i class="fa fa-th-list"></i>
		</span>
		<h5>Report</h5>
		<div class="buttons">
			<a href="#" class="btn" title="Icon Title"><i class="fa fa-shopping-cart"></i> <span class="text">Pay Now</span></a>
			<a href="#" class="btn" title="Icon Title"><i class="fa fa-print"></i> <span class="text">Print</span></a>
		</div>
	</div>

	<div class="widget-content">
		<div class="invoice-content">
			<div class="invoice-head">
				<div class="invoice-meta">
					Report <span class="invoice-number"><?=$drow->FormCode?></span><span class="invoice-date">Date: 2014-12-01</span>
				</div>
				<h5><?=$drow->Heading?></h5>

				<div>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>
									Field
								</th>
								<th>
									Description
								</th>
								<th>
									Value
								</th>
							</tr>
						</thead>
						<!--<tfoot>
						<tr>
						<th colspan="2" class="total-label">
						Total:
						</th>
						<th class="total-amount">
						$920.00
						</th>
						</tr>
						</tfoot>-->
						<tbody>
							<? foreach($res as $row){
		
								?>
								<tr>
								<td>
									<?=$row->MajorGroupId.'.'.$row->SubGroupId1.'.'.$row->SubGroupId2.'.'.$row->SubGroupId3.'.'.$row->SubGroupId4.'.'.$row->SubGroupId5;?>
								</td>
								<td>
									<?=$row->Description?>
								</td>
								<td>
									<?=$row->value?>
								</td>
								<?} ?>
						</tbody>
					</table>		
				</div>
					
			</div>
		</div>
	</div>
	</div>
	<?
	
}
?>
<script type="text/javascript">
$("a[href=0]").click(function() {
 alert('adsasd');
 return false;
});
</script>
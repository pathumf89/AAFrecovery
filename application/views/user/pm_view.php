<a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="fa fa-envelope"></i> <span class="text"><?=lang('messages')?></span> <span class="label label-danger" ><?=count($pms)?></span> <b class="caret"></b></a>
<ul class="dropdown-menu messages-menu">
	<li class="title"><i class="fa fa-envelope-alt"></i><?=lang('messages')?><a class="title-btn" href="#" onclick="loadform('<?=base_url()?>user/pm','Compose Message')" title="Write new message"><i class="fa fa-edit"></i></a></li>
	<? foreach($pms as $pm ){
		?>
		<li class="message-item">
			<a href="#">
				<img src="<?=base_url()?>ui/img/User.png" alt="User Icon">
				
				<div class="message-content">
					<span class="message-time">
						<?
						$this->load->library('Hansi');
						$d=$pm->date;
						echo(humantime($pm->date)).' a go';
						//print_r($pm->date);
						?>
					</span>
					<span class="message-sender">
						<?
						echo $this->aauth->get_user($pm->sender_id)->name;
						?>
					</span>
					<span class="message">
						<?=$pm->title?>
						<? if(!$pm->read){ ?>
							<i class="fa fa-star">new</i>
							<?} ?>					
					</span>
					<span class="message">
						<button class="btn btn-xs btn-primary" onclick="loadform('<?=base_url()?>user/viewpm/<?=$pm->id?>','View Message')">Open</button>
						<button class="btn btn-xs btn-danger" onclick="loadform('<?=base_url()?>user/viewpm/<?=$pm->id?>/1','Delete Message')">Delete</button>
			
					</span>
				</div>
			</a>
		</li>
		<?}
	function humantime($time){
		$time = strtotime($time);
		$time = time() - $time; // to get the time since that moment

		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach($tokens as $unit => $text){
			if($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}


	}
	?>
		
</ul>


<script type="text/javascript">
jQuery(function() {
	$(".nc_city_numlist").find("li").hover(function() {
		$(this).addClass("cerrent_hover");
	}, function() {
		$(this).removeClass("cerrent_hover");
	});

	$('.first').click(function(){
		var first = $(this).attr('nc_first');
		$(".citylist li").each(function(){
			if($(this).attr('first')==first){
				$(this).show();
			}else{
				$(this).hide();
			}
		});
	});

	$('.letter_all').click(function(){
		$(".citylist li").show();
	});
});
</script>

<div class="nc_city_search">
	<div class="nc_city_nav">
		<div class="nc_city_wrap">
			<div class="clearfix" id="nc_city_hot">
				<dl>
					<dt><?php echo $lang['nc_hotcity'];?>:</dt>
					<?php if(!empty($output['list'])){?>
					<?php foreach($output['list'] as $h){?>
					<?php if($h['hot_city']==1){?>
					<dd><a href="<?php echo BASE_SITE_URL;?>/index.php?act=city&op=select_city&area_id=<?php echo $h['area_id'];?>"><?php echo $h['area_name'];?></a></dd>
					<?php }?>
					<?php }?>
					<?php }?>			
				</dl>
			</div>
		</div>
	</div>
	<div class="nc_city_cont">
		<div class="nc_tit clearfix">
			<span class="nc_tit_label">按拼音首字母选择：</span>
			<ul id="nc_city_list">
				<li><a href="javascript:void(0)" class='letter_all'>全部</a></li>
				<?php if(!empty($output['letter'])){?>
				<?php foreach($output['letter'] as $lv){?>
				<li><a href="javascript:void(0)" class='first' nc_first="<?php echo $lv;?>"><?php echo $lv;?></a></li>
				<?php }?>
				<?php }?>
			</ul>
			<span class="trangle"></span>
		</div>

		<div id="nc_city_A" class="nc_city_numlist">
			<ul class='citylist'>
			<?php if(!empty($output['letter'])){?>
			<?php foreach($output['letter'] as $v){?>
					<li class="clearfix" first="<?php echo $v;?>">
						<span class="lable"><strong><?php echo $v;?></strong></span>
						<span>
							<?php if(!empty($output['list'])){?>
							<?php foreach($output['list'] as $l){?>
							<?php if($v==$l['first_letter']){?>
							<a href="<?php echo BASE_SITE_URL;?>/index.php?act=city&op=select_city&area_id=<?php echo $l['area_id'];?>"><?php echo $l['area_name'];?></a>
							<?php }?>
							<?php }?>
							<?php }?>
						</span>
					</li>
			<?php }?>
			<?php }?>
			</ul>
		</div>
	</div>
</div>
<?php defined('InShopNC') or exit('Access Invalid!'); ?>
<div class="mainbox setup_box setup-com">
<div class="hd"><h3>我的收藏</h3></div>
<div class="con">
<div class="form_table">
<div class="search-form">
<select name="s_type">
<option value="store" <?php if($_GET['s_type'] == 'store'){ ?>selected<?php } ?>>收藏的店铺</option>
<option value="comment" <?php if($_GET['s_type'] == 'comment'){ ?>selected<?php } ?>>收藏的评价</option>
</select>
</div>
<table class="ui_table ui_table_inbox" width='100%'>
	<thead>
		<?php if(trim($_GET['s_type'])=='comment'){ ?>
		<tr>
			<th style="width:10%">评论会员</th>
			<th>店铺名称</th>
			<th style="width:40%">点评信息</th>
			<th style="width:15%">停车情况</th>
			<th style="width:10%">人均消费</th>
			<th style="width:10%">评论时间</th>
			<th>操作</th>
		</tr>
		<?php }else{ ?>
		<tr>
			<th>店铺名称</th>
			<th>LOGO</th>
			<th>所属分类</th>
			<th>人均消费</th>
			<th>评论数</th>
			<th>所在城市</th>
			<th>操作</th>
		</tr>
		<?php } ?>
	</thead>
	<tbody>
		<?php if(!empty($output['list'])){?>
		<?php foreach($output['list'] as $val){?>
		<?php if(trim($_GET['s_type'])=='comment'){ ?>
		<tr>
			<td><?php echo $val['member_name']; ?></td>
			<td><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
			<td><?php echo $val['comment']; ?></td>
			<td><?php echo $val['parking']; ?></td>
			<td><span class="font1"><?php echo $val['person_cost']; ?></span>元</td>
			<td><?php echo date('Y-m-d H:i:s',$val['add_time']); ?></td>
			<td><a href="javascript:if(confirm('您确定要取消收藏该点评吗？'))window.location.href='index.php?act=memberaccount&op=fav_del&fav_id=<?php echo $val['fav_id']; ?>';">取消收藏</a></td>
		</tr>
		<?php }else{ ?>
		<tr>
			<td><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><?php echo $val['store_name'];?></a></td>
			<td><a href="index.php?act=store&op=detail&id=<?php echo $val['store_id']; ?>" target="_blank"><img src="<?php echo ($val['logo']!='' && $val['logo']!='上传失败')?UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$val['logo']:TEMPLATE_SITE_URL.'/images/shopnopic.png';?>" width="150" /></a></td>
			<td><?php echo $val['class_name']; ?></td>
			<td><span class="font1"><?php echo $val['person_consume']; ?></span>元</td>
			<td><?php echo $val['comment_count']; ?></td>
			<td><?php echo $val['city_name']; ?></td>
			<td><a href="javascript:if(confirm('您确定要取消收藏该店铺吗？'))window.location.href='index.php?act=memberaccount&op=fav_del&fav_id=<?php echo $val['fav_id']; ?>';">取消收藏</a></td>
		</tr>
		<?php } ?>
		<?php }?>
		<?php }else{?>
		<tr>
			<td colspan='20' height="100" style="text-align:center; vertical-align:central;">暂无相关记录</td>
		</tr>
		<?php }?>
	</tbody>
</table>
<div class="page_box"> <?php echo $output['show_page'];?></div>
</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	$('select[name="s_type"]').change(function(){
		var s_type = $(this).val();
		window.location.href = 'index.php?act=memberaccount&op=fav_list&s_type='+s_type;
	});
})
</script>
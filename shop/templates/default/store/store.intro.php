<div class="shop_intro_top">
  <div class="shop_info_box">
    <div class="shop_info_pic"><img alt="<?php echo $output['storeinfo']['store_name'];?>" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$output['storeinfo']['logo'];?>"></div>
    <div class="shop_intro">
      <h2><?php echo $output['storeinfo']['store_name'];?></h2>
      <div class="shop_taste">
		<span>人均:<strong class="stress color4"><?php echo $output['storeinfo']['person_consume'];?></strong></span>
	  </div>
    </div>
  </div>
  <div class="sibg"></div>
</div>
<div class="shop_intro_con clearfix">
  <div class="shop_intro_conl">
    <div class="shop_intro_list">
      <div class="shop_intro_hd">
        <h3 class="mr20"> <strong><?php echo $lang['nc_store_detail_store'];?></strong><?php echo $lang['nc_store_intro_basic document'];?></h3>
      </div>
      <div class="shop_location">
        <ul>
          <li><em><?php echo $lang['nc_store_detail_store'];?>：</em><span><?php echo $output['storeinfo']['store_name'];?></span></li>
          <li><em><?php echo $lang['nc_store_detail_address'];?>：</em><span><?php echo $output['storeinfo']['address'];?></span></li>
          <li><em><?php echo $lang['nc_store_intro_tel'];?>：</em><span class="call"><?php echo $output['storeinfo']['telephone'];?></span></li>
		  <li><em><?php echo $lang['nc_store_intro_side'];?>：</em><span class="call"><?php echo $output['storeinfo']['side'];?></span></li>
		  <li><em><?php echo $lang['nc_store_intro_business hour'];?>：</em><span class="call"><?php echo $output['storeinfo']['business_hour'];?></span></li>
		</ul>
      </div>
      <div class="shop_desc_list">
        <ul>
          <li>
			<em class="tit"><?php echo $lang['nc_store_detail_tab'];?>：</em>
			<?php if(!empty($output['storeinfo']['label'])){?>
			<?php $output['storeinfo']['label'] = unserialize($output['storeinfo']['label']);?>
			<?php foreach($output['storeinfo']['label'] as $label){?>
			<span class="shop_tag"><a href="javascript:void(0);"><?php echo $label['label_name'];?></a><em class="col_em">(<?php echo $label['label_num'];?>)</em></span>
			<?php }?>
			<?php }?>
		  </li>
        </ul>
      </div>
      <div class="shop_intro_hd">
        <h3 class="mr20"> <strong><?php echo $lang['nc_store_detail_store'];?></strong><?php echo $lang['nc_store_intro_introduce'];?></h3>
      </div>
      <div class="shop_info">
		<?php echo $output['storeinfo']['description'];?>
      </div>
      <div> </div>
    </div>
    <div class="shop_tabs">
      <div class="shop_tabs_hd">
        <ul>
          <li class="selected" nc_type='store_pic'><a href="javascript:void(0);"><?php echo $lang['nc_store_intro_shop picture'];?></a></li>
        </ul>
      </div>
	 
	 <!--商铺图片-->
     <div class="shop_pic_list" nc_type='store_pic'>
		<?php if(!empty($output['goodslist'])){?>
		<?php foreach($output['goodslist'] as $goods){?>
		<div class="shop_pic_box mr10">
			<img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_GOODS_PATH.DS.$goods['goods_pic'];?>">
			<p class="shop_pic_tit"><?php echo $goods['goods_name']?></p>
		</div>
		<?php }?>
		<?php }?>       
     </div>      
    </div>
  </div>
  <div class="shop_intro_conr">
    <div class="shop_map_wrap mb10">
      <div class="shop_intro_hd mb10" >
        <h3 class="mr20"> <strong><?php echo $lang['nc_store_detail_store'];?></strong><?php echo $lang['nc_store_intro_map'];?></h3>
      </div>
      <div class="shop_map" id="container" style=" width:278px;height:300px; margin: 0 auto;"></div>
      <div class="shop_route">
        <ul>
          <li><em class="tit"><?php echo $lang['nc_store_intro_the bus route'];?>：</em><span><?php echo $output['storeinfo']['bus'];?></span></li>
          <li><em class="tit"><?php echo $lang['nc_store_intro_subway line'];?>：</em><span><?php echo $output['storeinfo']['subway'];?></span></li>
        </ul>
      </div>
    </div>
    <div class="shopnear mb10">
      <div class="shop_intro_hd mb10">
        <h3 class="mr20"> <strong><?php echo $lang['nc_store_intro_nearby'];?></strong><?php echo $lang['nc_store_detail_store'];?></h3>
      </div>
      <div class="shopnear_bd">
	    <?php if(!empty($output['sidestore'])){?>
		<?php foreach($output['sidestore'] as $s){?>
        <dl>
          <dt> <a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=info&id=<?php echo $s['store_id'];?>" title="<?php echo $s['store_name'];?>"> <img class="fl mr10" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE_PATH.DS.$s['pic'];?>"></a> </dt>
          <dd class="fl">
            <h4> <a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=info&id=<?php echo $s['store_id'];?>" title="<?php echo $s['store_name'];?>"><?php echo $s['store_name'];?></a> </h4>
            <p class="mb10 color6"><?php echo $lang['nc_store_detail_address'];?>:<?php echo $s['address'];?></p>
            <p> <a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $s['store_id'];?>" class="btn"><?php echo $lang['nc_store_detail_want to look'];?></a> <a href="<?php echo BASE_SITE_URL;?>/index.php?act=store&op=detail&id=<?php echo $s['store_id'];?>#share" class="i_say"><?php echo $lang['nc_store_detail_i want to say'];?></a> </p>
          </dd>
        </dl>
		<?php }?>
		<?php }?>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
	$(function(){
		$('.shop_tabs_hd ul li').click(function(){
			$('.shop_tabs_hd ul li').removeClass('selected');
			$(this).addClass('selected');
			var nc = $(this).attr('nc_type');
			$('div[nc_type=store_pic]').hide();
			$('div[nc_type=store_env]').hide();
			$('div[nc_type=price_table]').hide();
			$('div[nc_type='+nc+']').show();
		});
	});
</script>
<script type="text/javascript">
var cityName = '<?php echo $output['cityname']?>';
var address = '<?php echo $output['storeinfo']['address']?>';
var store_name = '<?php echo $output['storeinfo']['store_name']?>';  
var map = "";
var localCity = "";
var opts = {width : 150,height: 50,title : "<?php echo $lang['nc_store_intro_shop name'];?>:"+store_name}
function initialize() {
	map = new BMap.Map("container");
	localCity = new BMap.LocalCity();
	
	map.enableScrollWheelZoom(); 
	map.addControl(new BMap.NavigationControl());  
	map.addControl(new BMap.ScaleControl());  
	map.addControl(new BMap.OverviewMapControl()); 
	localCity.get(function(cityResult){
	  if (cityResult) {
	  	var level = cityResult.level;
	  	if (level < 13) level = 13;
	    map.centerAndZoom(cityResult.center, level);
	    cityResultName = cityResult.name;
	    if (cityResultName.indexOf(cityName) >= 0) cityName = cityResult.name;
	    	    	getPoint();
	    	  }
	});
}
 
function loadScript() {
	var script = document.createElement("script");
	script.src = "http://api.map.baidu.com/api?v=1.2&callback=initialize";
	document.body.appendChild(script);
}
function getPoint(){
	var myGeo = new BMap.Geocoder();
	myGeo.getPoint(address, function(point){
	  if (point) {
	    setPoint(point);
	  }
	}, cityName);
}
function setPoint(point){
	  if (point) {
	    map.centerAndZoom(point, 16);
	    var marker = new BMap.Marker(point);
	    var infoWindow = new BMap.InfoWindow("<?php echo $lang['nc_store_intro_detailed address'];?>:"+address, opts);  
			marker.addEventListener("click", function(){          
			   this.openInfoWindow(infoWindow);  
			});
	    map.addOverlay(marker);
			marker.openInfoWindow(infoWindow);
	  }
}
loadScript();
</script> 


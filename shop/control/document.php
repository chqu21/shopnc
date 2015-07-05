<?php

/////////////////////////////////////////////////////////////////////////////
//
// 这个文件是 网城创想电商门户系统 项目的一部分
//
// Copyright (c) 2007 - 2013 www.shopnc.net
//
// 要查看完整的版权信息和许可信息，请查看源代码中附带的 COPYRIGHT 文件
// 或者访问 http://www.shopnc.net/ 获得详细信息
//
/////////////////////////////////////////////////////////////////////////////


defined('InShopNC') or exit('Access Invalid!');

class documentControl extends BaseHomeControl {
	public function indexOp(){
		$lang	= Language::getLangContent();
		if($_GET['code'] == ''){
			showMessage($lang['para_error'],'','html','error');
		}
		$model_doc	= Model('document');
		$doc	= $model_doc->getOneByCode($_GET['code']);
		Tpl::output('doc',$doc);
		
		$nav_link = array(
			array(
				'title'=>'首页',
				'link'=>'index.php'
			),
			array(
				'title'=>$doc['doc_title']
			)
		);
		Tpl::output('nav_link_list',$nav_link);
		Tpl::showpage('document.index');
	}
}
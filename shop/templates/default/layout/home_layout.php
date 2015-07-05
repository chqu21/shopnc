<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php 
$top_file = ($_GET['act']=='index' && $_GET['op']=='index')?'new_top.php':'top.php';
require BASE_TPL_PATH.'/layout/'.$top_file;
?>
<?php require_once($tpl_file);?>
<?php require BASE_TPL_PATH.'/layout/footer.php';?>

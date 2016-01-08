<?php
require_once('config.php');
require_once(ykfile('source/search_service.php'));

$keyword = $_GET['keyword'];
if(!empty($keyword)) {

	//注意文件的编码格式需要保存为为UTF-8格式
	require ( "sphinxapi.php" );

	$cl = new SphinxClient ();
	$cl->SetServer ( '127.0.0.1', 9312);
	//以下设置用于返回数组形式的结果
	$cl->SetArrayResult ( true );


	$keyword = $_GET['keyword'];
	//在做索引时，没有进行 sql_attr_类型 设置的字段，可以作为“搜索字符串”，进行全文搜索
	$res = $cl->Query("$keyword", "activity" );    //"*"表示在所有索引里面同时搜索，"索引名称（例如test或者test,test2）"则表示搜索指定的
	$seasrv = new SearchService();
	foreach($res['matches'] as $result) {
 		$id[] = $result['id'];
	}
	$activity_list = $seasrv->get_act_by_ids($id);
}

$page_title="搜索";

include(ykfile('pages/search.php'));
?>

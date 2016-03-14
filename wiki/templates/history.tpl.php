<?php 
$table = array();
if (!empty($hist)){
		$table[] = array(__("Date"), __("Page"), __("User"));
		foreach($hist as $wh) {
			$table[]=array(
				formatDateTime($wh["dt_created"]),
				Html::a(WEBROOT."/wiki/viewhistoryversion/".$wiki->name."/".$page->name."/".$wh['id'],"<b>".$page->name."</b>"),
				$w->Auth->getUser($wh['creator_id'])->getFullName()
			);
		}
		echo Html::table($table,"history","tablesorter",true);
} else {
		echo __("No changes yet.");
}
?>

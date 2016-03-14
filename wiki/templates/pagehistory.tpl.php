<?php 
	
$table = array();
if ($hist){
		$table[]=array(__("Date"), __("User"), __("Action"));
	
		foreach($hist as $ph) {
			$table[]=array(
				formatDateTime($ph->dt_created),
				$w->Auth->getUser($ph->creator_id)->getFullName(),
				Html::a(WEBROOT."/wiki/viewhistoryversion/".$wiki->name."/".$page->name."/".$ph->id,__("View"),true),
			);
		}
		echo Html::table($table,"history","tablesorter",true);
} else {
		echo __("No changes yet.");
}
?>

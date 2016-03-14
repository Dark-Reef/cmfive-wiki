<?php
$wikiCount=0;
if (!empty($wikis)) {
	$table[]=array(
		__("Wiki Title"),
		__("Type"),
		__("Date Created"),
		__("Last Modified Date"),
		__("Modified By"),
		__("Last Page Modified"),
	"");
	foreach($wikis as $wi) {
		if ($wi->canView($w->Auth->user())) {
			$wikiCount++;
			$lastModifiedPage="";
			$lastModifiedPageUser="";
			$lastModifiedDate="";
			if ($wi->last_modified_page_id > 0) {
				$p = $wi->getPageById($wi->last_modified_page_id);
				if (!empty($p)) {
					$wuser = $w->Auth->getUser($p->modifier_id);
					$lastModifiedPageUser=empty($wuser) ? '' : $w->Auth->getUser($p->modifier_id)->getFullName();
					$lastModifiedPage=$p->name;
					$lastModifiedDate=$p->dt_modified;
				}
			}
			$delLink="";
			if ($wi->canDelete($w->Auth->user())) {
				$delLink=Html::ab(WEBROOT."/wiki/delwiki/".$wi->id,__('Delete'),'deletebutton','',__('Do you really want to delete this wiki and all of its pages?'));
			}
			$table[] = array(
				Html::a(WEBROOT."/wiki/view/".urlencode($wi->name)."/HomePage","<b>".$wi->title."</b>"),
				$wi->type,
				formatDateTime(0 + $wi->dt_created), 
				formatDateTime(0 + $lastModifiedDate), 
				$lastModifiedPageUser,
				Html::a(WEBROOT."/wiki/view/".$wi->name."/".$lastModifiedPage,$lastModifiedPage),$delLink
			);
		}
	}
	echo Html::table($table,"wikilist","tablesorter",true);
}
if ($wikiCount==0)  {
	echo __("There are no wikis yet.")."<br>";
	echo Html::ab(WEBROOT."/wiki/createwiki/",__('Create a wiki'));
}

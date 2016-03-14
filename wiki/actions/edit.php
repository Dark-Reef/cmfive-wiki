<?php
/*********************************************
 * Save POST updates to body field into WikiPage
 *********************************************/
function edit_POST(Web &$w) {
	try {
		$pm = $w->pathMatch("wikiname","pagename");
		$wiki = $w->Wiki->getWikiByName($pm['wikiname']);
		if (!$wiki) {
			$w->error(__("Wiki does not exist."));
		}
		$wp = $wiki->getPage($pm['pagename']);
		if (!$wp) {
			$w->error(__("Page does not exist."));
		}
		$wp->body=$w->request("body");
		$wp->update();
		$w->msg(__("Page updated."),"/wiki/view/".$pm['wikiname']."/".$pm['pagename']);
	} catch (WikiException $ex) {
		$w->error($ex->getMessage(),"/wiki");
	}
}

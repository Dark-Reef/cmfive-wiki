<?php

function view_GET(Web &$w) {
    try {
		$pm = $w->pathMatch("wikiname", "pagename");
		
		// Check for missing parameter
		if (empty($pm["wikiname"])) {
			$w->error(__("Wiki does not exist."), "/wiki");
		}
		
		// Get wiki object and check for existance
		$wiki = $w->Wiki->getWikiByName($pm['wikiname']);
		
		if (empty($wiki->id)) {
			$w->error(__("Wiki does not exist."));
		}

		// If page doesn't exist, make one
		if (strlen(trim($pm['pagename']))=='') {
			$pm['pagename']="HomePage";
		}
		$wp = $wiki->getPage($pm['pagename']);
		    // Register for timelog
		$w->Timelog->registerTrackingObject($wp);
		
		if (!$wp) {
			$wp = $wiki->addPage($pm['pagename'], __("New Page."));
		}
		
		// Reset wiki breadcrumbs
		if ($pm['pagename'] == "HomePage") {
			$_SESSION['wikicrumbs'][$pm['wikiname']] = array();
		} else {
			$_SESSION['wikicrumbs'][$pm['wikiname']][$pm['pagename']] = 1;
		}

		// Set navigation
		$w->Wiki->navigation($w, $wiki, $pm["pagename"]);
		
		// Set edt wiki form
		$editForm = array(
			"" => array(
				array(array("", "textarea", "body", $wp->body, 60, 24, false))
			)
		);
		
		// Set template vars
		if ($w->type=="richtext") {
			$w->ctx("body",$wp->body);
			
		} else  {  // richtext etc
			$w->ctx("body", WikiLib::wiki_format_cebe($wiki, $wp));
		}
		$w->ctx("wiki", $wiki);
		$w->ctx("page", $wp);
		$w->ctx("wiki_hist", $wiki->getHistory());
		$w->ctx("page_hist", $wp->getHistory());
		$w->ctx("wiki_users", $wiki->getUsers());
		$w->ctx("attachments", $w->service("File")->getAttachments($wp));
		$w->ctx("title", $wiki->title . " - " . $wp->name);
		
		
		// render form without form tag or buttons (which have been moved into the template) by using the false value for the last parameter
		$w->ctx("editForm", Html::multiColForm($editForm, "/wiki/edit/{$wiki->name}/{$wp->name}", "POST", __("Save"), null, null, Html::box("/wiki/markup",__("Markup Help"),true),"_self",false));
		
		
	} catch (Exception $e) {
		$w->error($e->getMessage(),"/wiki");
	}
}

<?php
	$lines[] = array(__("Wiki Member"),"section");
	$lines[] = array(__("User"),"autocomplete","user_id",$mem->user_id,$w->Auth->getUsersForRole("wiki_user"));
	$lines[] = array(__("Role"),"select","role",$mem->role,array("reader","editor"));

	echo Html::form($lines,$w->localUrl("/wiki/editmember/".$wiki->id."/".$mem->id),"POST",__("Save"));

<?php
$lines = array(
    __("Create Wiki") => array(
        array(array(__("Title"),"text","title","")),
        array(array(__("Public"),"checkbox","is_public",0)),
         array(array(__("Type"),"select","type",'markdown',[[__('Rich Text'),'richtext'],[__('Markdown'),'markdown']]))
    )
);

echo Html::multiColForm($lines,$w->localUrl("/wiki/createwiki"),"POST",__("Create"));

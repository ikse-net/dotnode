<div class="page">
<?php

/* NOTE: This is a really cheap way to do it. I think it may be more intelligent to write the two
	 pages to temporary files and run /usr/bin/diff over them. Then again, maybe not.           */

// load pages
$pageA = $this->LoadPageById($_REQUEST["a"]);
$pageB = $this->LoadPageById($_REQUEST["b"]);

// prepare bodies
$bodyA = explode("\n", $pageA["body"]);
$bodyB = explode("\n", $pageB["body"]);

$added = array_diff($bodyA, $bodyB);
$deleted = array_diff($bodyB, $bodyA);

$output .= "<b>Comparing <a href=\"".$this->href("", "", "time=".urlencode($pageA["time"]))."\">".$pageA["time"]."</a> to <a href=\"".$this->href("", "", "time=".urlencode($pageB["time"]))."\">".$pageB["time"]."</a></b><br />\n";

if ($added)
{
	// remove blank lines
	$output .= "<br />\n<b>Additions:</b><br />\n";
	$output .= "<div class=\"additions\">".$this->Format(implode("\n", $added))."</div>";
}

if ($deleted)
{
	$output .= "<br />\n<b>Deletions:</b><br />\n";
	$output .= "<div class=\"deletions\">".$this->Format(implode("\n", $deleted))."</div>";
}

if (!$added && !$deleted)
{
	$output .= "<br />\nNo differences.";
}
print($output);
?>
</div>

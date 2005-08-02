#!/usr/bin/php
<?

include('../includes/removeaccents.inc.php');

function label2name($label)
{
        $name = strtolower(removeaccents($label));
	$name = preg_replace("/[^a-z0-9\.]/","-", $name);
	$name = preg_replace("/^[\-|\.]*/","", $name);
	$name = preg_replace("/[\-|\.]*$/","", $name);
        $name = stripslashes($name);
        $name = preg_replace("/[\-]{2,}/", "-", $name);
        return trim($name);
}

echo label2name($argv[1]);

print_r($GLOBALS);

?>

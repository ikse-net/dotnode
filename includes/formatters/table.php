<?php

if (!function_exists("make_tr"))
{
function make_tr($text)
{
	global $_site;
	$rval = "";
	$lines = split("\|\|", $text);
	$first=true;
	foreach ($lines as $line)
	{
		if($line!="\n" && $line!="")
		{
			if($first)
        	                $type='th';
	                else
                	        $type='td';
			$rval.= "\t<tr>\n".make_cel($line, $type)."\t</tr>\n";
			$first=false;
		}
		
	}
	return $rval;
}
}
if (!function_exists("make_cel"))
{
function make_cel($text, $type='td')
{
	global $_site;

	$rval = "";
        $cels = split("\|", $text);


        foreach ($cels as $cel)
        {
		if($cel!="\n" && $cel!="")
		{
			$align=0;

			if(ereg("^\s+", $cel))
				$align=10;
			if(ereg("\s+$", $cel))
				$align++;

			switch ($align)
			{
			case 10:
				$align_str="align='right'";
				break;
			case 11:
				$align_str="align='center'";
                                break;
			default:
				$align_str="";
			}

                	$rval.= "\t\t<$type $align_str>".Wikise($cel, "wakka")."</$type>\n";
		}
        }
	return $rval;
}
}
print "\n<table class='wiki'>\n".make_tr($text)."</table>\n";

?>

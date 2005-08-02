<?php

$Wiki=0;
class Wikini
{
	function IncludeBuffered($filename, $notfoundText = "", $vars = "", $path = "")
	{
		if ($path) $dirs = explode(":", $path);
		else $dirs = array("");

		foreach($dirs as $dir)
		{
			if ($dir) $dir .= "/";
			$fullfilename = $dir.$filename;
			if (file_exists($fullfilename))
			{
				if (is_array($vars)) extract($vars);

				ob_start();
				include($fullfilename);
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
			}
		}
		if ($notfoundText) return $notfoundText;
		else return false;
	}


	function Wikise($text, $formatter = "wakka")
	{
		global $token;
		$token = array();
		return $this->IncludeBuffered(INCLUDESPATH."/formatters/".$formatter.".php", "<i>Impossible de trouver le formateur \"$formatter\"</i>", compact("text"));
	} 

	function WikiLink($tag, $method = "", $text = "", $track = 1)
	{
		$tag=htmlspecialchars($tag);//avoid xss
		$text=htmlspecialchars($text);//paranoiac again
		if (!$text)
		{
			if(strlen($tag)>29)
				$text = substr($tag, 0, 32).'[...]';
			else
				$text = $tag;
		}

	// is this a full link? ie, does it contain alpha-numeric characters?
		if (preg_match("/[^[:alnum:]]/", $tag))
		{
			// check for email addresses
			if (preg_match("/^.+\@.+$/", $tag))
				$tag = "mailto:".$tag;
			else if (preg_match("/^\/.+$/", $tag))
				$tag = $tag;
			// check for protocol-less URLs
			else if (!preg_match("/:\/\//", $tag))
				$tag = "http://".$tag;   //Very important for xss (avoid javascript:() hacking)
			// is this an inline image (text!=tag and url ends png,gif,jpeg)
		    if($text!=$tag and preg_match("/\.(gif|jpeg|png|jpg)$/i",$tag))
			 return "<img src=\"$tag\" alt=\"$text\" />";
		    elseif($text == $tag)
		    {
			if(strlen($tag)>29)
				$text = substr($tag, 0, 32).'[...]';
			return "<a href=\"$tag\">$text</a>";
		    }
		    else
			 return "<a href=\"$tag\">$text</a>";
		}
		else
			return $text;

	}

	function Action($action, $forceLinkTracking = 0)
	{
		$action = trim($action); $vars=array();
		// stupid attributes check
		if ((stristr($action, "=\"")) || (stristr($action, "/")))
		{
			// extract $action and $vars_temp ("raw" attributes)
			preg_match("/^([A-Za-z0-9]*)\/?(.*)$/", $action, $matches);
			list(, $action, $vars_temp) = $matches;
			// match all attributes (key and value)
			$parameter[$vars_temp]=$vars_temp;
			preg_match_all("/([A-Za-z0-9]*)=\"(.*)\"/U", $vars_temp, $matches);

			// prepare an array for extract() to work with (in $this->IncludeBuffered())
			if (is_array($matches))
			{
				for ($a = 0; $a < count($matches); $a++)
				{
					$vars[$matches[1][$a]] = $matches[2][$a];
					$parameter[$matches[1][$a]]=$matches[2][$a];
				}
			}
		}
	//	if (!$forceLinkTracking) $this->StopLinkTracking();
		$result = $this->IncludeBuffered(strtolower($action).".php", "<i>Action inconnue \"$action\"</i>", $vars, INCLUDESPATH."/actions/");
	//	$this->StartLinkTracking();
		if (isset($parameter)) unset($parameter[$parameter]);
		unset($parameter);
		return $result;
	}
}

function Wikise($text, $formatter = "wakka")
{
	global $Wiki;
	$Wiki = new Wikini();
	return $Wiki->Wikise($text, $formatter);
}

?>

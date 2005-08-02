<?
// This may look a bit strange, but all possible formatting tags have to be in a single regular expression for this to work correctly. Yup!

if (!function_exists("wakka2callback"))
{
	function wakka2callback($things)
	{
		$thing = $things[1];
        $result='';

		static $oldIndentLevel = 0;
		static $oldIndentLength= 0;
		static $indentClosers = array();
		static $newIndentSpace= array();
		static $br = 1;

		// convert HTML thingies
		if ($thing == "<")
			return "&lt;";
		else if ($thing == ">")
			return "&gt;";
		// bold
		else if ($thing == "**")
		{
			static $bold = 0;
			return (++$bold % 2 ? "<strong>" : "</strong>");
		}
		// italic
		else if ($thing == "//")
		{
			static $italic = 0;
			return (++$italic % 2 ? "<em>" : "</em>");
		}
		// underlinue
		else if ($thing == "__")
		{
			static $underline = 0;
			return (++$underline % 2 ? "<em class='underline'>" : "</em>");
		}
		// monospace
		else if ($thing == "##")
		{
			static $monospace = 0;
			return (++$monospace % 2 ? "<tt>" : "</tt>");
		}

                // warning
                else if ($thing == "||")
                {
                        static $warning = 0;
                        return (++$warning % 2 ? "<span class='warning'>" : "</span>");
                }


		// Deleted 
                else if ($thing == "@@")
                {
                        static $deleted = 0;
                        return (++$deleted % 2 ? "<span class=\"del\">" : "</span>");
                }
                // Inserted
                else if ($thing == "££")
                {
                        static $inserted = 0;
                        return (++$inserted % 2 ? "<span class=\"add\">" : "</span>");
                }
		// urls
		else if (preg_match("/^([a-z]+:\/\/\S+?)([^[:alnum:]^\/])?$/", $thing, $matches)) {
			$url = $matches[1];
				
			return "<a href=\"$url\">$url</a>".$matches[2];
		}
		// header level 5
                else if ($thing == "==")
                {
                        static $l5 = 0;
			$br = 0;
                        return (++$l5 % 2 ? "<h5>" : "</h5>");
                }
		// header level 4
                else if ($thing == "===")
                {
                        static $l4 = 0;
			$br = 0;
                        return (++$l4 % 2 ? "<h4>" : "</h4>");
                }
		// header level 3
                else if ($thing == "====")
                {
                        static $l3 = 0;
			$br = 0;
                        return (++$l3 % 2 ? "<h3>" : "</h3>");
                }
		// header level 2
                else if ($thing == "=====")
                {
                        static $l2 = 0;
			$br = 0;
                        return (++$l2 % 2 ? "<h2>" : "</h2>");
                }
		// header level 1
                else if ($thing == "======")
                {
                        static $l1 = 0;
			$br = 0;
                        return (++$l1 % 2 ? "<h1>" : "</h1>");
                }
		// separators
		else if (preg_match("/-{4,}/", $thing, $matches))
		{
			// TODO: This could probably be improved for situations where someone puts text on the same line as a separator.
			//       Which is a stupid thing to do anyway! HAW HAW! Ahem.
			$br = 0;
			return "<hr noshade=\"noshade\" size=\"1\" />";
		}
		// forced line breaks
		else if ($thing == "---")
		{
			return "<br />";
		}
		// escaped text
		else if (preg_match("/^\"\"(.*)\"\"$/s", $thing, $matches))
		{
			return $matches[1];
		}
		// code text
		else if (preg_match("/^\%\%(.*)\%\%$/s", $thing, $matches))
		{
			// check if a language has been specified
			$code = $matches[1];
			if (preg_match("/^\((.+?)\)(.*)$/s", $code, $matches))
			{
				list(, $language, $code) = $matches;
			}
			switch ($language)
			{
			case "php":
			case "table":
			case "wakka":
			case "wakka2":
				$formatter = $language;
				break;
			default:
				$formatter = "code";
			}

			$output .= Format(trim($code), $formatter);

			return $output;
		}
		// forced links
		else if (preg_match("/^\[\[(\S*)(\s+(.+))?\]\]$/", $thing, $matches))
		{
			list (, $url, , $text) = $matches;
			if ($url)
			{
				if ($url!=($url=(preg_replace("/@@|££||\[\[/","",$url))))$result="</span>";
				if (!$text) $text = $url;
				$text=preg_replace("/@@|££|\[\[/","",$text);
				return $result.WikiLink($url, "", $text);
			}
			else
			{
				return "";
			}
		}
		// indented text
		else if (preg_match("/\n(\t+|([ ]{1})+)(-|([0-9,a-z,A-Z]+)\))?/s", $thing, $matches))
		{
			// new line
			$result .= ($br ? "<br />\n" : "");

			// we definitely want no line break in this one.
			$br = 0;

			// find out which indent type we want
			$newIndentType = $matches[3];
			if (!$newIndentType) { $opener = "<div class=\"indent\">"; $closer = "</div>"; $br = 1; }
			else if ($newIndentType == "-") { $opener = "\n<ul>\n"; $closer = "</li>\n</ul>"; $li = 1; }
			else { $opener = "<ol type=\"".$matches[4]."\">\n"; $closer = "</li>\n</ol>"; $li = 1; }

			// get new indent level
			
			if (strpos($matches[1],"\t")) $newIndentLevel = strlen($matches[1]);
			else
			{
				$newIndentLevel=$oldIndentLevel;
				$newIndentLength = strlen($matches[1]);
				if ($newIndentLength>$oldIndentLength)
				{ 
					$newIndentLevel++;
					$newIndentSpace[$newIndentLength]=$newIndentLevel;
				}
				else if ($newIndentLength<$oldIndentLength)
						$newIndentLevel=$newIndentSpace[$newIndentLength];
			}
  			$op=0;
			if ($newIndentLevel > $oldIndentLevel)
			{
				for ($i = 0; $i < $newIndentLevel - $oldIndentLevel; $i++)
				{
					$result .= $opener;
					$op=1;
					array_push($indentClosers, $closer);
				}
			}
			else if ($newIndentLevel < $oldIndentLevel)
			{
				for ($i = 0; $i < $oldIndentLevel - $newIndentLevel; $i++)
				{
					$op=1;
					$result .= array_pop($indentClosers);
			                if ($oldIndentLevel && $li) $result .= "</li>";
				}
			}

			if (isset($li) && $op) $result .= "<li>";
			else if (isset($li))
				$result .= "</li>\n<li>";

			$oldIndentLevel = $newIndentLevel;
			$oldIndentLength= $newIndentLength;

			return $result;
		}
		// new lines
		else if ($thing == "\n")
		{
			// if we got here, there was no tab in the next line; this means that we can close all open indents.
			$c = count($indentClosers);
			for ($i = 0; $i < $c; $i++)
			{
				$result .= array_pop($indentClosers);
				$br = 0;
			}
			$oldIndentLevel = 0;
			$oldIndentLength= 0;
			$newIndentSpace=array();

			$result .= ($br ? "<br />\n" : "\n");
			$br = 1;
			return $result;
		}
		// events
		else if (preg_match("/^\{\{(.*?)\}\}$/s", $thing, $matches))
		{
			if ($matches[1])
				return Action($matches[1]);
			else
				return "{{}}";
		}
		// interwiki links!
                else if (preg_match("/^[A-Z][A-Z,a-z]+[:]([A-Z,a-z,0-9]*)$/s", $thing))

		{
			return WikiLink($thing);
		}
		// wiki links!
		else if (preg_match("/^[A-Z][a-z]+[A-Z,0-9][A-Z,a-z,0-9]*$/s", $thing))
		{
			return WikiLink($thing);
		}
		// if we reach this point, it must have been an accident.
		return $thing;
	}
}


$text = str_replace("\r", "", $text);
$text = trim($text)."\n";
$text = preg_replace_callback(
	"/(\%\%.*?\%\%|".
	"\"\".*?\"\"|".
	"\[\[.*?\]\]|".
	"\b[a-z]+:\/\/\S+|".
	"\*\*|\#\#|@@|££|__|<|>|\/\/|\|\||".
	"======|=====|====|===|==|".
	"-{4,}|---|".
	"\n(\t+|([ ]{1})+)(-|[0-9,a-z,A-Z]+\))?|".
	"\{\{.*?\}\}|".
        "\b[A-Z][A-Z,a-z]+[:]([A-Z,a-z,0-9]*)\b|".
	"\b([A-Z][a-z]+[A-Z,0-9][A-Z,a-z,0-9]*)\b|".
	"\n)/ms", "wakka2callback", $text);

// we're cutting the last <br />
$text = preg_replace("/<br \/>$/","", trim($text));
print($text);
?>

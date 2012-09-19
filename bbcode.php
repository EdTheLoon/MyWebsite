<?php
	function is_odd($intNumber)
	{
		if ($intNumber % 2 == 0 ) return true;
		else return false;
	}
	function badlink($link, $prefix) {
		if ($prefix == "mailto:") {
			if (strpos($link, "@") === FALSE || strpos($link, ".", (strpos($link, "@")+2)) === FALSE || substr_count($link, "@") > 1 || strpos($link, "@") == 0) {
				return 1;
			}
		}
		if (strpos($link, ".") == 0 || strpos($link, ".") == strlen($link) || (strpos($link, "/") < strpos($link, ".") && strpos($link, "/") !== FALSE)) {
			return 1;
		}
	};
	function setlinks($r, $prefix) {
		if (substr($r, 0, strlen($prefix)) == $prefix) {
			$r = "\n".$r;
		}
		$r = str_replace("<br>".$prefix, "<br>\n".$prefix, $r);
		$r = str_replace(" ".$prefix, " \n".$prefix, $r);
		while (strpos($r, "\n".$prefix) !== FALSE) {
			list($r1, $r2) = explode("\n".$prefix, $r, 2);
			if (strpos($r2, " ") === FALSE && strpos($r2, "<br>") === FALSE) {
				if ($prefix != "mailto:") {
					$target = ' target="_blank"';
				}
				else {
					$target = "";
				}
				if (strpos($r2, ".") > 1 && strpos($r2, ".") < strlen($r2) && badlink($r2, $prefix) != 1) {
					$r = $r1.'<a href="'.$prefix.$r2.'"'.$target.'><font size="2" color="blue">'.$prefix.$r2.'</font></a>';
				}
				else {
					$r = $r1.$prefix.$r2;
				}
			}
			else {
				if (strpos($r2, " ") === FALSE || ( strpos($r2, " ") > strpos($r2, "<br>") && strpos($r2, "<br>") !== FALSE)) {
					list($r2, $r3) = explode("<br>", $r2, 2);
					if (badlink($r2, $prefix) != 1) {
						$r = $r1.'<a href="'.$prefix.$r2.'"'.$target.'><font size="3" color="blue">'.$prefix.$r2.'</font></a><br>'.$r3;
					}
					else {
						$r = $r1.$prefix.$r2.'<br>'.$r3;
					}
				}
				else {
					list($r2, $r3) = explode(" ", $r2, 2);
					if (strpos($r2, ".") > 1 && strpos($r2, ".") < strlen($r2) && badlink($r2, $prefix) != 1) {
						$r = $r1.'<a href="'.$prefix.$r2.'"'.$target.'><font size="3" color="blue">'.$prefix.$r2.'</font></a> '.$r3;
					}
					else {
						$r = $r1.$prefix.$r2.' '.$r3;
					}
				}
			}
		}
		return $r;
	};


	function bb($r)
	{

		$r = trim($r);
		$r = htmlentities($r);
		$r = str_replace("\r\n","<br>",$r);
		$r = str_replace("[b]","<b>",$r);
		$r = str_replace("[/b]","</b>",$r);
		$r = str_replace("[img]","<img src='",$r);
		$r = str_replace("[/img]","'>",$r);
		$r = str_replace("[IMG]","<img src='",$r);
		$r = str_replace("[/IMG]","'>",$r);
		$r = str_replace("[s]","<s>",$r);
		$r = str_replace("[/s]","</s>",$r);
		$r = str_replace("[ul]","<ul>",$r);
		$r = str_replace("[/ul]","</ul>",$r);
		$r = str_replace("[li]","<li>",$r);
		$r = str_replace("[/li]","</li>",$r);
		$r = str_replace("[ol]","<ol>",$r);
		$r = str_replace("[/ol]","</ol>",$r);
		$r = str_replace("[quote]","<br /><table width='80%' bgcolor='#ffff66' align='center'><tr><td style='border: 1px dotted black'><font color=black><b>Quote:<br></b>",$r);
		$r = str_replace("[/quote]","</font></td></tr></table>",$r);
		$r = str_replace("[i]","<i>",$r);
		$r = str_replace("[/i]","</i>",$r);
		$r = str_replace("[u]","<u>",$r);
		$r = str_replace("[/u]","</u>",$r);
		$r = str_replace("[spoiler]",'[spoiler]<font bgcolor ="#000000" color="#DDDDDD">',$r);
		$r = str_replace("[/spoiler]","</font>[/spoiler]",$r);

		//set [link]s
	while (strpos($r, "[link=") !== FALSE)
	{
		list ($r1, $r2) = explode("[link=", $r, 2);
		if (strpos($r2, "]") !== FALSE) {
			list ($r2, $r3) = explode("]", $r2, 2);
			if (strpos($r3, "[/link]") !== FALSE) {
				list($r3, $r4) = explode("[/link]", $r3, 2);
				$target = ' target="_blank"';
				if (substr($r2, 0, 7) == "mailto:") {
					$target = "";
				}
				$r = $r1.'<a href="'.$r2.'"'.$target.'><font size="3" color="blue">'.$r3.'</font></a>'.$r4;
			}
			else {
				$r = $r1."[link\n=".$r2."]".$r3;
			}
		}
		else {
			$r = $r1."[link\n=".$r2;
		}
	}
		$r = str_replace("[link\n=","[link=",$r);
		////[link]

		///default url link setting
		$r = setlinks($r, "http://");
		$r = setlinks($r, "https://");
		$r = setlinks($r, "ftp://");
		$r = setlinks($r, "mailto:");
		////links

		///emoticons
		$r = str_replace(":)",'<img src="images/smilie.gif">',$r);
		$r = str_replace(":(",'<img src="images/sad.gif">',$r);
		$r = str_replace(":angry:",'<img src="images/angry.gif">',$r);
		$r = str_replace(":D",'<img src="images/biggrin.gif">',$r);
		$r = str_replace(":blink:",'<img src="images/blink.gif">',$r);
		$r = str_replace(":blush:",'<img src="images/blush.gif">',$r);
		$r = str_replace("B)",'<img src="images/cool.gif">',$r);
		$r = str_replace("<_<",'<img src="images/dry.gif">',$r);
		$r = str_replace("^_^",'<img src="images/happy.gif">',$r);
		$r = str_replace(":huh:",'<img src="images/confused.gif">',$r);
		$r = str_replace(":lol:",'<img src="images/laugh.gif">',$r);
		$r = str_replace(":o",'<img src="images/ohmy.gif">',$r);
		$r = str_replace(":fear:",'<img src="images/fear.gif">',$r);
		$r = str_replace(":rolleyes:",'<img src="images/rolleyes.gif">',$r);
		$r = str_replace(":sleep:",'<img src="images/sleep.gif">',$r);
		$r = str_replace(":p",'<img src="images/tongue.gif">',$r);
		$r = str_replace(":P",'<img src="images/tongue.gif">',$r);
		$r = str_replace(":unsure:",'<img src="images/unsure.gif">',$r);
		$r = str_replace(":wacko:",'<img src="images/wacko.gif">',$r);
		$r = str_replace(":wink:",'<img src="images/wink.gif">',$r);
		$r = str_replace(":wub:",'<img src="images/wub.gif">',$r);

		$r = trim($r);
		return $r;

	}
?>
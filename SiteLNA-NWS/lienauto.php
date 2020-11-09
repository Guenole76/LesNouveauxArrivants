<?php
	function lienauto($string)
	{

		$content_array = explode(" ", $string);

		$output1 = '';

		foreach($content_array as $content1)
		{
			if(substr($content1, 0, 7) == "http://")
			{
				$content1 = '<a href="' . $content1 . '">' . $content1 . '</a>';
			}elseif(substr($content1, 0, 8) == "https://")
			{
				$content1 = '<a href="' . $content1 . '">' . $content1 . '</a>';
			}elseif(substr($content1, 0, 4) == "www.")
			{
				$content2 = '<a href="https://' . $content1 . '">' . $content1 . '</a>';
				$connexion = @fopen($content2, "r");
				if(!$connexion)
				{
					$content1 = '<a href="http://' . $content1 . '">' . $content1 . '</a>';
				}else
				{
					$content1 = $content2;
				}
			}else
			{
				$content1 = str_replace(array("\r\n", "\r", "\n"), "<br/>", $content1);
			}
			$output1 .= " " . $content1;

		} 
		$output1 = trim($output1);

		return $output1;

	}
function autolink($string)
{
$content_array = explode(" ", $string);
$output1 = '';
foreach($content_array as $content1)
{
if(substr($content1, 0, 7) == "http://")
$content1 = '<a href="' . $content1 . '">' . $content1 . '</a>';
if(substr($content, 0, 4) == "www.")
$content1 = '<a href="http://' . $content1 . '">' . $content1 . '</a>';
$output1 .= " " . $content1;
}
$output1 = trim($output1);
return $output1;

}
?>
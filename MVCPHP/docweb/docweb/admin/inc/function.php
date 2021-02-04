<?php
 function shorter($text, $chars_limit)
	{
		//echo $text;exit;
		//echo $chars_limit;exit;
       if (strlen($text) > $chars_limit) 
	   
    return substr($text, 0, strrpos(substr($text, 0, $chars_limit), " ")).'...';
	
    else return $text;
   }
 ?>
<?php
define('IN_SITE', 	true);
define('IN_ADMIN', 	true);


include_once("../includes/common.php");

include($physical_path['DB_Access']. 'Feed.php');
$feed = new Feed();

$blogID='803735000658135085';
$requestURL="http://alphabetsuccess.blogspot.com/feeds/posts/default?max-results=150";
//$requestURL="http://alphabetsuccess.blogspot.com/feeds/2599704404859772047/comments/default";


	$ch = curl_init($requestURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	$doc = new SimpleXmlElement($data, LIBXML_NOCDATA);

	/*echo "<pre>";
	print_r($doc);
	echo "</pre>";
	die;*/

	//RSS
	if(isset($doc->channel))
	{
		$cnt = count($doc->channel->item);
		for($i=0; $i<$cnt; $i++)
		{
			$url 	= $doc->channel->item[$i]->link;
			$title 	= $doc->channel->item[$i]->title;
			$date 	= $doc->channel->item[$i]->pubDate;
			
			$feed->parseRSS($url,$title,$date,$i);
		}
	}
	//Atom
	else if(isset($doc->entry))
	{
		$cnt = count($doc->entry);
		for($i=0; $i<$cnt; $i++)
		{
			$post_by	= $doc->entry[$i]->author->name;
			$post_date 	= substr($doc->entry[$i]->updated,0,10);
			$title 		= $doc->entry[$i]->title;
			$content 	= $doc->entry[$i]->content;

			$urlAtt1 	= $doc->entry[$i]->link[1]->attributes();
			$comment_count	= rtrim($urlAtt1['title']," Comments");

			$html_link = getUniqueCategoryLink(BLOG_POST,'title', 'post_id', 'html_link', addslashes(trim($title)), 'add');
			$post_id 	= $feed->parseAtom($post_by, $post_date, $title, $content, $comment_count, $html_link);
			
			// Fetching comments and insert into our database
			if($comment_count>0){
				$urlAtt 	= $doc->entry[$i]->link->attributes();
				$commentURL	= $urlAtt['href'];
				
				$ch = curl_init($commentURL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$commentdata = curl_exec($ch);
				curl_close($ch);
				$cmnt = new SimpleXmlElement($commentdata, LIBXML_NOCDATA);
				
				if(isset($cmnt->entry))
				{
					$cnt2 = count($cmnt->entry);
					for($j=0; $j<$cnt2; $j++)
					{
						//$title 			= $comment->entry[$j]->title;
						$comment		= $cmnt->entry[$j]->content;
						$comment_by		= $cmnt->entry[$j]->author->name;
						$comment_email	= $cmnt->entry[$j]->author->email;
						$comment_date 	= substr($cmnt->entry[$j]->published,0,10);
			
						$feed->insertComments($post_id,$comment_by,$comment_email,$comment_date,$comment);
					}
				}
			}
		}
	}
	
	
?>
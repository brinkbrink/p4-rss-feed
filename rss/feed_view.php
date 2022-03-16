<?php
/**
 * feed_view.php
 * feed_view.php along with index.php allows us to view surveys
 * 
 * @package P4: RSS Feeds
 * @author Clare Swensen <clare.swensen@seattlecentral.com>
 * @author Ted Miller <tedmiller92@protonmail.com
 * @version 1.0 2022/02/17
 * @link http://www.example.com/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see index.php
 * @see feeds.php
 * @see Pager.php 
 * @todo none
 */

//  '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
if(isset($_GET['id'])) {
	$id = (int)$_GET['id'];
}else {
	echo 'no id';
}
// sql statement to select individual item
$sql = 'select * FROM winter2022_feeds WHERE FeedID = ' . $id;

// END CONFIG AREA ---------------------------------------------------------- 

get_header();	// defaults to theme header or header_inc.php

$foundRecord = FALSE;	// Will change to true, if record found!
   
//  connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0)
{// records exist - process
	   $foundRecord = TRUE;	
	   while ($row = mysqli_fetch_assoc($result))
	   {
			$request = $row['Link'];
			$response = file_get_contents($request);
			$xml = simplexml_load_string($response);
			echo '
			<h3 align="center" class="channel_title">' . $xml->channel->title . '</h3>
			<div class="panel panel-primary">
				<div class="panel-body">
					<p class="lead">The following feed includes articles from ' . $xml->channel->title . '</p>
					<a class="btn btn-primary" href="'.VIRTUAL_PATH . '/rss/feeds.php?id='.$row['CategoryID'].'"">More feeds in this category</a>
					<a class="btn btn-default" href="'.VIRTUAL_PATH . 'rss/index.php"">All RSS Categories</a>
				</div>
				<div class="panel-body">
			';
			
			foreach($xml->channel->item as $story){
				// begin incorporating bootswatch card
				echo '
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">' . $story->title . '</h3>
					</div>
					<div class="panel-body">
						<p><a href="' . $story->link . '" target="blank">Link to story</a></p>
						<p>' . $story->pubDate . '</p>
					</div>
				</div>
				';
			}
			echo '
			</div><!--end panel-body-->
			</div><!--end panel-->
			';
	   	}
}

@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php
?>
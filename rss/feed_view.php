<?php
/**
 * survey_view.php along with index.php allows us to view surveys
 * 
 * @package SurveySez
 * @author Clare Swensen <clare.swensen@seattlecentral.com>
 * @version 1.0 2022/02/17
 * @link http://www.example.com/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see index.php
 * @see Pager.php 
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
if(isset($_GET['id'])) {
	$id = (int)$_GET['id'];
}else {
	echo 'no id';
}
//sql statement to select individual item
$sql = 'select * FROM winter2022_feeds WHERE FeedID = ' . $id;
/* $sql = "select MuffinName,Description,MetaDescription,MetaKeywords,Price from test_Muffins where MuffinID = " . $myID; */
//---end config area --------------------------------------------------

get_header(); #defaults to theme header or header_inc.php

$foundRecord = FALSE; # Will change to true, if record found!
   
# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0)
{#records exist - process
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

@mysqli_free_result($result); # We're done with the data!

// if($foundRecord)
// {#only load data if record found
// 	$config->titleTag = $Link; #overwrite PageTitle with survey info!

// }

// get_header(); #defaults to theme header or header_inc.php

// if($foundRecord)
// {#records exist - show muffin!
// 	// ' . xxx . '
// echo '<h3><a href=" $Link "></h3>';
// }else{//no such survey!
//     echo '<div align="center">There is no such survey</div>';
//     echo '<div align="center"><a href="' . VIRTUAL_PATH . 'categories/feeds.php">Go back to survey list</a></div>';
// }

get_footer(); #defaults to theme footer or footer_inc.php
?>

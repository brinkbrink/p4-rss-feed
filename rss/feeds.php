<?php
/**
 * feeds.php
 * index.php along with category_view.php allows us to view subcategories of RSS feeds
 * 
 * @package P4: RSS Feeds
 * @author E. Brink <brinkbrink@gmail.com>
 * @version 1.0 2022/02/15
 * @link http://www.ebrink.online/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see index.php
 * @see feed_view.php
 * @see Pager.php 
 * @todo none
 */

//  '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
	$myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{
   myRedirect(VIRTUAL_PATH . "rss/index.php"); //send user back to a safe page
}

// SQL command for returning the feeds
$sql = "SELECT FeedID, winter2022_feeds.Title AS Title, Link AS Link, winter2022_categories.Title AS category FROM winter2022_feeds INNER JOIN winter2022_categories ON winter2022_feeds.CategoryID = winter2022_categories.CategoryID WHERE winter2022_feeds.CategoryID = " . $myID;

// SQL command for returning the category name
$sql2 = "SELECT Title FROM winter2022_categories WHERE CategoryID = " . $myID;

// Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'Categories made with love & PHP in Seattle';

// Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class Categories are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS,PHP'. $config->metaKeywords;

// Adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

// END CONFIG AREA ---------------------------------------------------------- 

get_header(); #defaults to theme header or header_inc.php

// images in this case are from font awesome
$prev = '<i class="fa fa-chevron-circle-left"></i>';
$next = '<i class="fa fa-chevron-circle-right"></i>';

// Create instance of new 'pager' class
$myPager = new Pager(10,'',$prev,$next,'');
$sql = $myPager->loadSQL($sql);  #load SQL, add offset

// connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

// this returns just the name of the category we are looking at
$category = mysqli_query(IDB::conn(), $sql2) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
$categoryTitle = mysqli_fetch_object($category)->Title;

if(mysqli_num_rows($result) > 0)
{ // records exist - process
	echo '
	<h3 align="center">Feeds about '.$categoryTitle.' </h3>
	';
	echo '
	<div class="panel panel-primary">
		<div class="panel-body">
			<p class="lead">Select one of the following feeds on ' . $categoryTitle . '</p>
	';
	// divs close after table element
	echo '
	<table class="table table-hover">
		<thead>
		<tr>
			<th scope="col">Feeds</th>	
		</tr>
		</thead>
		<tbody>
  	';
	
	while($row = mysqli_fetch_assoc($result))
	{ // process each row
		echo '
		<tr>
			<th><a href="' . VIRTUAL_PATH . 'rss/feed_view.php?id=' . (int)$row['FeedID'] . '">' . dbOut($row['Title']) . '</a></th>
		</tr>
		';
	}

	// closing tables and divs
	echo '
	</tbody>
	</table>
	</div><!-- end panel-body-->
	</div><!-- end panel-->
	';

	echo $myPager->showNAV(); # show paging nav, only if enough records	 
	echo '<a class="btn btn-default" href="'.VIRTUAL_PATH . 'rss/index.php"">Back to RSS Categories</a>';
}else{ // no records
    echo "<div align=center>There are currently no categories.</div>";	
	echo '<a class="btn btn-default" href="'.VIRTUAL_PATH . 'rss/index.php"">Back to RSS Categories</a>';
}
@mysqli_free_result($result);

get_footer(); // defaults to theme footer or footer_inc.php
?>
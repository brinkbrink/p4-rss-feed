<?php
/**
 * index.php along with category_view.php allows us to view subcategories
 * 
 * @package P4: RSS Feeds
 * @author E. Brink <brinkbrink@gmail.com>
 * @version 1.0 2022/02/15
 * @link http://www.ebrink.online/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see category_view.php
 * @see Pager.php 
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
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
# WORKING!!!!! SQL statement
// $sql = "select Title, FeedID from winter2022_feeds";

/* $sql = 
"select CONCAT(a.FirstName, ' ', a.LastName) AdminName, c.CategoryID, c.Title, 
date_format(c.DateAdded, '%W %D %M %Y %H:%i') 'DateAdded' from "
. PREFIX . "categories c, " . PREFIX . "Admin a where c.AdminID=a.AdminID order by c.DateAdded desc
"; */


#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'Categories made with love & PHP in Seattle';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class Categories are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS,PHP'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

# END CONFIG AREA ---------------------------------------------------------- 

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
	<div class="panel panel-primary">
		<div class="panel-body">
			<p class="lead">Select one of the following feeds on ' . $categoryTitle . '</p>
			<table class="table table-hover">
				<thead>
				<tr>
					<th scope="col">Feeds</th>	
				</tr>
				</thead>
				<tbody>
  	';
	// divs and tables close after processing data
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
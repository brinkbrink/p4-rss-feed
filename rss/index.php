<?php
/**
 * index.php
 * index.php along with feed_view.php allows us to view subcategories of RSS feeds
 * 
 * @package P4: RSS Feeds
 * @author E. Brink <brinkbrink@gmail.com>
 * @version 1.0 2022/02/15
 * @link http://www.ebrink.online/
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @see feed_view.php
 * @see Pager.php 
 * @todo none
 */

// '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 
 
// SQL statement
// $sql = "select Title, SurveyID, Description from winter2022_surveys";

$sql = 
"
select CONCAT(a.FirstName, ' ', a.LastName) AdminName, s.CategoryID, s.Title, 
date_format(s.DateAdded, '%W %D %M %Y %H:%i') 'DateAdded' from "
. PREFIX . "categories s, " . PREFIX . "Admin a where s.AdminID=a.AdminID order by s.DateAdded desc
";

// Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'Categories made with love & PHP in Seattle';

// Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s IT262 Class Categories are made with pure PHP! ' . $config->metaDescription;
$config->metaKeywords = 'RSS,PHP'. $config->metaKeywords;

//adds font awesome icons for arrows on pager
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

// END CONFIG AREA ---------------------------------------------------------- 

get_header(); // Defaults to theme header or header_inc.php
?>
<h3 align="center">News Category List</h3>

<?php
// images in this case are from font awesome
$prev = '<i class="fa fa-chevron-circle-left"></i>';
$next = '<i class="fa fa-chevron-circle-right"></i>';

// Create instance of new 'pager' class
$myPager = new Pager(10,'',$prev,$next,'');
$sql = $myPager->loadSQL($sql);  #load SQL, add offset

// Connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0)
{ // records exist - process
	echo '
	<table class="table table-hover">
		<thead>
		<tr>
			<th scope="col">Category</th>
		</tr>
		</thead>
		<tbody>
  	';
	while($row = mysqli_fetch_assoc($result))
	{# process each row

		echo '
		<tr>
			<th scope="row"><a href="' . VIRTUAL_PATH . 'rss/feeds.php?id=' . (int)$row['CategoryID'] . '">' . dbOut($row['Title']) . '</a></th>
	  	</tr>
  		';
	}
	echo '
	</tbody>
	</table>
	';
	echo $myPager->showNAV(); // show paging nav, only if enough records	 
}else{ //no records
    echo "<div align=center>There are currently no categories.</div>";	
}
@mysqli_free_result($result);

get_footer(); // defaults to theme footer or footer_inc.php
?>
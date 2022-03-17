# SCC IT 262 P4: RSS Feed

## Team Members

- [E. Brink](https://github.com/brinkbrink)
- [Ted Miller](https://github.com/ted-miller92)
- [Ryan Novelli](https://github.com/RANovelli)
- [Clare Swensen](https://github.com/clareswensen)

***
## Requirements

For our third group project we'll be  building a PHP application that provides categorized news pages from syndicated RSS feeds. These pages must come from feed data stored in a database.  The feed data must be cached on a session level so news pages generated during a current session are stored so the data does not need to be retrieved from the remote survey beyond the first page hit.

**Integrate RSS data into Feed Pages:** You'll be building pages that integrate customized RSS feeds into the client protosite.  The RSS feed must carry the look and feel of the protosite, plus include an RSS feed from Google, etc.  The pages should carry both the news stories and images if possible that accompany the news items. 

**A News Page with a Link to 3 News categories, each with 3 custom feeds (9 custom feeds in total):**  The entry point to the application should be a page linked to the protosite  as a page with a name such as "News" and then link to pages or an application that accommodates  at least 3 news categories, with at least 3 custom feeds under each.  

**2 Database Tables:** You must store your feed and category information in database tables.  Therefore you'll need a minimum of 2 tables. These tables could greatly resemble the books & categories tables from the Joins lesson on the class website!

**List/View:** The Category/Feeds pages will make great use of techniques we've learned such as List/View.  Be sure to study the example List/View pages in the demo folder of your client protosite.

***

## Extra Credit Opportunities

**Session Caching:** Every time we hit an RSS page provided by a third party we introduce delay and consume network resources.  Therefore we'll require you to cache the data once retrieved for a number of minutes (example, 10) that will enable your app to store data for that feed via a session and not retrieve the feed data again until the cache period is up.  Each news feed should have a separate cache mechanism. 

**Cache Time/Date & Clearing:** If RSS data is cached, the retrieval time/date should be displayed on each feed, along with the programmatic ability to clear the cache for that feed. You must also be able to programmatically clear the cache of all feeds. (Delete all existing session data)  

**Building the capability to add feed data through an administrative interface**.  The best starting point for this piece is the demo_add.php page in the demo folder.

**Building the capability to edit feed data through an administrative interface**.  The best starting point for this piece is the demo_edit.php page in the demo folder.

## Notes for Setting up on your own server

**Database Setup:** Execute the files "winter2022_categories.php" and "winter2022_feeds.php" in that order to set up the database. New entries can be added. 
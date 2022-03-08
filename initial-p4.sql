SET foreign_key_checks = 0; 


DROP TABLE IF EXISTS winter2022_categories; 
DROP TABLE IF EXISTS winter2022_feeds;
  
CREATE TABLE winter2022_categories(
CategoryID INT UNSIGNED NOT NULL AUTO_INCREMENT,
AdminID INT UNSIGNED DEFAULT 0,
Title VARCHAR(255) DEFAULT '',
DateAdded DATETIME,
PRIMARY KEY (CategoryID)
)ENGINE=INNODB; 

INSERT INTO winter2022_categories VALUES (NULL,1,'Mushrooms',NOW()); 
INSERT INTO winter2022_categories VALUES (NULL,1,'Music',NOW()); 
INSERT INTO winter2022_categories VALUES (NULL,1,'Tech',NOW()); 

CREATE TABLE winter2022_feeds(
FeedID INT UNSIGNED NOT NULL AUTO_INCREMENT,
CategoryID INT UNSIGNED DEFAULT 0,
AdminID INT UNSIGNED DEFAULT 0,
Title VARCHAR(255) DEFAULT '',
Link VARCHAR(500) DEFAULT '',
DateAdded DATETIME,
LastUpdated TIMESTAMP DEFAULT 0 ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (FeedID),
INDEX CategoryID_index(CategoryID),
FOREIGN KEY (CategoryID) REFERENCES winter2022_categories(CategoryID) ON DELETE CASCADE
)ENGINE=INNODB;

INSERT INTO winter2022_feeds VALUES (NULL,1,1,'Chanterelles','https://news.google.com/rss/search?q=chanterelle&hl=en-US&gl=US&ceid=US:en',NOW(),NOW());
INSERT INTO winter2022_feeds VALUES (NULL,1,1,'Morels','https://news.google.com/rss/search?q=morel&hl=en-US&gl=US&ceid=US:en',NOW(),NOW());
INSERT INTO winter2022_feeds VALUES (NULL,1,1,'Psilocybe','https://news.google.com/rss/search?q=psilocybe&hl=en-US&gl=US&ceid=US:en',NOW(),NOW());

INSERT INTO winter2022_feeds VALUES (NULL,2,1,'Jazz','https://londonjazznews.com/feed/?alt=rss',NOW(),NOW());
INSERT INTO winter2022_feeds VALUES (NULL,2,1,'Rock & Roll','https://garagehangover.com/feed',NOW(),NOW());
INSERT INTO winter2022_feeds VALUES (NULL,2,1,'Soul','https://www.funkmysoul.gr/feed',NOW(),NOW());

INSERT INTO winter2022_feeds VALUES (NULL,3,1,'New Yorker','https://www.newyorker.com/feed/tech',NOW(),NOW());
INSERT INTO winter2022_feeds VALUES (NULL,3,1,'Wired','https://www.wired.com/feed/category/gear/latest/rss',NOW(),NOW());
INSERT INTO winter2022_feeds VALUES (NULL,3,1,'Computer Weekly','https://www.computerweekly.com/rss/IT-careers-and-IT-skills.xml',NOW(),NOW());
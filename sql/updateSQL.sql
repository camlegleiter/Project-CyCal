DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS coming_soon_emails;
DROP TABLE IF EXISTS panel;
DROP TABLE IF EXISTS settings;

CREATE TABLE users (           
	userid INT NOT NULL AUTO_INCREMENT,           
	username VARCHAR(30) NOT NULL UNIQUE,           
	password VARCHAR(64) NOT NULL,         
	salt VARCHAR(40) NOT NULL,    
	email VARCHAR(128) NOT NULL,    
	created DATETIME NOT NULL,    
	ip VARCHAR(40) NOT NULL,    
	token VARCHAR(256),    
	PRIMARY KEY(userid)
);

CREATE TABLE admins (           
	userid  INT NOT NULL,           
	level INT NOT NULL,    
	created DATETIME NOT NULL,    
	PRIMARY KEY(userid),    
	FOREIGN KEY(userid) 
	references users(userid)
);

CREATE TABLE coming_soon_emails (              
	email VARCHAR(64) collate utf8_unicode_ci NOT NULL,        
	ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,    
	PRIMARY KEY(email)
);

CREATE TABLE panel (            
	userid INT(32) NOT NULL,              
	rss varchar(255) NOT NULL,            
	posx INT(32) NOT NULL,       
	posy INT(32) NOT NULL,       
	sizex INT(32) NOT NULL,       
	sizey INT(32) NOT NULL,       
	themeid INT(32) NOT NULL,       
	PRIMARY KEY(userid, rss)
); 

CREATE TABLE settings (
	userid INT(32) NOT NULL,
	background varchar(255),
	PRIMARY KEY(userid),
	FOREIGN KEY(userid) 
	references users(userid)
);

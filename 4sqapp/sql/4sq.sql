drop table if exists user;
create table user(
 ID INTEGER unsigned NOT NULL auto_increment,
 4sqid 	INTEGER unsigned NOT NULL,
 data text,
 username  VARCHAR(255) unique	,
 name VARCHAR(255) unique	,
 PRIMARY KEY(ID),
 index 4sqid_index(4sqid)
);



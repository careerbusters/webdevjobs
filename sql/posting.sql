drop table if exists Posting;
create table Posting (
	postingId binary(16) not null,
	postingContent BLOB not null,
	postingEmail varchar(512) not null,
	postingLocation varchar(64) not null,
	postingTitle varchar(128) not null,
	postingPay varchar(64) not null,
	postingCompanyName varchar(64) not null,
	postingDate varchar(64) not null,
	postingEndDate varchar(64) not null,
	postingRole varchar (32) not null,
	primary key(postingId)
);
alter database tgray19 character set utf8 collate utf8_unicode_ci;
drop table if exists Job;
drop table if exists Posting;
drop table if exists Profile;
drop table if exists Role;

create table Role (
	roleId binary(16) not null,
	roleName varchar(32) not null,
	primary key(roleId)
);
create table Profile (
	profileId BINARY(16) not null,
	profileRoleName varchar(32) not null,
	profileActivationToken char(32) not null,
	profileHash char(97) not null,
	profileUsername VARCHAR(32) not null,
	profileImage VARCHAR(64),
	profileBio VARCHAR(1024),
	profileLocation VARCHAR(64),
	profileEmail VARCHAR(32) not null,
	unique(profileUsername),
	unique(profileEmail),
	index(profileRoleName),
	primary key(profileId),
	foreign key(profileRoleName) references Role(roleName)
);

create table Posting (
	postingId binary(16) not null,
	postingContent varchar(1024) not null,
	postingContact varchar(512) not null,
	postingLocation varchar(64) not null,
	postingTitle varchar(128) not null,
	postingPay varchar(64) not null,
	postingCompanyName varchar(64) not null,
	postingDate varchar(64) not null,
	postingEndDate varchar(64) not null,
	postingRole varchar (32) not null,
	primary key(postingId)
);

create table Job (
	jobProfileId binary(16) not null,
	jobPostingId binary(16) not null,
	index(jobProfileId),
	index(jobPostingId),
	foreign key(jobProfileId) references Profile(profileId),
	foreign key(jobPostingId) references Posting(postingId)
);


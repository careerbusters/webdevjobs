alter database tgray19 character set utf8 collate utf8_unicode_ci;

drop table if exists savedJob;
drop table if exists posting;
drop table if exists profile;
drop table if exists role;

create table role (
	roleId binary(16) not null,
	roleName varchar(32) not null,
	primary key(roleId)
);
create table profile (
	profileId BINARY(16) not null,
	profileRoleId BINARY(16) not null,
	profileActivationToken char(32),
	profileBio BLOB,
	profileEmail VARCHAR(64) not null,
	profileHash char(97) not null,
	profileImage VARCHAR(64),
	profileLocation VARCHAR(64),
	profileUsername VARCHAR(64) not null,
	unique(profileUsername),
	unique(profileEmail),
	index(profileRoleId),
	primary key(profileId),
	foreign key(profileRoleId) references role(roleId)
);

create table posting (
	postingId binary(16) not null,
	postingProfileId binary (16) not null,
	postingRoleId binary (16) not null,
	postingCompanyName varchar(64) not null,
	postingContent BLOB not null,
	postingDate varchar(64) not null,
	postingEmail varchar(512) not null,
	postingEndDate varchar(64) not null,
	postingLocation varchar(64) not null,
	postingPay varchar(64) not null,
	postingTitle varchar(128) not null,
	index (postingProfileId),
	foreign key (postingProfileId) references profile(profileId),
	foreign key (postingRoleId) references role(roleId),
	primary key(postingId)
);

create table savedJob (
	savedJobPostingId binary(16) not null,
	savedJobProfileId binary(16) not null,
	foreign key (savedJobPostingId) references posting(postingId),
	foreign key (savedJobProfileId) references profile(profileId),
	primary key (savedJobPostingId, savedJobProfileId)
);



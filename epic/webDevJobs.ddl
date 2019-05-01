create table Profile (
	profileId BINARY(16) not null,
	profileActivationToken char(32) not null,
	profileHash char(97) not null,
	profileUsername VARCHAR(32) not null,
	profileImage VARCHAR(64),
	profileBio VARCHAR(1024),
	profileLocation VARCHAR(64),
	profileEmail VARCHAR(32) not null,
	unique(profileUsername),
	unique(profileEmail),
	index(profileEmail),
	primary key(profileId)
);

create table JobPosting (
	jobPostingId binary(16) not null,
	jobPostingContent varchar(1024) not null,
	jobPostingContact varchar(512) not null,
	jobPostingLocation varchar(64) not null,
	jobPostingTitle varchar(128) not null,
	jobPostingPay varchar(64) not null,
	jobPostingCompanyName varchar(64) not null,
	jobPostingDate varchar(64) not null,
	jobPostingEndDate varchar(64) not null,
	primary key(jobPostingId)
);

create table SavedJob (
	savedJobProfileId binary(16) not null,
	savedJobJobPostingId binary(16) not null,
	savedJobUnsave varchar(32) not null,
	savedJobSave varchar(32) not null
	foreign key(savedJobProfileId) references Profile(profileId),
	foreign key(savedJobJobPostingId) references JobPosting(jobPostingId),
);
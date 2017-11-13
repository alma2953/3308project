create database Trendzy;
use Trendzy;

create table Users (
	`id` int not null auto_increment,
	`username` varchar(255) not null,
	`email` varchar(255) not null,
	`first_name` varchar(255) not null,
	`last_name` varchar(255) not null,
	`password` varchar(255) not null,
	primary key (`id`)
);

create table Places (
	`id` int not null auto_increment,
	`longitude` float not null, 
	`latitude` float not null,
	`location` varchar(255) not null,
	`user_id` int not null,
	primary key (`id`)
);

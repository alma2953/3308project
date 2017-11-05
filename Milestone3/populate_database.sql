/* populate Users table with sample data */

insert into `Users` (`id`, `name`, `username`, `email`) values
	(1, 'Mohamed', 'Mohd', 'test1@test.com'),
	(2, 'Alex', 'Alex', 'test2@test.com'),
	(3, 'Abdullah', 'Abdul', 'test3@test.com'),
	(4, 'Firas', 'Firas', 'test4@test.com'),
	(5, 'James', 'Jay', 'test5@test.com');


/* populate Places table with sample data */
/* user_id in Places table matches id from Users table */
insert into `Places` (`longitude`, `latitude`, `location`, `user_id`) values
	(-74.005973, 40.712775, 'New York', 5),
	(-105.270546, 40.014986, 'Boulder', 2),
	(-115.139830, 36.169941, 'Las Vegas', 3),
	(39.237551, 21.285407, 'Jeddah', 3),
	(58.405923, 23.585890, 'Muscat', 4),
	(11.581980, 48.135125, 'Munich', 4),
	(-0.127758, 51.507351, 'London', 4),
	(2.173403, 41.385064, 'Barcelona', 1);



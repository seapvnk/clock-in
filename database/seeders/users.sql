-- User seeders
-- The password is que cryptographed key for string "a"
INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (1, 'Admin', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'admin@clock.in.com.br', '2000-1-1', null, 1);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (2, 'Pedro Sérgio', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'pedro@clock.in.com.br', '2000-1-1', null, 1);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (3, 'Chad Workaholic', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'workaholics@clock.in.com.br', '2000-1-1', null, 0);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (4, 'Gary Lazyson', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'gary@clock.in.com.br', '2000-1-1', null, 0);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (5, 'Jane Johnson', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'jjohnson@clock.in.com.br', '2000-1-1', '2019-1-1', 0);

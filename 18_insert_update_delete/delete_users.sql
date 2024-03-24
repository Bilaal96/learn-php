-- Anywhere we use WHERE, we can combine multiple conditions with logical operators
-- Below we delete the user with an id of 2 
-- NOTE: once that user is deleted, their id (2) will not be used
-- The next user created will be created with an id of 3
DELETE FROM users
WHERE id = 2;

-- Try re-inserting the user with:
-- Observe the user id assigned to the record in phpMyAdmin
-- Given there were no additional users, the id of the newly inserted users will be 3
INSERT INTO users (username, pwd, email)
VALUES ('Basse', 'basse123', 'bassedoe@email.com');

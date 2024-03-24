-- SELECT ALL users with ALL fields
SELECT * FROM users;

-- SELECT ALL comments with ALL fields
SELECT * FROM comments;

-- SELECT user with id of 3 with ALL fields
SELECT * FROM users 
WHERE id = 3;

-- SELECT ALL comments by the user with id of 1
SELECT * FROM comments
WHERE users_id = 1;

-- SELECT specific fields for a user with id of 3
SELECT username, email 
FROM users 
WHERE id = 3;

-- SELECT specific fields for a comment by the user with id of 1
SELECT username, comment_text 
FROM comments
WHERE users_id = 1;
-- NOTE: how we use users_id, as simply using 'id' would reference the id of the comment
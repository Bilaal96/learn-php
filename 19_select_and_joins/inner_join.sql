-- An INNER JOIN on 2 tables 'users' & 'comments', selecting all records from 
-- ... BOTH tables where users.id matches comments.users_id 

-- This selects all users who have made a comment, as well as the comments they have made
SELECT * FROM users
INNER JOIN comments
ON users.id = comments.users_id;

-- Instead of selecting ALL the fields, you cherry pick which ones you want
-- ... from each table
-- NOTE: AS allows you to specify a more descriptive ALIAS for a field name
SELECT comments.users_id, users.username, comments.id AS 'comment_id', comments.comment_text, comments.created_at FROM users
INNER JOIN comments
ON users.id = comments.users_id;
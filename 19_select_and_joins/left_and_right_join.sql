-- A LEFT JOIN selects all records from the LEFT table, regardless of whether 
-- ... they have matching record in the RIGHT table
-- RIGHT Table fields will be filled with NULL for LEFT table records that don't 
-- ... have a matching record on the RIGHT

-- This selects all users and the comments they have made
-- If a user has no comments, they will still be displayed
-- BUT the comment-related fields will be filled with NULL values

SELECT * FROM users
LEFT JOIN comments
ON users.id = comments.users_id;

-- Conversely, if we made a RIGHT JOIN with the users & comments tables, the query
-- ... would SELECT all comments & their corresponding users (if the users exist)

-- For this situation you can imagine a user has deleted their account BUT their
-- ... comments still exist (e.g. like Reddit)

-- So comments of a deleted user would still show up in the query EXCEPT the users
-- ... fields would be filled with NULL

-- This outputs the same records as above except the column names for each table 
-- ... appear on opposite sides
SELECT * FROM comments 
RIGHT JOIN users 
ON users.id = comments.users_id;

-- NOTE: columns for table specified FIRST appear on the LEFT
--       columns for table specified SECOND appear on the RIGHT
-- HOWEVER the order in which they're specified will also affect your choice
-- ... between a LEFT / RIGHT JOIN
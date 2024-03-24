-- Update a specific record
-- Specify the table you want to UPDATE
-- SET column(s) / field(s) with their new values; only specify the ones you want to 
-- ... change 
-- Target a specific record in the DB WHERE the user 'id' = 2
UPDATE users
SET username = 'BasseIsCool', pwd = 'basse456'
WHERE id = 2;
-- Alternatively, we could target the record via another field
-- e.g. WHERE username = 'Basse';
-- In some systems, usernames may not be unique 
-- e.g. where they simply act as display names

-- Since id is unique, it's guaranteed to update a single record 

-- You may also target a record by multiple fields along with logical operators
-- e.g. using AND --> WHERE username = 'Basse' AND pwd = 'basse123';
-- e.g. using OR --> WHERE username = 'Basse' OR username = 'Krossing';
--               --> WHERE id = 1 OR id = 2;
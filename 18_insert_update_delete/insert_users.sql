-- id field is auto-generated
-- created_at has a default value, so we don't have to specify one
-- So we only have to specify: username, pwd (password), email
-- Values must be specified in the same order in which the fields are specified 
INSERT INTO users (username, pwd, email)
VALUES (
  'Krossing',
  -- NOTE: in the real-world, of course we would store this as a hashed password
  'dani123',
  'danidoe@email.com'
);

INSERT INTO users (username, pwd, email)
VALUES ('Basse', 'basse123', 'bassedoe@email.com');

-- To insert both of the records at the same time, specify multiple value sets like so
INSERT INTO users (username, pwd, email)
VALUES 
  ('Krossing', 'dani123', 'danidoe@email.com'), -- this is one record
  ('Basse', 'basse123', 'bassedoe@email.com'); -- this is another

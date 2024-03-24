CREATE TABLE users (
  -- id - name of column
  -- INT(11) - data type & display length
  -- NOT NULL - specifies the column MUST NOT be empty
  -- AUTO_INCREMENT - automatically assigns an unsigned id = prev generated id + 1
  id INT(11) NOT NULL AUTO_INCREMENT,

  -- VARCHAR(30) - max length of 30 chars (arguably 20 may even be enough)
  username VARCHAR(30) NOT NULL,

  -- pwd - "password" already exists in phpMyAdmin, so we use "pwd" instead
  -- VARCHAR(255) - max length of 255 chars - password should not be greatly limited 
  pwd VARCHAR(255) NOT NULL,
  
  -- VARCHAR(100) - max length of 100 chars - long emails are most likely bot-generated
  email VARCHAR(100) NOT NULL,

  -- created_at - date & time at which the user/entry was created
  -- DATETIME - allows date & time to be stored
  -- DEFAULT CURRENT_TIME - will auto generate the DATETIME value based on the server date-time
  -- NOTE: CURRENT_DATE only creates a date, whereas CURRENT_TIME creates both a date & time
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,

  -- PRIMARY KEY (PK) - specifies which column will be used to uniquely reference a distinct record
  -- PKs must be unique. They cannot be duplicated; e.g. we cannot have 2 users with the same id
  -- The PK may also be defined by appending PRIMARY KEY to the line on which the field is defined
  -- e.g. id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY <------- like so
  PRIMARY KEY (id)
);
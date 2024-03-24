CREATE TABLE comments (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  -- comment_text is long form content, so we use TEXT instead of VARCHAR
  comment_text TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
  PRIMARY KEY (id)

  -- Foreign Key - references (or points to) a primary key from another table
  -- Forms a relationship between 2 tables
  -- Can be referenced to perform actions (queries/mutations) on related tables/records

  -- Here we create a field called "users_id"
  users_id INT(11)L,
  -- Here we mark "users_id" as a FOREIGN KEY
  -- Then we specify the name of table & column that it refers to
  -- If the RELATED record is deleted, set users_id in comments to NULL
  FOREIGN KEY(users_id) REFERENCES users (id) ON DELETE SET NULL

  -- Example: what happens to the table relationships when a user deletes their account
  -- Does it error and say you have existing comments so you cannot delete?
  -- Does it find and delete all comments related to a user?
  -- Does it find all comments related to the user and change the display name to "deleted user"

  -- By default, you get an error message because of the default ON DELETE value
  -- FOREIGN KEY(users_id) REFERENCES users (id) ON DELETE NO ACTION
  -- This says, if an attempt is made to delete a user, with a FOREIGN KEY in this table
  -- DO NOT DELETE THE USER OR THE RELATED COMMENTS

  -- Logically, for many real-world use cases, this doesn't make much sense
  -- A user should still be able to delete their account, even if they made a comments somewhere

  -- We can instead set ON DELETE to CASCADE
  -- Meaning when deleting a record, if any record from ANOTHER table references it by FK 
  -- ... the delete will cascade - i.e. delete the records referencing via FK

  -- More simply, records with a RELATION to the deleted record, will also be deleted
  -- So if a user deletes their account, all their comments (referencing their user_id) 
  -- ... will also be deleted

  -- Another option is setting ON DELETE to SET NULL
  -- For every comment made by a user, this sets the value of user_id in the comments 
  -- ... table to NULL

  -- In our example, this would throw an error when executing the script because
  -- ... we have defined user_id with the NOT NULL constraint
  -- If we remove NOT NULL from user_id, ON DELETE SET NULL would work fine
  -- i.e. it's defined to set a non-nullable field to NULL - which is illogical

);
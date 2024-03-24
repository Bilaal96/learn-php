# SELECT & JOIN Queries

## SELECT Basics

The general structure of a basic SELECT statement is outlined below.

```sql
  SELECT column_name_1, column_name_2...
  FROM table_name
  WHERE column_name = column_value;
```

## JOINS

- The best way to look at joins is by thinking about mathematical sets (i.e. venn diagrams).
- For example the set of Table A and Table B. The query will return all records in BOTH Tables A & B that satisfy the JOIN conditions.
- Such conditions will vary depending on the type of JOIN used.

> 📝 MySQL does not support FULL JOIN, although if you read on you can see how to emulate FULL JOIN!

Where left brackets = Table A, and right brackets = Table B

- LEFT JOIN - (X) x ( )
  - All in A, and all shared by (i.e. the intersection of) A & B
- RIGHT JOIN - ( ) x (X)
  - All in B, and the intersection of A & B
- INNER JOIN - ( ) x ( )
  - The intersection of A & B
- CROSS JOIN - (X) x (X)
  - All in A & All in B, including the intersection of A & B

## JOIN Examples

The examples below outline the different types of joins using 2 tables as examples: `users` & `comments`.

### LEFT JOIN

```sql
SELECT * FROM users
LEFT JOIN comments
ON users.id = comments.users_id;
```

> NOTE: the ON condition specifies the relation between the tables, where `comments.users_id` is a foreign key referencing `users.id`

- The `ON` condition ensures that only rows matching the condition are returned
- This example returns all users (LEFT table), and the comments they have made (RIGHT table)
- If a user hasn't made any comments, the row in the RIGHT table is filled with `NULL` values

### RIGHT JOIN

```sql
SELECT * FROM users
RIGHT JOIN comments
ON users.id = comments.users_id;
```

For this example think of a site like Reddit - where they retain the comments made by a user, even after they've deleted their account

- Lets imagine that some users have deleted their accounts
- This example returns all users (LEFT table), and the comments they have made (RIGHT table)
- If a user has deleted their account AND they left behind comments they made, then the row in the LEFT (users) table is filled with `NULL` values, whilst their comment in the right table is returned

### INNER JOIN

( ) x ( ) - The intersection (x) of A & B

An INNER JOIN selects all records that have matching values in both tables.

```sql
SELECT * FROM users
INNER JOIN comments
ON users.id = comments.users_id;
```

Continuing with the example of Reddit from our RIGHT JOIN - where a user may delete their account and their comments still exist:

- This INNER JOIN example will only return users who have made comments AND comments with an existing user
- All users who have not made comments are excluded
- All comments made by a deleted user are excluded

### Emulating a FULL JOIN

A FULL JOIN combines the results of a LEFT JOIN & RIGHT JOIN.

NOTE: MySQL doesn't have a built-in FULL JOIN. However, it can be achieved by taking the LEFT JOIN of 2 tables + UNION with the RIGHT JOIN of the same 2 tables

For example:

```
SELECT _
FROM table1
LEFT JOIN table2 ON table1.id = table2.id

UNION

SELECT _
FROM table1
RIGHT JOIN table2 ON table1.id = table2.id;
```

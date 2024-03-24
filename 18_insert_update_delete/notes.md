# Modifying Table Data - Insert / Update / Delete Functionality

In SQL it is convention to use single quotes when specifying string literals (e.g. for values & identifiers)

## INSERT data

Below is the code for inserting records into a database.

> NOTE: values should be entered respective to the order in which columns are specified.

```sql
INSERT INTO table_name (column_name_1, column_name_2, column_name_3)
VALUES
  (row_value_1, row_value_2, row_value_3), -- record 1
  (row_value_1, row_value_2, row_value_3), -- record 2
  (row_value_1, row_value_2, row_value_3); -- record 3
```

## UPDATE data

Below is the code for updating existing records in a database.

```sql
UPDATE table_name
SET column_name_1 = row_value_1, column_name_2 = row_value_2, ...
WHERE condition;
```

> 🚨 NOTE: be sure to be remember to include a WHERE condition!
> Without it, all rows in the table will be updated with the specified fields.

## DELETE data

Below is the code for deleting existing records from a database.

```sql
DELETE FROM table_name
WHERE condition;
```

## WHERE Conditions

- You can create complex conditions using the logical operators `AND` & `OR` in your `WHERE` conditions

For example, this query DELETEs users named `Dylan` under the age of `18`:

```sql
DELETE FROM users
WHERE first_name = "Dylan" AND age < 18;
```

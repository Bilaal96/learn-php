# Create a Table in your DB

To add tables to your database:

- you can import existing data from somewhere else (e.g. an existing DB)
- you can use the phpMyAdmin UI under "Structure" to create Table
  - however it offers too many options that we don't yet need to consider
  - so instead we will create the Tables using raw SQL via the "SQL" menu option

## SQL Data Types

- Rows hold all the info for a single entry (or record) in a table
- Columns are identifiers that represent each piece of data stored (in an entry/record) by the table
- Each column must be defined with a data type when creating the table

> NOTE: Each data type is allocated a specific amount of memory, and they also have an upper/lower limit due to hardware limitations.

### Numeric Types

#### Integer (Whole Number) Types

Multiple integer types exist for optimisation purposes. We want to make sure that we're not taking up more space than we need. Documentation: https://dev.mysql.com/doc/refman/8.0/en/integer-types.html

Integer Type Examples:

- INT - 4 bytes - signed/unsigned
- BIGINT - 8 bytes - signed/unsigned

#### Passing a "Display Width" Argument to Numeric Types

Numeric data types accept an argument representing the "display width" (e.g. `INT(5)`). This DOES NOT specify the storage size or range of the integer data type. Instead, a "display width" specifies how many digits/chars of a number is displayed when viewing the data (e.g. via phpMyAdmin) - i.e. it is for formatting purposes only.

> NOTE: this does not affect how the number is displayed in your website.

The default display width is 11 characters - e.g. `INT(11)`.
In most cases, you can safely rely on the default behaviour without explicitly specifying `INT(11)`. MySQL will automatically assign a display width of 11 characters if you do not specify it explicitly. Therefore, specifying `INT(11)` explicitly is not necessary from a functional standpoint.

However, there might be scenarios where explicitly specifying the display width could be beneficial for clarity and consistency in your database schema definition, especially if you're working in a team or need to maintain compatibility with certain tools or frameworks that expect explicit data type definitions. Additionally, some developers prefer explicitly defining all aspects of the column, including the display width, for documentation and readability purposes.

In summary, while it's generally safe to rely on the default behaviour, whether or not to specify `INT(11)` explicitly depends on your specific requirements, preferences, and the conventions followed in your project or organization.

#### Floating-Point Types

Documentation: https://dev.mysql.com/doc/refman/8.0/en/floating-point-types.html

- `FLOAT` - 4 bytes - signed/unsigned
- `DOUBLE` - 8 bytes - signed/unsigned

#### Fixed-Point Types

Documentation: https://dev.mysql.com/doc/refman/8.0/en/fixed-point-types.html#

`DECIMAL` & `NUMERIC` data types store EXACT numeric values. These types are used when it is important to preserve exact precision, for example with monetary data.

- `DECIMAL`
- `NUMERIC` - implemented as `DECIMAL`

### String Types

#### `CHAR` & `VARCHAR`

Documentation: https://dev.mysql.com/doc/refman/8.0/en/char.html

Both `CHAR` & `VARCHAR` are declared with a MAX LENGTH argument that indicates the maximum number of characters a string can store.

- The default is 1 - e.g. `VARCHAR(1)`

##### `CHAR`

- Fixed length - in range of 0-255 (inclusive)
  - e.g `CHAR(32)` -> can only store 32 bytes -> nothing more, nothing less
  - e.g `CHAR(4)` -> can only store 4 bytes -> nothing more, nothing less

Continuing with example of `CHAR(4)`:

- If the string stored is less than 4 bytes, it will be right-padded with trailing spaces - e.g. "ab" --> stored as "ab "
- If the string exceeds 4 bytes, the string is truncated to 4 bytes - e.g "abcdefg" --> stored as "abcd"
- When retrieved from the DB, trailing spaces are truncated - e.g. the stored value "ab " --> is retrieved and read as "ab"

##### `VARCHAR`

- `VARCHAR` is a variable-length string. The length can be specified as a value from 0 to 65,535 (where 65,535 bytes is also the limit for a single row)
- If the value assigned to a `VARCHAR` field is shorted than the declared max length, it is not right-padded with trailing spaces
- If you exceed the max char length, the exceeding length of the string will be truncated from the end

- A `VARCHAR` column has a "length prefix", which is either:

  - 1 byte if `VARCHAR` <= 255 bytes
  - or 2 bytes if `VARCHAR` > 255 bytes

Lengths will vary depending on the purpose of the data being stored. For example:

- Username: `VARCHAR(30) `- limit to 30 chars
- Password: `VARCHAR(255)` - limit to 255 chars

#### TEXT

For long form string content, you may consider using `TEXT` - e.g. for comments/blog posts, as they have a higher MAX LENGTH limit.

#### DATE & DATETIME

In databases, dates are formatted in a specific way and this MUST be considered BEFORE storing them in your DB. So when writing PHP ensure that the dates are formatted in the way that the DB would expect it to be formatted.

- `DATE` - 2023-05-14 - a date string
- `DATETIME` - 2023-05-14 11:30:00 - a date & time string
  - NOTE: the time is stored in a 24hr format - 5pm = 17:00:00

## Signed & Unsigned Numbers

- A signed INT can store a value in the range of -2,147,483,648 to 2,147,483,647. NOTE: the sign itself (+/-) takes up memory
- When you create an unsigned INT, you're no longer storing negative values.
- As a result of this, you can store a much larger positive number; ranging from 0 to 4,294,967,295.

This is conceptually the same for all numeric types. Making a number unsigned will increase the range of positive numbers that can be stored. However you do of course lose the ability to store signed numbers (or more specifically negative).

Example of Definition:

- `INT(11) UNSIGNED`
- `INT(11) SIGNED`

## Creating A Users Table

```sql
CREATE TABLE table_name (
  id INT(11) NOT NULL AUTO_INCREMENT,
  value2,
  value3,
  etc.
);
```

Naming conventions:

- lowercase
- snake_cased
- generally, by convention, we use singular nouns for table names
- using plural noun in edge cases:
  - you SHOULD NOT use a reserved name - e.g. phpMyAdmin warns that table names "USER" & "COMMENT" cannot be used as they already exists / they're reserved keywords
  - so to create our tables, we can use the plural "users" & "comments" here instead

Reference for conventions:

- https://stackoverflow.com/questions/7899200/is-there-a-naming-convention-for-mysql
- https://launchbylunch.com/posts/2014/Feb/16/sql-naming-conventions/#naming-conventions

## Primary Key

- A PRIMARY KEY (PK) is used to define the column by which a row/record in a table should be referenced.
- They're typically an auto-incrementing +ve integer in SQL databases
- PK's can be referenced as FOREIGN KEYs in other tables in order to form relationships between tables

## Foreign Key

- References a PRIMARY KEY in another table in order to form a relationship between 2 tables
- A FOREIGN KEY references the PRIMARY KEY of another table

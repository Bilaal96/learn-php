# Change Username & Password in MySQL Database

1. Select phpMyAdmin logo to ensure you're on the main page
2. From the top navigation select User Accounts
3. Find the user with Username="root" & Hostname="localhost"
   1. NOTE: we used this user to establish a DB connection via PDO
4. Click "Edit Privileges"
5. On the page that opens, you should see a new sub-navigation below the top navbar. Select "Login Information" from here.
6. Here, you can edit the username, then click "Go" to submit. You can also edit the password here but it's advised not to (due to a bug that may occur when using the inputs to edit the password).
7. Instead, to change the password go to the sub-navigation bar, select "Change password",change it using the form presented, then click "Go" to submit.

## Solution: XAMPP Error #1034: index for table DB is corrupt

This is a well known bug with XAMPP when trying to change the username and password. When following step 2 (above), you may be presented with: "XAMPP Error #1034: index for <em>table_name</em> in <em>db_name</em> DB is corrupt", and it prevents you from accessing the User Accounts page.

Also as part of the error message you're given a SQL query string with the DB name.

To fix it, you need to identify the corruption by navigating to the DB shown in the SQL query string - it's commonly the built-in "mysql" DB.

You may or may not be told which table the corruption lies in.

If you are told, select the table (via checkbox on left), scroll down to the bottom, from the dropdown select the "Repair table" option under "Table maintenance". This should fix the error message.

Scroll down, select "check all", then from the adjacent drop down menu, under Table maintenance, select "Check table". This MAY fix the issue.

After following either of the above, go back to phpMyAdmin and follow the steps to change the username/password.

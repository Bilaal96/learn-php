# Login System

## Overview

- Using `session_create_id()` to create a more complex Session ID Cookie on login,
  - This is accomplished by combining user ID & session ID

## Input Validation

There are simply 3 things we want to validate:

- empty fields -> an input is empty -> error: `"Please fill in ALL fields!"`
- incorrect username -> `"Incorrect username/password!"`
- incorrect password -> `"Incorrect username/password!"`

We intentionally keep form error messages vague for security reasons - i.e. to not give any clues to a malicious user

In order to validate the username & password, we:

- fetch the user from the DB using model function: `$user = getUser($pdo, $username);`
- validate the `$user` object using `userExists($user)` -> returns true/false appropriately - this works because `getUser()` returns:
  - `false` if the user doesn't exist - internally, `$stmt->fetch()` returns false when NO result is returned
  - `true` if the user DOES exist - internally`$stmt->fetch()` returns an array when a result IS returned

So if user does not exist -> set error message -> `"Incorrect username/password!"`

If user does exist -> test the password using `isPasswordIncorrect($password, $hashedPassword)`:

- if password is incorrect -> set error message -> `"Incorrect username/password!"`
- otherwise proceed to login

- inputs are empty
- user with username does not exist
  - querying the DB
- user exists, and password entered matches the one stored in DB
  - verifying password
- Keeping error messages vague for incorrect username / password

To display the errors we iterate over the `$_SESSION["login_errors"]` variable output each error; in this case there can only be 1 of 2 errors to display.

## Associating a Logged In User with a Session

### Tutorial Flaw - `session_id()` must be called before `session_start()`

For enhanced security, the tutorial attempts to generate a custom session ID (using `session_create_id() & session_id()`), combining Session ID with User ID.

The issue with this is that when using `session_id()` to SET the session ID, it MUST be called BEFORE `session_start()`; otherwise you get:

```
Warning: session_id(): Session ID cannot be changed when a session is active
```

### Alternative Solution - Assign user ID to a session variable on successful login

As a result of the aforementioned flaw, we alternatively set the user ID in the session variable. This way we can check the `$_SESSION` for the `user_id` key when performing operations requiring `user_id`.

Additionally, we can attach other NON-SENSITIVE data to the session - such as the username to display it in the UI.

> But remember, whenever something could be displayed in the browser, we MUST escape the string characters using `htmlspecialchars()` in order to prevent XSS attacks.

### How did the above change affect our existing `regenerateSessionID()` function in `config_session.inc.php` & what did you have to do to resolve the issues that arise

- `regenerateSessionID()` will not append the userID

#### Possible Solution

- In `config_session.inc.php`, add an if statement to handle regenerating session ID when a user is logged in
- It can check if a user is logged in by checking whether `$_SESSION["user_id"]` is set
  - this is a session variable that we can manually set once a user logs in

## Notify User of Successful Login using URL Query Params

This is accomplished in the same way as our Signup Form. On successful login, (username found & password was correct), we use `header()` to set the URL Query Param `?login=success`. Then in our Login view, we test to see if this param was set in the URL; if it is we simply render the login success message.

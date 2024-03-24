# Sign-up System

## Overview

Some of the new things we'll cover

- MVC Architecture Pattern
  - Helps you to organise code in scalable way
  - Helps to reduce duplicate code & promotes code reusability
- Input validation - ensuring users have entered values in all fields
- Error handling
- Displaying form errors in UI for user feedback
- **MENTIONED IN VIDEO BUT DIDN'T DEMONSTRATE:** Generate better/more complex Session IDs by combining User ID from DB with a generated Session ID

## MVC Pattern

MVC is a design pattern used to structure the folders & files of your project in a way that is easily organised, scalable, maintainable & reusable. MVC stands for Model-View-Controller, where each constituent holds a specific responsibility.

### Constituents of MVC

- Model - is responsible for sending queries & mutations to the DB
- View - is responsible for determining what to show the user in the browser
- Controller - is the middle-man/an intermediary between the Model & View.
  - in PHP, they typically handle routing requests, retrieving data from the Model, and passing that data to the appropriate View
  - It's responsible for:
    - receiving inputs from the user (via the View) & processing the data (e.g. input validation, querying the DB)
    - deciding what View to render (e.g. based on the results of the data processing / DB query)

### Sign-up Process File Structure

MVC is typically used with Classes but we will use Functions here (since we're yet to cover Classes).

We'll have the following files in our `/includes` directory:

- `signup.inc.php` - called when the form is submitted via POST request, will call MVC functions appropriately.
- `signup_model.inc.php` - functions that will query/insert/mutate data in the DB
- `signup_view.inc.php` - functions that will render the View based on the inputs given
- `signup_contr.inc.php` - functions that will validate user inputs & interact with the model

## Error Handling

### Input Validation

It's important that input validation occurs on the server-side. We can check for many things, for example in the context of the sign-up process:

- the user has entered something in each of the required fields
- the username is not already taken
- the email is given in a valid format
- the email is not already in use

The previously mentioned examples are the ones we implement, however you could check many more things, e.g.:

- password complexity - that the password contains certain characters & is of a certain length
- user does not exceed the max length permitted for username / email

These validations are defined as functions in `signup_contr.inc.php`, which are then called in `signup.inc.php`. When performing the above validations, for each validation test that the input fails, we can accumulate the errors into an associative array - where the key identifies the error type and the value is a message that we can display to the user.

### Returning Errors & Displaying Them in the Client via Session Variables

Once the inputs are validated, we can check if the array contains errors. If there are errors, to make them available to the client, we can assign the error messages (associative array) to `$_SESSION["errors_signup"]`.

To display the errors, we write a function in `signup_view.inc.php` that will check for errors in `$_SESSION["errors_signup"]`. If there are errors, we iterate `$_SESSION["errors_signup"]` & output the HTML that will render each error. This function is called from the `signup.php` page once the user has been redirected back after a failed form submission.

> NOTE: when you're done with a `$_SESSION` Variable it is a good practice to `unset()` it; e.g. `unset($_SESSION["errors_signup"])`

### Preserving User Input After a Failed Form Submission

When the user is redirected back to the signup form, the inputs will be cleared. However, this creates a bad UX as the user has to re-enter fields, even those that were VALID! It would be much better if we can preserve their input after a form submission.

This can be done with another View function - like we did above when rendering errors. Every time there is an error, we also want to store the user input (excluding the password for security reasons) as a `$_SESSION` Variable - `$_SESSION["signup_form_data"]`.

From here we can extract the responsibility of rendering the signup form inputs into a View function. This function will only return an input value if the value was ENTERED & it is VALID, otherwise the input is cleared and an error message will be shown by the function outlined [here](###-Returning-Errors-&-Displaying-Them-in-the-Client-via-Session-Variables).

To determine whether to return the input value, the `renderSignupInputs` View function will check if:

- Value entered by user AND value was successfully validated -> preserve input
  - i.e. return the HTML input with the value the user entered
- Value not entered by user OR value failed validation -> clear input
  - i.e. return the HTML input without a value

Checking if an input value was entered is done by testing `$_SESSION["signup_form_data"]["<input_name>"]`.

Checking if an input validation error occurred is done by testing `$_SESSION["errors_signup"][<error_name>]`.

### Inserting the User into the DB (and Dependency Injection)

After the data is successfully validated, we want to store the user in the DB. The function responsible for this is defined in `signup_model.inc.php`; we named it `insertUser`. In order to invoke this `insertUser` (by the design of MVC) we have to go through the controller - so we define `createUser()` in `signup_contr.inc.php` which simply calls `insertUser` model function & passes it the user input & `PDO` connection.

As we have explored many times before, the `insertUser` model function will:

- define an insert user query
- create a prepared statement (using the query) to prevent SQL injection
- hash the user password: `password_hash($pwd, PASSWORD_BCRYPT, ["cost" => 12])` - where cost helps to slow down brute force attacks
- bind the user input values to the queries positional/named parameters
- execute the query
- if it fails an error message is displayed (via echo);

#### Dependency Injection

> One key thing here, is that we're not simply requiring/including the DB connection,as it is already imported once in `signup.inc.php` - so we don't want to unnecessarily open more connections. Instead we pass `$pdo` (the `PDO` instance) as an argument to `createUser` (controller fn) and forward `$pdo` once more to `insertUser` (model function). Funnelling/drilling the DB connection like this is known as Dependency Injection, where the `PDO` connection is a dependency existing outside of the functions.

### Displaying a success message via URL Query Parameter & Session Variables

Once the user is successfully added to the database, it is a good idea to inform the user that they're registration was successful. We can use URL Query Params to indicate a success "status". Query params can be set upon redirect via the `header()` function - i.e. like so: `header("Location: ../index.php?signup=success")`.

In order to render the success message we can revisit our error checking function `checkSignupErrors`. Once this function is called, we can be sure that we have been redirected to home. So in `checkSignupErrors` (View function), we can add another conditional check:

- if `isset($_GET["signup"])` AND `$_GET["signup"] === "success"` -> render a `"Signup was successful"` feedback message to the user.

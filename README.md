### Objective

Your assignment is to implement a restaurant REST API using PHP and Laravel.

### Brief

Frogo Baggins, a hobbit from the Shire, has a great idea. He wants to build a restaurant that serves traditional dishes from the world of Middle Earth. The restaurant will be called "The Dancing Pony" and will have a cozy atmosphere.

Frogo has hired you to build the website for his restaurant. As payment, he has offered you either a chest of gold or a ring. Choose wisely.

### Tasks

-   Implement assignment using:
    -   Language: **PHP**
    -   Framework: **Laravel**
-   Implement a REST API returning JSON
-   Implement a custom user model with a "nickname" field
-   Implement a dish model. Each dish should have a name, description, image, and price.
    -   Choose the appropriate data type for each field
    -   Add validation to the dish model fields to ensure that the name and description fields are unique
-   Provide an endpoint to authenticate with the API using username, password and return a JWT
-   Provide REST resources for the authenticated user for the Dish resource
    -   Implement the following CRUD (Create, Read, Update, Delete) operations for this resource:
        -   **Create**: Allow authenticated users to create new dishes
        -   **Read**: Allow authenticated users to view details of specific dishes, as well as a list of dishes
            -   Make the List resource searchable with query parameters
            -   Implement pagination for the /dishes resource. Allow users to set a limit and offset for the number of dishes returned in the response
        -   **Update**: Allow authenticated users to update dishes
        -   **Delete**: Allow authenticated users to delete dishes
    -   Implement an endpoint to rate a dish (POST)
        -   Store the rating on the Dish model
    -   Implement rate limiting for the /dishes resource to prevent abuse

### Evaluation Criteria

-   **PHP** best practices
-   Make sure that users can only rate dishes once
-   Bonus: Make sure the user _Sméagol_ is unable to rate any dish at "The Dancing Pony"
-   Bonus: Write an API test for the rating endpoint

### CodeSubmit

Please organize, design, test, and document your code as if it were going into production - then push your changes to the master branch. After you have pushed your code, you may submit the assignment on the assignment page.

Best of luck, and happy coding!

The Userdoc Team
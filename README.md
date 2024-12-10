# Object-oriented-Programming-in-PHP
### **Task Description**

For this task, you need to create a `Connection` class that defines properties for connecting to a database: `host`, `user`, `password`, `database`, and `port`. Then, create a method that uses these properties to establish a connection to the database and returns the connection string. You can choose whether to use PDO or the object-oriented MySQLi approach for interacting with the database.

After the first class, create a `User` class with the following properties: `id`, `first_name`, `last_name`, `email`, `password`, `birthday`, and `status`. This class should use the `Connection` class, specifically its connection string, to interact with the database.

---

### **The `User` Class Requirements:**
The class must include:
1. **A constructor**.  
2. **A method to retrieve all user data**.  
3. **A method to retrieve the user's first name and last name**.  
4. **A method to retrieve the user's email**.  
5. **A method to retrieve the user's ID**.  
6. **A method to retrieve any specific user data using method parameters**.  
7. **A method to return a boolean value indicating whether the user is an adult or a minor**.  
8. **A method to add a new user using method parameters**.  
9. **A method to update an existing user using method parameters**.  
10. **A method to change the status of an existing user using method parameters**.

---

### **Additional Instructions:**
- After creating the class, instantiate an object of the class.  
- Call all the methods on the object and display the results on the page.  
- No styling of the output is required, as it is not the focus of this course.  

---

### **Database Setup:**
This assignment requires creating a database along with a table based on the defined parameters in the `Connection` class and the fields from the `User` class. Specifically, there should be a database with a table named `user` that includes the following fields: `id`, `first_name`, `last_name`, `email`, `password`, `birthday`, and `status`. This setup is necessary for all methods in the `User` class, whether for retrieving, adding, updating, or changing user status.

---

### **Notes:**
1. **Using Method Parameters**:  
   This means that the method should have input parameters that determine its behavior.

2. **Changing User Status**:  
   This method allows converting a regular user into an administrator or vice versa, as well as deactivating a user account. It works by changing the user status in the database, where each status has a specific meaning:  
   - `0` – Deleted user  
   - `1` – Deactivated user  
   - `2` – Blocked user  
   - `3` – Regular user  
   - `4` – Administrator  

   Whenever a functionality is accessed in the application, the user status is checked to determine whether the user has permission to access that feature (usually done at the beginning of a PHP file).  

3. **Object-Oriented Approach**:  
   You cannot use procedural MySQLi to connect to the database, as this task focuses on object-oriented programming.  

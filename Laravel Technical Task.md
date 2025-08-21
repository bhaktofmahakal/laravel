# **Short Technical Task:**

**Objective:**

Build a small Laravel application to manage a Recycling Facility Directory stored in a MySQL database. You can use any GenAI tools to accomplish the functionality, however you should be able to explain the code.

The application should:

1. Allow adding, editing, and deleting facilities via a web form.  
2. List facilities in a paginated table with search bar (search by name or city or material). A sort by last update date feature should also be included.  
3. Allow filtering by materials accepted.  
4. Show a facility detail page displaying all its information as well as a google maps embed (based on the address)

**Instructions:**

1. Set up Laravel project with MySQL as database  
2. Create 2 tables with the following columns and data type  
   1. `facilities`  
      1. id (PK)  
      2. business\_name (string)  
      3. last\_update\_date (date)  
      4. street\_address (string)  
   2. `materials`  
      1. id (PK)  
      2. name (string)

Pivot table: `facility_material` (for many-to-many relationship)

3. Index page: Paginated table showing facility name, last update date, and materials accepted.  
4. Add/Edit facility form: With validation (e.g., name required, last update must be a valid date).  
5. Delete facility option.  
6. Facility detail page showing full info and related materials.  
7. Filter by material: Dropdown on the index page to show only facilities accepting that material. Include a Button on the index page to download the currently filtered results as a CSV file.

**Table Format Example:**

| Business Name | Last Updated | Address | Materials Accepted |
| :---- | :---- | :---- | :---- |
| Green Earth Recyclers | 2023-11-04 | 123 5th Ave, New York, NY 10001 | Computers, Smartphones, Lithium-ion Batteries, AA Batteries |

 

**Submission Instructions:**

1. Submit a Github link to your project in the response box of internshala  
2. Include a README describing:  
   1. Your approach to database design and relationships  
   2. How you implemented search, filter, sort, and export.  
   3. Any extra features added.

 

**Bonus Task (Optional):**

\-       Add authentication so only logged-in users can access page 


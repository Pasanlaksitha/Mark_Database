# Student Marks Management System 
## Overview (University Project - UoW)
The Student Marks Management System is a web-based application designed to manage and retrieve student marks data from a database. It allows users to input a student ID and select a specific week to retrieve and display the corresponding marks for that student. Additionally, the system calculates and displays the rank of the student for the selected week based on their marks.

## Features
+ Retrieve Student Marks: Users can enter a student ID and select a week to view the marks for that student.
+ Display Rank: The system calculates and displays the rank of the student for the selected week based on their marks.
+ User-Friendly Interface: The web interface provides an intuitive and easy-to-use experience for users to interact with the system.

## Technologies Used
+ Frontend: HTML, CSS
+ Backend: PHP
+ Database: MySQL
+ Web Server: Apache (XAMPP)

## Installation
Clone the repository to your local machine:

```bash
git clone https://github.com/yourusername/student-marks-management.git
```
Import the database schema (student_mark_db.sql) into your MySQL database.

Modify the database connection parameters in index.php to match your local environment:


```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_mark_db";
```

Start your local web server (e.g., XAMPP) and open the project in your web browser.


---
## Usage
Open the web application in your browser.

Enter a student ID in the input field provided.

Select the desired week from the dropdown menu.

Click the "Submit" button to retrieve and display the student's marks for the selected week.




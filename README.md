
📐 Interactive 3D Geometry Learning System

A PHP-based educational platform designed to guide users through the mathematics of 3D shapes. The system tracks individual progress through levels and steps, offering a structured mix of theory and practice.

🚀 Key Features

Multi-Level Curriculum**: The application is divided into three primary levels: Cube (Level 1), Cylinder (Level 2), and Cone (Level 3).


Structured 5-Step Learning Path:
1. Theory: Detailed descriptions and formulas for each shape.
2. User Input: Interactive forms for users to enter their own dimensions.
3. Automatic Calculation: Real-time processing of Area and Volume based on user data.
4. Practice Challenge: Randomly generated dimensions for the user to solve.
5. Validation: Automated checking of answers with instant feedback and database progress updates.


Progress Persistence: User status (current level, step, and completion) is saved in a MySQL database.

Role-Based Access: Features a secure login system for standard users and a dedicated administrative interface.

Certification: Automatic redirection to a certificate page upon successful completion of all levels.



🛠️ Tech Stack

 
Backend: PHP 8.2 using procedural logic and session management.


Database: MySQL / MariaDB for relational data storage.
 
Frontend: HTML5 and CSS3 with a clean, responsive interface.

Security: Implementation of `password_verify()` for secure authentication and Prepared Statements to prevent SQL injection.



📂 Project Structure

 
`index.php`: The entry point for authentication and session initialization.
 
`functions.php`: Core logic handling database updates and geometric definitions.

`step1.php` – `step5.php`: The sequential stages of the learning module.
 
`database.php`: Configuration for the MySQL connection.


`php.sql`: Full database schema and seed data.
 
`logout.php`: Secure session termination.



🔧 Installation

1. Clone the repository** to your local server environment (e.g., XAMPP or WAMP).
2. Import the database**: Execute the `php.sql` file in your MySQL manager (e.g., phpMyAdmin).
3. Configure Connection: Update database.php with your local database credentials.
4. Launch: Access the project via localhost in your web browser.


4. Launch: Access the project via `localhost` in your web browser.

🔑 Test Credentials

The system includes pre-configured accounts for testing purposes:

Standard User: `natan` / `natan123`
Admin: `admin` / `admin`

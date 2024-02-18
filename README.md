# Sistematis - CodeIgniter

aplikasi sistematis (web based) dan basic API

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/UserGhost411/sistematis-web-remaster
    ```

2. **Navigate to the project directory:**
    ```bash
    cd sistematis-web-remaster
    ```

3. **Import the database:**
    - Make sure you have a MySQL database server installed and running.
    - Use your preferred MySQL database management tool (e.g., phpMyAdmin) to create a new database.
    - Import the `sistematis_new.sql` file located in the root directory of this project into your newly created database.

4. **Configure the database connection:**
    - Open the `application/config/database.php` file.
    - Update the database settings (hostname, username, password, database) to match your MySQL database configuration.

5. **Run the application:**
    - Make sure you have PHP installed on your system.
    - Use a local development server (e.g., Apache, Nginx) or PHP's built-in server to run the application.
    - Navigate to the project directory and start the PHP server:
      ```bash
      php -S localhost:8000
      ```
    - or copy directory to your dev enviroment like xampp htdocs or else....

6. **Access the application:**
   - Open your web browser and navigate to localhost using the port that you have configured for the application.

## Notes

- The `sistematis_new.sql` file in the root directory contains a backup of the database used by this application. You need to import this file into your MySQL database before running the application.
- Make sure to configure the database connection in the `application/config/database.php` file before running the application.
- there 3 login account on backup db
  
| username | password | description |
|---|---|---|
| admin | 123 | Administrator Access Privileges |
| tester | 123 | Employee Access Privileges |
| vendor | 123 | Vendor Access Privileges |

## License

This project is licensed under the [MIT License](LICENSE).

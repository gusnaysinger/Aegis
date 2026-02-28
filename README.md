# Aegis

## Overview

**Aegis** is a secure and private file management and sharing system designed for intranet and internal network environments. It provides controlled file storage and distribution with a strong focus on security, access control, and data integrity.

The system is self-hosted and intended for organizations or teams that require internal file sharing without relying on external cloud services. Aegis ensures that all data remains within the local infrastructure, reducing exposure to external threats.

**Demonstration**
(static/image/ApresentaoAegis.gif)

---

## Development Status

**Aegis is currently under active development.**
New features, security enhancements, and performance improvements are continuously being implemented. Some functionalities and internal implementations may change as the project evolves.

---

## Features

* Secure authentication and session-based access control
* Permission-based file upload and download
* Server-side file storage with restricted public access
* Input validation and sanitization
* Designed for intranet and private network usage
* Lightweight and easy to maintain

---

## Tech Stack

Aegis is built using a simple and reliable technology stack focused on performance, security, and ease of maintenance in internal environments.

### Backend

* **PHP** – Core server-side logic, authentication, session handling, and file management
* **MySQL / MariaDB** – Storage for user accounts, permissions, and file metadata
* **Python** – Zip files

### Frontend

* **HTML5** – Application structure and layout
* **CSS3 / Bootstrap** – Responsive and consistent user interface
* **JavaScript** – Client-side interactions and form handling

### Server & Infrastructure

* **Apache or Nginx** – Web server
* **Local / Intranet Hosting** – Optimized for internal deployment

### Version Control

* **Git** – Source code management

---

## Security Considerations

Security is a core principle of Aegis and is addressed at multiple layers of the system.

### Authentication & Sessions

* Session-based authentication with protected routes
* Access to system features requires a valid authenticated session

### Password Handling

* Passwords are hashed using industry-standard algorithms (e.g., `password_hash`)
* Password verification is handled securely on the server side

### File Security

* Uploaded files are stored outside public web directories
* File names are sanitized and randomized to prevent overwriting and execution
* File type and size validation is enforced before storage

### Input Validation

* All user input is validated and sanitized
* Prepared statements are used to prevent SQL Injection
* Protection against common vulnerabilities such as XSS and directory traversal

### Access Control

* Permission-based authorization for file access and system actions
* Unauthorized users cannot list, download, or manage protected files

### Environment Isolation

* Designed exclusively for intranet usage
* No dependency on third-party cloud services
* Reduced external attack surface by limiting network exposure

---

## Purpose

Aegis was created to provide a secure, reliable, and controlled internal file-sharing solution. It is ideal for environments where data privacy, internal control, and system ownership are critical requirements.

---

## Database Setup

Aegis requires a MySQL or MariaDB database to store user accounts and file metadata.
Follow the steps below to create and configure the database manually.

1. Create the Database

Create a new database named aegis:

```
CREATE DATABASE aegis CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE aegis;
```

2. Create the users Table

This table stores user authentication data.

```
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    lvl INT(11) NOT NULL,
    PRIMARY KEY (id)
);
```

Field description:

id – Unique user identifier

nome – Username

senha – Hashed password (password_hash)

lvl – Permission or access level

3. Create the files Table

This table stores file metadata and access relationships.

```
CREATE TABLE files (
    id INT(11) NOT NULL AUTO_INCREMENT,
    filename VARCHAR(255) DEFAULT NULL,
    original_name VARCHAR(255) DEFAULT NULL,
    sender_id INT(11) DEFAULT NULL,
    recipient_id INT(11) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
```

Field description:

id – Unique file identifier

filename – Stored file name on the server (randomized)

original_name – Original uploaded file name

sender_id – User ID who uploaded the file

recipient_id – User ID allowed to access the file

created_at – Upload timestamp

4. Database Connection

Make sure the database credentials are correctly configured in your PHP connection file (e.g. connection.php):

```
$host = "localhost";
$user = "root";
$password = "";
$database = "aegis";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
```

5. Initial User Creation

Passwords must always be stored hashed.
Example using PHP:

```
$hashedPassword = password_hash("your_password", PASSWORD_DEFAULT);
```


Insert the user into the database using prepared statements.
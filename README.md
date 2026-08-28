# ITST 302 — Student Registration System using Laravel

## 1. Project Title

**Student Registration System with Laravel Forms, Validation, and File Upload**

**Subject:** ITST 302 — Client-Server Technologies  
**Project:** Mini Project 03: Student Registration System with Laravel Forms, Validation, and File Upload  
**Course:** Bachelor of Science in Information Technology (BSIT)  

---

## 2. Introduction

### What is a Student Registration System?

A Student Registration System is a web-based application built to digitize and automate the student onboarding process. Developed using Laravel, MySQL, and Tailwind CSS, this application enables students to submit their personal, contact, and academic details, upload an official profile picture, and securely store validated information into a relational database.

### Purpose of a Student Registration System

The primary purpose of a Student Registration System is to replace paper-based registration workflows with a secure digital platform. By automating data collection, the system eliminates manual data entry errors, streamlines administrative processing, and ensures that student information is instantly normalized, organized, and accessible through dynamic profile views.

### Importance of Data Validation

Data validation is critical for maintaining application security, database integrity, and user experience:

* **Data Consistency & Standardization**: Enforces uniform formats across all database fields, such as auto-uppercasing student names, converting full middle names into standard initial format `A. (AGOJO)`, and restricting mobile numbers strictly to a 12-digit numeric constraint.
* **Prevention of Duplicate Entries**: Protects primary identification fields like `student_id` and `email` using database unique constraints to prevent accidental duplicate registrations.
* **File Upload Security**: Restricts profile picture uploads to supported image formats (`.jpg`, `.jpeg`, `.png`) with a 2 MB size ceiling, preventing unauthorized script execution and preserving server storage.
* **Error Prevention**: Catches invalid or missing user input at the server layer before reaching the MySQL layer, preventing system crashes and runtime SQL exceptions.

### Role of Registration Systems in Enterprise Applications

In enterprise application architecture, registration systems serve as the core entry point for identity management and user onboarding:

* **Central Point of Data Intake**: Foundational across multiple enterprise domains, including academic portals (student enrollment), corporate HR suites (employee onboarding), healthcare systems (patient registration), and banking platforms (KYC registration).
* **Enterprise Module Integration**: Feeds validated identity records into downstream organizational modules such as authentication systems, access control, billing, course scheduling, and analytics.
* **Regulatory & Audit Compliance**: Ensures that all collected data adheres strictly to organizational business logic, database structural standards, and privacy requirements right from the moment of intake.

---

## 3. Objectives

The primary objectives of this project are:

* Develop a responsive, modern student registration interface using Laravel Blade templates and Tailwind CSS.
* Process client HTTP requests using dedicated methods in `StudentController`.
* Implement robust server-side validation rules and data transformation logic (auto-uppercasing, custom middle name formatting, and 12-digit mobile constraints).
* Prevent duplicate entries using unique validation constraints on primary identifiers such as Student ID and Email.
* Process, validate, and securely store student profile pictures using Laravel Storage and public disk symbolic linking.
* Display dynamic field-level validation errors and flash notifications upon successful form submission.
* Format and store structured student records into a relational MySQL database schema.
* Display registered student details through a dynamic student profile view and a centralized student directory page.
* Understand and apply the Laravel Request Lifecycle during form submission and file handling.
* Apply version control practices using Git and GitHub following Conventional Commits.
* Document the complete software development process following enterprise documentation standards.

---

## 4. Laravel Request Lifecycle

The student registration process strictly follows the Laravel Request Lifecycle to handle HTTP requests, process input data, execute transformations, and return responses:

```text
Browser (User Submits Form)
          ↓
     Route (routes/web.php)
          ↓
  Controller (StudentController@store)
          ↓
Validation ($request->validate())
          ↓
    Model (Student::create())
          ↓
  Database (MySQL Insertion)
          ↓
   Response (Redirect with Flash)
          ↓
Browser (Renders Profile View)
```
### Process Explanation

1. **Browser**: The student completes the online registration form and submits it via an HTTP `POST` request to `/students`.
2. **Route**: The Laravel router (`routes/web.php`) intercepts the incoming `POST` request and delegates execution to `StudentController@store`.
3. **Controller**: The `StudentController` receives the incoming `Illuminate\Http\Request` object containing form inputs, dropdown selections, and the uploaded file payload.
4. **Validation**: The `$request->validate()` method executes server-side validation. If validation fails, Laravel interrupts execution and automatically redirects back to the form with saved input data and field error messages.
5. **Data Transformation & Model**: Upon validation success, name fields are transformed to uppercase, full middle names are formatted to `A. (FULLNAME)` format, and uploaded images are saved to `storage/app/public/profile_pictures`. The `Student` Eloquent model receives the sanitized payload array.
6. **Database**: The Eloquent ORM translates the model operation into a SQL `INSERT` query, writing the record to the `students` table in the MySQL database.
7. **Response**: The controller issues an HTTP redirect response to the student profile route (`students.show`), attaching a success session flash message (`Student registered successfully!`).
8. **Browser**: The client browser receives the redirect response, fetches the profile view, and renders the registered student details along with their uploaded profile picture.

### Laravel Request Lifecycle Diagram

![Laravel Request Lifecycle Diagram](week04-student-registration/documentation/Diagram.jpg)

---

## 5. Validation Rules

The Student Registration System enforces server-side validation using Laravel's built-in validation engine prior to processing database operations or storing uploaded files.

### Validation Matrix

| Field | Rule / Constraint | Description & Purpose |
| :--- | :--- | :--- |
| `student_id` | `required\|unique:students,student_id` | Prevents blank submissions and ensures no two students share the same institutional identification number. |
| `first_name` | `required\|string\|max:100` | Ensures student first name is present, textual, and strictly under 100 characters. |
| `middle_name` | `nullable\|string\|min:2\|max:100\|regex:/^[a-zA-Z\s]{2,}$/` | Optional field. Enforces a 2-character minimum and regex string check to reject single-letter initials (e.g., "A" or "A.") in favor of full middle names. |
| `last_name` | `required\|string\|max:100` | Requires student surname input within standard length constraints. |
| `suffix` | `nullable\|string\|max:10` | Optional selection (`JR.`, `SR.`, `I` – `VI`) to capture generational suffixes accurately. |
| `email` | `required\|email\|unique:students,email` | Validates standard RFC email syntax and prevents duplicate account registration under the same email address. |
| `mobile_number` | `required\|numeric\|digits_between:1,12` | Guarantees numeric-only input and limits total digits strictly to a maximum of 12 numbers. |
| `date_of_birth` | `required\|date` | Validates that the input adheres to a valid calendar date format. |
| `gender` | `required` | Ensures a gender selection is recorded from the form drop-down list. |
| `program` | `required` | Captures the enrolled degree program. |
| `year_level` | `required` | Captures academic year level (`1st Year` to `4th Year`). |
| `address` | `required\|string` | Collects complete physical residential location information. |
| `profile_picture` | `required\|image\|mimes:jpg,jpeg,png\|max:2048` | Restricts upload files strictly to valid image formats (`.jpg`, `.jpeg`, `.png`) with a maximum allowed file size of 2048 KB (2 MB). |

---

### Importance of Validation Rules

* **Required Field Validation**: Ensures completeness of student personnel files by rejecting incomplete web forms before SQL execution.
* **Unique Constraints**: Prevents data corruption and identity duplication across core system identifiers (`student_id` and `email`).
* **Format & Pattern Validation**: Enforces institutional naming rules (such as full middle name input over single initials) and clean digit-only phone records.
* **File Upload Constraints**: Protects application storage space, guards against malicious non-image file uploads (e.g., `.php` or executable scripts), and maintains web rendering performance.

---

## 6. Database Design

The system relies on a MySQL relational database named `week04_student_registration` with a single primary table named `students`.

### Table Schema: `students`

| Column | Data Type | Key / Constraint | Nullable | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | `BIGINT` | Primary Key, Auto Increment | No | Unique internal database record ID |
| `student_id` | `VARCHAR(255)` | Unique Index | No | Official student identification number |
| `first_name` | `VARCHAR(255)` | None | No | Student first name (stored in uppercase) |
| `middle_name` | `VARCHAR(255)` | None | Yes | Formatted middle name: `INITIAL. (FULLNAME)` |
| `last_name` | `VARCHAR(255)` | None | No | Student surname (stored in uppercase) |
| `suffix` | `VARCHAR(255)` | None | Yes | Generational name suffix (e.g., `JR.`, `III`) |
| `email` | `VARCHAR(255)` | Unique Index | No | Student email address |
| `mobile_number` | `VARCHAR(255)` | None | No | Numeric mobile number (max 12 digits) |
| `date_of_birth` | `DATE` | None | No | Birth date record |
| `gender` | `VARCHAR(255)` | None | No | Gender identity classification |
| `program` | `VARCHAR(255)` | None | No | Degree program / Academic major |
| `year_level` | `VARCHAR(255)` | None | No | Enrolled academic year |
| `address` | `TEXT` | None | No | Full residential address details |
| `profile_picture` | `VARCHAR(255)` | None | No | Public storage file path string for image |
| `created_at` | `TIMESTAMP` | None | Yes | Timestamp when the record was created |
| `updated_at` | `TIMESTAMP` | None | Yes | Timestamp when the record was last modified |

---

### Primary Key & Unique Constraints

* **Primary Key**: `id` serves as the surrogate primary key for unique row identification.
* **Unique Key 1**: `student_id` is indexed as unique to ensure institutional ID integrity.
* **Unique Key 2**: `email` is indexed as unique to prevent duplicate user account creation.

---

### Entity Relationship Diagram (ERD)

![Student Database ER Diagram](week04-student-registration/documentation/Database_ERD.png)

---

## 7. Registration Flowchart

The student registration process models the conditional execution logic enforced by Laravel upon form submission. The application validates input integrity, executes data normalization, handles profile image uploads, creates database records, and routes the user accordingly.

### Process Flow

```text
User Opens Registration Page
          ↓
     Fill Out Form
          ↓
   Submit Registration
          ↓
   Laravel Validation
          ↓
      Valid Data?
       ↙       ↘
     NO         YES
     ↓           ↓
Display Errors  Format Names & Upload Profile
                 ↓
           Save to Database
                 ↓
          Success Message
                 ↓
        Student Profile Page
```

### Flowchart 

![Flowchart](week04-student-registration/documentation/Flowchart.png)

---

## 8. Screenshots

### Registration Form

![Registration Form](week04-student-registration/screenshots/student-registration.png)

The registration form provides a responsive interface styled with Tailwind CSS where students enter personal details, contact information, academic choices, and upload an official profile picture.

---

### Validation Errors

![Validation Errors](week04-student-registration/screenshots/validation-errors.png)

The application enforces real-time server-side validation. If a submission fails (e.g., duplicate student ID, missing fields, single-letter middle names, or invalid image uploads), the form reloads with error messages highlighting the invalid inputs while retaining previous entries.

---

### Successful Registration & Flash Notification

![Successful Registration](week04-student-registration/screenshots/student-sucessfully-created.png)

Upon successful validation and insertion into the database, the controller redirects to the student profile showcase page accompanied by a success flash notification banner.

---

### Uploaded Profile Picture & Profile Showcase

![Uploaded Profile Picture](week04-student-registration/screenshots/Profile.png)

The student profile view renders the newly registered student's transformed data alongside their uploaded profile image retrieved via Laravel's public storage disk link.

---

### Student Directory Page

![Student Directory](week04-student-registration/screenshots/Student-list.png)

A dedicated database directory view listing all registered students in a formatted table with quick search capabilities, profile thumbnails, and direct links to individual profile cards.

---

### Database Table Records

![Database Records](week04-student-registration/screenshots/Database-sucessfully-working.png)

The underlying MySQL `students` table verifying that input formatting rules (auto-uppercasing and `A. (FULLNAME)` middle name transformation) were successfully executed before storage.

---

### VS Code Project Structure

![Project Structure](week04-student-registration/screenshots/Data-Structure.png)

The project directory structure in Visual Studio Code showing the organization of Controllers, Models, Blade views, Migrations, and documentation files.

---

### Terminal Execution & Server Output

![Terminal Output](week04-student-registration/screenshots/Artisan-serve.png)

The terminal output displaying active local development execution using `php artisan serve` alongside migration execution logs.

---

## 9. Problems Encountered

During the development and testing of the Student Registration System, three primary technical challenges were encountered:

### Problem 1 – Missing Database Schema Column Mismatch
When testing form submissions after adding the optional generational suffix field, the application threw a database exception:  
`SQLSTATE[42S22]: Column not found: 1054 Unknown column 'suffix' in 'field list'`.  
This occurred because the `suffix` field was implemented in the Blade template and controller validation logic before updating the database migration file.

### Problem 2 – Single-Letter Middle Initial Validation Failure
Allowing users to enter single-letter middle initials (e.g., "A" or "A.") caused logic failures in the server-side name normalization routine. The transformation code expected a complete middle name string (e.g., "Agojo") to extract both the leading initial and full uppercase text into the standard format `A. (AGOJO)`. Single-letter entries broke the string parsing logic and resulted in redundant outputs like `A. (A)`.

### Problem 3 – Profile Picture 404 Display Error (Missing Storage Link)
Although profile pictures were successfully validated and saved inside `storage/app/public/profile_pictures/`, the browser failed to display the uploaded images on the student profile page, returning broken image icons and 404 HTTP errors.

---

## 10. Solutions

The following technical solutions were implemented to resolve the encountered problems:

### Solution 1 – Schema Migration Update & Refresh
The database migration file (`database/migrations/xxxx_xx_xx_xxxxxx_create_students_table.php`) was updated to explicitly define the nullable `suffix` column:
```php
$table->string('suffix')->nullable();
```
The database schema was then synchronized with the updated controller attributes by re-running the migration command:
```Bash
php artisan migrate:fresh
```

### Solution 2 – Enforcing Minimum Length & Regex Validation Rules
To reject single-letter initial entries and require full middle names, a minimum length constraint (`min:2`) and a regular expression pattern (`regex:/^[a-zA-Z\s]{2,}$/`) were added to the `middle_name ` validation array in `StudentController.php`:
```PHP
'middle_name' => 'nullable|string|min:2|max:100|regex:/^[a-zA-Z\s]{2,}$/',
```

Custom validation error messages were also registered to provide clear user feedback:
```PHP
'middle_name.min'   => 'Please enter your full middle name, not a single letter initial.',
'middle_name.regex' => 'Middle name must contain at least two letters.',
```

### Solution 3 – Creating the Storage Symbolic Link
To expose files stored inside `storage/app/public` to the web server's public root, the Artisan storage link command was executed:
```Bash
php artisan storage:link
```

This established a symbolic link from `public/storage` to `storage/app/public`, enabling the application to render uploaded student profile pictures dynamically using:
```HTML
<img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile Picture">
```

---

## 11. Reflection

Developing the Student Registration System provided comprehensive practical experience in building secure, data-driven web applications using Laravel's MVC architecture. This activity demonstrated how client-side user interfaces, server-side processing, database persistence, and file management interface with one another within the Laravel request lifecycle.

### Importance of Data Validation
Data validation forms the foundation of robust web application development. Without strict validation, systems become highly vulnerable to corrupted database states, unauthorized script execution, and poor user experiences. In this project, validation rules ensured that every student record met administrative standards before reaching the database. Enforcing unique constraints on fields like Student ID and Email Address prevented identity collisions and duplicate records. Furthermore, enforcing specific format rules—such as restricting mobile numbers to 12 numeric digits and validating image extensions—guaranteed that incoming data cleanly matched expected schema definitions.

### Lessons Learned About Handling User Input
One of the core takeaways from this project is that end-user input must always be treated as untrusted and potentially malformed. Relying solely on users to enter standardized information often leads to inconsistent database records. Implementing custom data transformations in the controller layer solved this problem effectively. By automatically converting first and last names to uppercase, formatting full middle names into standardized `A. (AGOJO)` structures, and sanitizing input values, the application guarantees uniform, clean data persistence across all entries regardless of how the user originally typed them into the form.

### Benefits of Server-Side Validation Over Client-Side Validation
While client-side validation (such as HTML5 `required` attributes or JavaScript constraints) enhances user experience by offering instant feedback, it does not provide true application security. Client-side checks can easily be bypassed, modified, or disabled using browser developer tools or by executing custom HTTP requests directly to application endpoints. Server-side validation, implemented via Laravel's `$request->validate()` method, acts as an unbypassable gatekeeper. Because server-side validation executes entirely on the web server beyond the client's reach, it strictly guarantees that no invalid, missing, or malicious data can ever penetrate application logic or be written to the MySQL database.

### Importance of File Security in Web Applications
Allowing users to upload files to a web server introduces significant security vulnerabilities, such as malicious script uploads, executable payload execution, and server storage overflow. Restricting file uploads strictly to valid image types (`.jpg`, `.jpeg`, `.png`) and enforcing a 2 MB maximum file size limit ensures system stability and storage integrity. Furthermore, storing uploaded profile images inside `storage/app/public` rather than directly in the public web directory ensures that uploaded files are isolated from direct web execution. Utilizing `php artisan storage:link` creates a safe public access channel for displaying static images while keeping underlying application storage securely protected.

### How Registration Systems are Used in Real-World Enterprise Software
In enterprise software architecture, registration systems serve as the core entry gateway for digital identity management, user onboarding, and access control. Whether in academic institutions, healthcare networks, financial platforms, or corporate HR systems, registration modules capture initial user profiles that feed into downstream operational systems. The design patterns practiced in this project—such as form processing, server-side validation, relational database insertion, flash feedback, and media storage—represent fundamental capabilities required in enterprise-level software engineering.

---

## 12. References

Laravel. (n.d.). *Laravel documentation*. https://laravel.com/docs.

MDN Web Docs. (n.d.). *MDN Web Docs*. https://developer.mozilla.org/.

MySQL. (n.d.). *MySQL documentation*. https://dev.mysql.com/doc/.

PHP. (n.d.). *PHP documentation*. https://www.php.net/docs.php.

Tailwind CSS. (n.d.). *Tailwind CSS documentation*. https://tailwindcss.com/docs.

----

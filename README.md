# Student Registration System

## ITST 302 – Client-Server Technologies
**Course:** Bachelor of Science in Information Technology (BSIT) 
### Week 4 Laboratory Activity – Mini Project 03

A Laravel-based Student Registration System that enables students to register their information online, upload a profile picture, and securely store their information in a MySQL database

---

## 1. Introduction

The Student Registration System is a web application developed using Laravel, MySQL, and Tailwind CSS. The purpose of this system is to provide a digital registration process where students can submit their personal and academic information through an online form.

The system demonstrates client-server technology concepts, including Laravel Blade forms, HTTP request handling, robust server-side validation, database integration, flash messages, and file storage management.

To maintain strict data integrity and standardized database records, the system enforces custom business logic during data intake:
* **Name Normalization & Uppercasing**: Automatically converts student names to uppercase.
* **Middle Name Transformation**: Transforms full middle names into standard initial and full-text formats (e.g., `AGOJO` becomes `A. (AGOJO)`) while restricting single-letter initial entries.
* **Suffix Selection**: Provides an explicit selection list for student suffixes (`Jr.`, `Sr.`, `I` – `VI`).
* **Input Limits**: Restricts mobile number inputs strictly to a maximum of 12 digits.
* **File Validation**: Restricts profile picture uploads to supported image types (`.jpg`, `.jpeg`, `.png`) under 2 MB.

This project models registration workflows commonly implemented in real-world enterprise environments such as universities, corporate platforms, and government agencies.

---

## 2. Objectives

The objectives of this project are:

* Create a professional, responsive student registration form using Laravel Blade and Tailwind CSS.
* Process client requests using a Laravel controller.
* Implement custom server-side validation rules and data transformations.
* Prevent invalid and duplicate submissions through unique field constraints.
* Display field-level validation error messages dynamically.
* Display a success flash message upon successful registration.
* Process, validate, and securely store student profile pictures.
* Format and store standardized student information in a MySQL database.
* Display registered student information through a styled student profile view.
* Understand the Laravel request lifecycle in processing web requests.
* Practice version control using Git and GitHub.
* Document the full software development process.

---

## 3. System Features

The Student Registration System includes the following features:

### Student Registration

Students can submit the following information through the online form:

* Student ID (Unique)
* First Name (Auto-uppercased)
* Middle Name (Formatted to `A. (FULLNAME)` format; minimum 2 characters required)
* Last Name (Auto-uppercased)
* Suffix (Optional: `Jr.`, `Sr.`, `I` – `VI`)
* Email Address (Unique & valid format)
* Mobile Number (Numeric only, strictly limited to a maximum of 12 digits)
* Date of Birth
* Gender (`Male` / `Female`)
* Academic Program
* Year Level (`1st Year` – `4th Year`)
* Home Address
* Profile Picture Upload

### Data Normalization & Formatting

Before storing data in MySQL, the system performs server-side data transformation:
* **Automatic Uppercasing**: First Name, Last Name, and Suffix are automatically stored in uppercase.
* **Middle Name Formatting**: Full middle names (e.g., `Agojo`) are transformed to `A. (AGOJO)`. Single-character entries (e.g., `A` or `A.`) are rejected by validation.

### Server-Side Validation

The system validates all submitted input before database insertion:

* Required field verification
* Unique Student ID check
* Unique Email Address check
* Mobile number numeric check and 12-digit length restriction
* Minimum 2-character middle name validation rule
* Valid Date of Birth check
* Image file validation (JPG, JPEG, PNG format support with a maximum file size of 2 MB)

### File Upload & Storage

Students can upload a profile picture during registration. Uploaded images are stored securely within the public storage directory using Laravel Storage and linked for web access via `php artisan storage:link`.

### Flash Notifications & Profile Showcase

* **Flash Message**: Displays a success notification upon registration (`Student registered successfully!`).
* **Profile Page**: Displays the newly registered student's details formatted inside a dark-themed profile card alongside their uploaded profile picture.

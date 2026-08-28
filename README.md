# Student Registration System

## ITST 302 – Client-Server Technologies
**Course:** Bachelor of Science in Information Technology (BSIT) 
### Week 4 Laboratory Activity – Mini Project 03

A Laravel-based Student Registration System that enables students to register their information online, upload a profile picture, and securely store their information in a MySQL database[cite: 1].

---

## 1. Introduction

The Student Registration System is a web application developed using Laravel, MySQL, and Tailwind CSS[cite: 1]. The purpose of this system is to provide a digital registration process where students can submit their personal and academic information through an online form[cite: 1].

The system demonstrates client-server technology concepts, including Laravel Blade forms, HTTP request handling, robust server-side validation, database integration, flash messages, and file storage management[cite: 1].

To maintain strict data integrity and standardized database records, the system enforces custom business logic during data intake:
* **Name Normalization & Uppercasing**: Automatically converts student names to uppercase.
* **Middle Name Transformation**: Transforms full middle names into standard initial and full-text formats (e.g., `AGOJO` becomes `A. (AGOJO)`) while restricting single-letter initial entries.
* **Suffix Selection**: Provides an explicit selection list for student suffixes (`Jr.`, `Sr.`, `I` – `VI`).
* **Input Limits**: Restricts mobile number inputs strictly to a maximum of 12 digits.
* **File Validation**: Restricts profile picture uploads to supported image types (`.jpg`, `.jpeg`, `.png`) under 2 MB[cite: 1].

This project models registration workflows commonly implemented in real-world enterprise environments such as universities, corporate platforms, and government agencies[cite: 1].

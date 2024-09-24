# crud-api
# CRUD API Documentation

## Overview

This is a simple CRUD (Create, Read, Update, Delete) API designed to manage student records. It allows users to create new student entries, retrieve existing records, update them, and delete records as needed. The API is built using PHP and MySQL.

## Features

- **Create**: Add a new student record.
- **Read**: Retrieve student details.
- **Update**: Modify existing student information.
- **Delete**: Remove a student record.

## Technologies Used

- **PHP**: Backend scripting language.
- **MySQL**: Database to store student records.
- **JSON**: Data format for API responses and requests.

## Endpoints

### 1. Create a Student

- **URL**: `/api/students`
- **Method**: `POST`
- **Request Body**:
    ```json
    {
        "sname": "John Doe",
        "srole": "Student",
        "scity": "New York",
        "sstate": "NY",
        "snumber": "1234567890",
        "semail": "john.doe@example.com"
    }
    ```
- **Response**:
    - Success:
        ```json
        {
            "Code": "200",
            "status": "successful",
            "student": {
                "id": 1,
                "student_name": "John Doe",
                ...
            }
        }
        ```
    - Error:
        ```json
        {
            "Code": "400",
            "status": "unsuccessful",
            "message": "Email already exists."
        }
        ```

### 2. Read a Student

- **URL**: `/api/students/{id}`
- **Method**: `GET`
- **Response**:
    - Success:
        ```json
        {
            "Code": "200",
            "status": "successful",
            "student": {
                "id": 1,
                "student_name": "John Doe",
                ...
            }
        }
        ```
    - Error:
        ```json
        {
            "Code": "404",
            "status": "unsuccessful",
            "message": "Student not found."
        }
        ```

### 3. Update a Student

- **URL**: `/api/students/{id}`
- **Method**: `PUT`
- **Request Body**:
    ```json
    {
        "sname": "John Doe Updated",
        "srole": "Student",
        "scity": "Los Angeles",
        "sstate": "CA",
        "snumber": "0987654321",
        "semail": "john.doe@example.com"
    }
    ```
- **Response**:
    - Success:
        ```json
        {
            "Code": "200",
            "status": "successful",
            "message": "Student record updated."
        }
        ```
    - Error:
        ```json
        {
            "Code": "400",
            "status": "unsuccessful",
            "message": "An error occurred."
        }
        ```

### 4. Delete a Student

- **URL**: `/api/students/{id}`
- **Method**: `DELETE`
- **Response**:
    - Success:
        ```json
        {
            "Code": "200",
            "status": "successful",
            "message": "Student record deleted."
        }
        ```
    - Error:
        ```json
        {
            "Code": "404",
            "status": "unsuccessful",
            "message": "Student not found."
        }
        ```

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/crud-api.git

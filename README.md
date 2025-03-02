# KUTAK DOBRE HRANE - Restaurant Reservation and Ordering System

## Project Overview
"Kutak Dobre Hrane" is a web-based system designed for managing reservations in restaurants and food ordering for home delivery. The system caters to three types of users: Restaurant Guests, Waiters, and Administrators.

This project is implemented as part of the Internet Programming course at the University of Belgrade, Faculty of Electrical Engineering.

## Features

### 1. User Types
- **Restaurant Guest**: Can register, make reservations, order food for delivery, and manage their profile.
- **Waiter**: Manages restaurant orders and reservations.
- **Administrator**: Reviews guest registration requests, manages the waiter list, and oversees the entire system.

### 2. Registration and Login
- Users must register and log in with their credentials (username and password).
- Administrators have a separate login page, not publicly visible.

### 3. Password Security
- Passwords are validated using regular expressions (min 6 characters, max 10 characters, including uppercase, lowercase, digits, and special characters).
- Passwords are stored securely in the database, encrypted.

### 4. Profile Management
- Guests can view and update their profile (name, address, email, phone, credit card number, profile picture).
- Profile pictures are uploaded via a file upload system with validation for size and format.

### 5. Restaurant Listings
- Guests and administrators can view a list of available restaurants, which can be searched and sorted by name, address, and type.
- Each restaurant's page includes detailed information like address, phone number, reviews, and a dynamic map of the location.

### 6. Reservation System
- Guests can reserve tables at restaurants for a 3-hour duration.
- Guests receive detailed validation messages if a reservation is not available.

### 7. Food Ordering
- Guests can view restaurant menus, select food items, and place delivery orders to their home address.
- A shopping cart system is used for managing and finalizing orders.

### 8. Feedback and Rating System
- After dining, guests can leave ratings and comments for the restaurants they visited.
- Guests can view their past reservations and orders in the "Archive".

### 9. Waiter Management
- Waiters can manage reservations, orders, and handle customer requests.

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript (for validation and interactivity)
- **Backend**: PHP, MySQL (for database management)

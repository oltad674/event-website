# Event Management System

A web-based Event Management System that allows admins and organizers to manage events efficiently. It features user authentication, event creation/editing, and role-based dashboards.

---

## Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Usage](#usage)

---

## Features

### User Registration and Login
- Users can register by providing a username, password, and selecting a role (admin or organizer).  
- After logging in, users are redirected to their respective dashboards.

### Role-Based Dashboards
- Admins and organizers each access a personalized dashboard.  
- Each dashboard shows a list of events and provides role-specific options for management.

### Event Management
- Add new events with a title, description, location, and date.  
- Edit or delete existing events.  
- View event details individually.  
- All changes are reflected dynamically in the events list.

### Event Display
- The events page displays all available events fetched from the database.  
- Each event includes basic information and a *“View Details”* button to see more.

### Consistent and Reusable UI
- Shared header.php and footer.php files are used across pages for consistency and easy navigation.  
- styles.css manages the visual layout.

---

## Technologies Used
- *Frontend:* HTML, CSS  
- *Backend:* PHP  
- *Database:* MySQL  
- *Assets:* Image files for event visuals

---

## Project Structure
project1/
├── index.php # Homepage
├── login.php / register.php
├── admin_dashboard.php / organizer_dashboard.php

├── add_event.php / edit_event.php / delete_event.php
├── events.php / eventdetails.php
├── header.php / footer.php
├── styles.css
├── image/ # Image assets

---

## Installation
1. Clone the repository:
git clone https://github.com/oltad674/event-website.git
2.	Move the project folder to your local server directory (e.g., htdocs for XAMPP).
3.	Create a MySQL database and import the database schema.
4.	Update the database connection settings in your PHP files.
5.	Start your local server and navigate to http://localhost/project1/.
   
---


Usage
	•	Register as an admin or organizer.
	•	Login to access your dashboard.
	•	Add, edit, delete, or view events according to your role.
	•	Navigate through the consistent UI with the header and footer links.

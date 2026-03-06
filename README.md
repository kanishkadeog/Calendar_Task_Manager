## Calendar Task Manager – (PHP + MySQL + JS + TailwindCSS)

A fully functional Google-Calendar-style Task Manager built using pure PHP, MySQL, Vanilla JavaScript, and TailwindCSS.
The system allows users to add, edit, delete, filter, and update tasks using a calendar UI.

The project is fully deployed on InfinityFree including:
- Frontend UI
- Backend APIs
- MySQL database hosted on InfinityFree hosting

---

## 🚀 Live Demo (InfinityFree Deployment)

 Frontend + Backend + Database (Single deployment under htdocs)
https://kanishkadeogade.infinityfreeapp.com/
---

## 📁 Project Features
 1. Google Calendar Style UI

- Switch between previous/next months

- Highlight today

- Click any date → Load tasks for that date

 2. Task CRUD (Create, Read, Update, Delete)

- Add task with title, description, due date, priority, category

- Edit a task

- Delete a task

- Toggle task status (Pending ↔ Completed)

 3. Filters

- Filter by category, priority, status

- Search tasks by title

 4. AJAX-Based Operations

No page refresh anywhere — everything uses:

fetch() + PHP API + JSON responses

 5. Clean Architecture
📦 project
 ┣ 📂 api
 ┃ ┣ add_task.php
 ┃ ┣ update_task.php
 ┃ ┣ delete_task.php
 ┃ ┣ toggle_status.php
 ┃ ┗ get_tasks.php
 ┣ 📂 js
 ┃ ┣ calendar.js
 ┃ ┗ tasks.js
 ┣ 📂 css
 ┃ ┗ custom.css
 ┣ config.php
 ┣ db.php
 ┣ index.php
 ┗ database.sql

---

## 🛠️ Tech Stack
Frontend

- HTML5

- TailwindCSS

- JavaScript (Vanilla)

- AJAX / fetch API

Backend

- PHP (with PDO)

- REST-like API endpoints

Database

- MySQL (InfinityFree Control Panel)

---

## 🔌 API Endpoints
➕ Add Task — POST /api/add_task.php
📝 Update Task — POST /api/update_task.php
❌ Delete Task — POST /api/delete_task.php
🔄 Toggle Status — POST /api/toggle_status.php
📅 Get Tasks — GET /api/get_tasks.php?date=YYYY-MM-DD
🔍 Filters —

GET /api/get_tasks.php?filter=1&priority=high&category=work&search=text

---

## 🗄️ Database Schema
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE NOT NULL,
    priority ENUM('low','medium','high') DEFAULT 'medium',
    category VARCHAR(100) DEFAULT 'General',
    status ENUM('pending','completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

---

## 🌐 Deployment Notes (InfinityFree)
✔ Uploaded all project files into /htdocs
✔ Created MySQL DB from control panel
✔ Imported database.sql through phpMyAdmin
✔ Connected using:
$host = "sql102.infinityfree.com";
$user = "if0_40506907";
$pass = "Mayuri56";
$dbname = "if0_40506907_task_manager";

✔ Works fully online with AJAX + PHP APIs + MySQL
---

## 📸 Screenshots

(Add screenshots section here once you upload images.)

<img width="1914" height="939" alt="image" src="https://github.com/user-attachments/assets/ca9a6aeb-e8d7-46ba-a8b1-1e78d413309a" />

<img width="1907" height="958" alt="image" src="https://github.com/user-attachments/assets/37dad579-c6cf-4b48-abc1-84690e7ad18c" />

<img width="1919" height="937" alt="image" src="https://github.com/user-attachments/assets/c651f229-fc68-492a-adec-27d42a23c536" />

After applying filter

<img width="1914" height="938" alt="image" src="https://github.com/user-attachments/assets/96ce8edc-46ed-4d3b-93ac-2e2e90a29eba" />

<img width="1898" height="866" alt="image" src="https://github.com/user-attachments/assets/88c9a470-4a16-47c9-8e18-9ba859519041" />



---

## 🧪 How to Run Locally
1. Clone repo
git clone <repo-url>

2. Import database
database.sql → phpMyAdmin

3. Update config.php with your local DB credentials
4. Start PHP server
php -S localhost:8000

##  Future Improvements

- User authentication

- Google Calendar API sync

- Drag & drop tasks

- Weekly view mode

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Note:- The site mite not work if it was not in use ....

Got a mail from infinityfree :-
"Hi,
Your InfinityFree account if0_40506907 (Website for kanishkadeogade.infinityfreeapp.com) has just been deleted.
The account has been suspended for inactivity since 2026-01-29. To make room for new accounts, we automatically deleted inactive accounts after some time.
When an account is deleted, all files, databases, settings and all other contents have been completely and permanently removed from our systems. Any domain names previously assigned to the hosting account have also been removed, and can now be used on other hosting accounts.
Because the account is fully deleted, it is no longer possible to reactivate it or recover data from it.
If you want to host a website with us again, please don't hesitate to create a new hosting account from your client area."

---------
So Follow the below step:- 

Backend (PHP API) → InfinityFree
Database (MySQL) → InfinityFree
Frontend (HTML + JS) → InfinityFree

1. Create InfinityFree Account
Visit: https://infinityfree.net
Click:
➡ “Sign Up” / “Sign In”
➡ Create account
➡ Verify email

3. Create a new Hosting Account
After login:
➡ Click Client Area
➡ Click Create Account
➡ Password: create your own
➡ Choose a free subdomain: yourproject.infinityfreeapp.com (https://kanishkadeogade.infinityfreeapp.com/)
➡ Click Create

4. Open Control Panel → Create MySQL Database
Go to Control Panel (cPanel)
Inside search → type :- MySQL Databases.

Create:
- Database Name: task_manager
- Database Username: auto-generated
- Database Password: create your own
- Database Hostname: something like

 $host = "sql102.infinityfree.com";
$user = "if0_40506907";
$pass = "Mayuri56";
$dbname = "if0_40506907_task_manager";) - copy it You will need them

- ✳ InfinityFree gives you all four values.
You must use these in config.php.

4. Open phpMyAdmin & Import SQL
In cPanel → Search “phpMyAdmin”.
Open → Select your database → Click “Import”.
- Upload your file: database.sql
Click Go.

Your table tasks is now created.

5. Prepare Your Backend Folder
Create a folder like this locally:
backend/
    api/
        add_task.php
        delete_task.php
        update_task.php
        toggle_status.php
        get_tasks.php
    config.php
    db.php
    index.php
    custom.css

6. Update config.php for InfinityFree MySQL
Your config.php must be:
"
<?php
$host = "sql102.infinityfree.com";       // InfinityFree MySQL hostname
$user = "if0_40506907";                 // InfinityFree MySQL user
$pass = "Mayuri56";                    // InfinityFree MySQL password
$dbname = "if0_40506907_task_manager"; // Your DB name
?>
"
Replace with your actual values.


7. Upload Backend Files by File Manager
Go to InfinityFree Control Panel
➡ Open File Manager
➡ Go to htdocs/
➡ Upload your entire backend + frontend files/folder contents.

Folder structure on the server:
 htdocs/
     api/
        add_task.php
        update_task.php
        delete_task.php
        toggle_status.php
        get_tasks.php
    js/
        calendar.js
        tasks.js
    css/
        custom.css
    config.php
    db.php
    index.php

....
update git file 

Refresh the page and wait for sometime
click your website;- https://kanishkadeogade.infinityfreeapp.com/


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

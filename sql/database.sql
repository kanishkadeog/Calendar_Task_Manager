-- CREATE DATABASE calendar_tasks;
-- USE calendar_tasks;
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

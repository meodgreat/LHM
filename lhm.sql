CREATE DATABASE IF NOT EXISTS lhm_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lhm_db;

-- Administrative Users
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Blog Posts Table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    summary TEXT NOT NULL,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255) NOT NULL,
    gallery TEXT DEFAULT NULL,
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insert a default administrator account 
-- Username: admin | Password: Password123!
INSERT INTO admins (username, password) 
VALUES ('admin', '$2y$10$wIq6VwshL7G8Y0gI1e0Xv.C.l2B1Y5vVv8D5v3X0vE2Vv4Vv5vVv.')
ON DUPLICATE KEY UPDATE id=id;













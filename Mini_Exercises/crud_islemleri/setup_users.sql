-- Create users table if it doesn't exist
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (username: admin, password: admin123)
-- Note: In production, you should use a stronger password
INSERT INTO users (username, password) 
VALUES ('admin', 'Erkan12051205?')
ON DUPLICATE KEY UPDATE username=username; 
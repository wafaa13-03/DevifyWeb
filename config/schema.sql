CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') NOT NULL DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE project_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    budget VARCHAR(120) DEFAULT NULL,
    timeline VARCHAR(120) DEFAULT NULL,
    details TEXT NOT NULL,
    status VARCHAR(60) NOT NULL DEFAULT 'Submitted',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@devify.com', '$2y$12$I1Oo3ZmGLPGOg7sqIeB8uesATmDDAcTnWB/DvvLKMzDIZBKsOBZ2.', 'admin');

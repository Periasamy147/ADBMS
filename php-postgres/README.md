To Run:
php -S localhost:2500

Database:
Users:
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX users_email_key ON users (email);
CREATE UNIQUE INDEX users_username_key ON users (username);


Notes:
CREATE TABLE notes (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE notes ADD CONSTRAINT notes_user_id_fkey
    FOREIGN KEY (user_id)
    REFERENCES users(id);

Database:
mydb

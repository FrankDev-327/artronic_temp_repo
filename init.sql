-- Create the books table if it does not exist
CREATE TABLE IF NOT EXISTS books (
  id CHAR(36) PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  publisher VARCHAR(255) NOT NULL
);

-- Create the users table if it does not exist
CREATE TABLE IF NOT EXISTS users (
  id CHAR(36) PRIMARY KEY,
  name VARCHAR(255),
  lastName VARCHAR(255),
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  book_id CHAR(36),
  FOREIGN KEY (book_id) REFERENCES books(id)
);

-- Check if admin_user exists in users table and insert if not
CREATE DEFINER=`root`@`%` PROCEDURE `users_test`.`InsertAdminUser`()
BEGIN
    DECLARE userCount INT;

    SELECT COUNT(*) INTO userCount FROM users WHERE email = 'admin_user@gmail.com';

    -- SHA1 is used as MySQL doesn't have built-in bcrypt
    IF userCount = 0 THEN
        INSERT INTO users (id, name, lastName, email, password)
        VALUES (
            UUID(),
            'admin_user',
            'admin_user',
            'admin_user@gmail.com', 
            SHA1('123456789')
        );
    END IF;
END

CREATE TABLE `profiles`(
                          id INT AUTO_INCREMENT,
                          user_id INT NOT NULL UNIQUE,
                          first_name VARCHAR(50),
                          last_name VARCHAR(50),
                          email VARCHAR(50),
                          phone VARCHAR(15),
                          gender VARCHAR(1),
                          birthday DATE,
                          PRIMARY KEY(id),
                          FOREIGN KEY (user_id) REFERENCES users(id),
                          FOREIGN KEY (email) REFERENCES users(email)
)

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `birthday`)
VALUES (NULL, '16', 'Freelancer', 'Active', NULL, '6941231231', 'M', '1998-11-13');
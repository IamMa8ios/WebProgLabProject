CREATE TABLE `profiles`(
                           id INT AUTO_INCREMENT,
                           userID INT NOT NULL,
                           name VARCHAR(50),
                           birthday DATE,
                           phone INT(12),
                           country VARCHAR(50),
                           email VARCHAR(50),
                           job VARCHAR(50),
                           website VARCHAR(50),
                           PRIMARY KEY(id),
                           FOREIGN KEY(userID) REFERENCES users(id)
);

CREATE TABLE skills(
                       id INT AUTO_INCREMENT,
                       userID INT NOT NULL,
                       skill1 VARCHAR(25),
                       value1 INT,
                       skill2 VARCHAR(25),
                       value2 INT,
                       skill3 VARCHAR(25),
                       value3 INT,
                       skill4 VARCHAR(25),
                       value4 INT,
                       PRIMARY KEY(id),
                       FOREIGN KEY(userID) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
                       UNIQUE (userID)
)
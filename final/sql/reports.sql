CREATE TABLE reported_users(
                               id INT AUTO_INCREMENT,
                               userID INT NOT NULL,
                               `status` VARCHAR(20),
                               date_reported DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
                               PRIMARY KEY(id),
                               FOREIGN KEY(userID) REFERENCES users(id)
)

SELECT `u`.`username` AS `User`, COUNT(`ru`.`id`) AS `Reports`
FROM `reported_users` AS `ru`, `users` AS `u`
WHERE `ru`.`userID`=`u`.`id`
GROUP BY(`userID`)
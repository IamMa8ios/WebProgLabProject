CREATE TABLE reported_users(
                               id INT AUTO_INCREMENT,
                               userID INT NOT NULL,
                               last_report DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
                               PRIMARY KEY(id),
                               FOREIGN KEY(userID) REFERENCES users(id)
)

SELECT `u`.`username` AS `User`, COUNT(`ru`.`id`) AS `Reports`
FROM `reported_users` AS `ru`, `users` AS `u`
WHERE `ru`.`userID`=`u`.`id`
GROUP BY(`userID`)
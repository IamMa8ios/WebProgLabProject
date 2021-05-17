CREATE TABLE polls
(
    id     INT AUTO_INCREMENT,
    title  VARCHAR(255) NOT NULL,
    status VARCHAR(10) DEFAULT 'Open',
    date_created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id)
);


CREATE TABLE poll_options
(
    id      INT AUTO_INCREMENT,
    pollID INT NOT NULL,
    value   VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (pollID) REFERENCES polls (id)
)
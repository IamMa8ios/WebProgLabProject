CREATE TABLE applications(
                             id INT AUTO_INCREMENT,
                             applicantID INT NOT NULL,
                             posterID INT NOT NULL,
                             listingID INT NOT NULL,
                             application_date DATETIME DEFAULT CURRENT_TIMESTAMP() NOT NULL,
                             PRIMARY KEY(id),
                             FOREIGN KEY(applicantID) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
                             FOREIGN KEY(posterID) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
                             FOREIGN KEY(listingID) REFERENCES listings(id) ON UPDATE CASCADE ON DELETE CASCADE,
                             UNIQUE(applicantID, posterID, listingID)
)
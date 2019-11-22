/*
 * Authors: Shayna Jamieson, Keller Flint, Bridget Black
 * 2019-11-09
 * Last Updated: 2019-11-12
 * Version 1.0
 * File name: create_tables.sql
 */

CREATE TABLE User
(
    user_id          INT          NOT NULL AUTO_INCREMENT,
    user_first       VARCHAR(255) NULL,
    user_last        VARCHAR(255) NULL,
    user_email       VARCHAR(255) NULL,
    user_phone       VARCHAR(255) NULL,
    user_date_joined DATETIME     NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE Dreamer
(
    dreamer_id              INT          NOT NULL AUTO_INCREMENT,
    user_id                 INT          NOT NULL,
    dreamer_college         VARCHAR(255) NULL,
    dreamer_date_of_birth   DATE         NULL,
    dreamer_graduation_date YEAR         NULL,
    dreamer_gender          VARCHAR(255) NULL,
    dreamer_ethnicity       VARCHAR(255) NULL,
    dreamer_food            VARCHAR(255) NULL,
    dreamer_goals           TEXT         NULL,
    dreamer_active          VARCHAR(255) NULL,
    dreamer_notes           TEXT         NULL,

    PRIMARY KEY (dreamer_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Volunteer
(
    volunteer_id               INT          NOT NULL AUTO_INCREMENT,
    user_id                    INT          NOT NULL,
    volunteer_verified         TINYINT      NULL,
    volunteer_street_address   VARCHAR(255) NULL,
    volunteer_zip              INT          NULL,
    volunteer_city             VARCHAR(255) NULL,
    volunteer_state            VARCHAR(255) NULL,
    volunteer_tshirt_size      VARCHAR(255) NULL,
    volunteer_about_us         TEXT         NULL,
    volunteer_interest_other   TEXT         NULL,
    volunteer_availability     TEXT         NULL,
    volunteer_motivated        TEXT         NULL,
    volunteer_experience       TEXT         NULL,
    volunteer_youth_experience TEXT         NULL,
    volunteer_skills           TEXT         NULL,
    volunteer_emailing         TINYINT      NULL,
    volunteer_status           VARCHAR(255) NULL,
    volunteer_notes            TEXT         NULL,

    PRIMARY KEY (volunteer_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Contact
(
    contact_id           INT          NOT NULL AUTO_INCREMENT,
    user_id              INT          NOT NULL,
    contact_phone        VARCHAR(255) NULL,
    contact_email        VARCHAR(255) NULL,
    contact_relationship VARCHAR(255) NULL,
    contact_name         VARCHAR(255) NULL,
    contact_type         VARCHAR(255) NULL,

    PRIMARY KEY (contact_id),
    FOREIGN KEY (user_id) references User (user_id)
);

CREATE TABLE Interest
(
    interest_id               INT          NOT NULL AUTO_INCREMENT,
    interest_name_of_interest VARCHAR(255) NOT NULL,

    PRIMARY KEY (interest_id)
);

CREATE TABLE Volunteer_Interest
(
    volunteer_id INT NOT NULL,
    interest_id  INT NOT NULL,

    PRIMARY KEY (volunteer_id, interest_id),
    FOREIGN KEY (volunteer_id) REFERENCES Volunteer (volunteer_id),
    FOREIGN KEY (interest_id) REFERENCES Interest (interest_id)
);

CREATE TABLE Chapter
(
    chapter_id       INT          NOT NULL AUTO_INCREMENT,
    chapter_location VARCHAR(255) NULL,

    PRIMARY KEY (chapter_id)
);

CREATE TABLE User_Chapter
(
    user_id    INT NOT NULL,
    chapter_id INT NOT NULL,

    PRIMARY KEY (user_id, chapter_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id),
    FOREIGN KEY (chapter_id) REFERENCES Chapter (chapter_id)
);

/* Insert Interests for volunteers */
INSERT INTO Interest
VALUES (1, "Events/Activities");
INSERT INTO Interest
VALUES (2, "Fundraising");
INSERT INTO Interest
VALUES (3, "Newsletter Production");
INSERT INTO Interest
VALUES (4, "Volunteer Coordination");
INSERT INTO Interest
VALUES (5, "Mentoring");


/* Insert sample data for volunteers */
INSERT INTO User VALUES(default, 'Keller', 'Flint', 'kflint0068@gmail.com', '2534411380', now());
INSERT INTO Dreamer VALUES(1, 1, 'Keller College', '2007/01/01', '2019', 'Male', 'Keller Ethnicity', 'Pretzel', 'No goals', 'active', 'No notes');

INSERT INTO User VALUES(default, 'Shayna', 'Jamieson', 'jamieson.shayna@gmail.com', '2532136729', now());
INSERT INTO Dreamer VALUES(2, 2, 'Shayna College', '2007/02/01', '2019', 'Female', 'Shayna Ethnicity', 'Saltine', 'No goals', 'active', 'No notes');

INSERT INTO User VALUES(default, 'Bridget', 'Black', 'bridget@beeze.com', '5037987921', now());
INSERT INTO Dreamer VALUES(3, 3, 'Bridget College', '2007/03/01', '2019', 'Female', 'Bridget Ethnicity', 'Cheeze It', 'No goals', 'inactive', 'No notes');

/* Insert sample data for volunteers */
INSERT INTO User VALUES(default, 'Vol-Keller', 'Vol-Flint', 'Vol-kflint0068@gmail.com', '2534411380', now());
INSERT INTO Volunteer VALUES(1, 4, 1, '2222 Second St', 98188, 'Kent', 'WA', 'medium', 'About Keller', 'Interests Other Keller', 'Availability Keller', 'Motivated Keller', 'Volunteer Experience Keller', 'Youth Experience Keller', 'Skills Keller', 1, 'active', 'No notes Keller');

INSERT INTO User VALUES(default, 'Vol-Shayna', 'Vol-Jamieson', 'Vol-jamieson.shayna@gmail.com', '2532136729', now());
INSERT INTO Volunteer VALUES(2, 5, 1, '3333 Third St', 98188, 'De Moines', 'WA', 'medium', 'About Shayna', 'Interests Other Shayna', 'Availability Shayna', 'Motivated Shayna', 'Volunteer Experience Shayna', 'Youth Experience Shayna', 'Skills Shayna', 1, 'inactive', 'No notes Shayna');

INSERT INTO User VALUES(default, 'Vol-Bridget', 'Vol-Black', 'Vol-bridget@beeze.com', '5037987921', now());
INSERT INTO Volunteer VALUES(3, 6, 0, '0000 Zero St', 98188, 'SeaTac', 'WA', 'medium', 'About Bridget', 'Interests Other Bridget', 'Availability Bridget', 'Motivated Bridget', 'Volunteer Experience Bridget', 'Youth Experience Bridget', 'Skills Bridget', 0, 'pending', 'No notes Bridget');

/* Insert sample data for volunteers */
INSERT INTO Contact VALUES(1, 1, '425-222-2222', 'contact@email.com', 'contact relationship', 'contact name', 'guardian');

INSERT INTO Contact VALUES(2, 3, '503-777-7777', 'contact@email.com', 'contact relationship', 'contact name', 'guardian');

INSERT INTO Contact VALUES(3, 4, '425-222-1111', 'contact1@email.com', 'contact1 relationship', 'contact1 name', 'reference');
INSERT INTO Contact VALUES(4, 4, '425-222-3333', 'contact2@email.com', 'contact2 relationship', 'contact2 name', 'reference');
INSERT INTO Contact VALUES(5, 4, '425-222-3333', 'contact3@email.com', 'contact3 relationship', 'contact3 name', 'reference');
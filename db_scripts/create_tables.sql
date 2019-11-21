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


/**
 * @author Shayna Jamieson
 * @author Keller Flint
 * @author Bridget Black
 * @version 1.0
 * 2019-11-09
 * Last Updated: 2019-12-09
 * File name: db_schema.sql
 * Associated Files:
 *      admin_page.php
 *      volunteer_form.php
 *      youth_form.php
 *
 * Description:
 *      This file contains tables for iD.A.Y.Dream Youth Organization's database. Table interactions are as such:
 *      All organization member's basic information is stored in the User table.
 *      Volunteers are Users with additional volunteer specific data, stored in the Volunteer table.
 *      Dreamers are Users with additional dreamer specific data, stored in the dreamer table.
 *      Contacts are either of type 'Reference' (tied to volunteers) or of type 'Guardian' (tied to dreamers).
 *          Volunteers have 3 references (required).
 *          Dreamers have 1 guardian (1 required).
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
    dreamer_graduation_year YEAR         NULL,
    dreamer_gender          VARCHAR(255) NULL,
    dreamer_ethnicity       VARCHAR(255) NULL,
    dreamer_food            VARCHAR(255) NULL,
    dreamer_goals           TEXT         NULL,
    dreamer_status          VARCHAR(255) NULL,
    dreamer_notes           TEXT         NULL,

    PRIMARY KEY (dreamer_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Volunteer
(
    volunteer_id               INT          NOT NULL AUTO_INCREMENT,
    user_id                    INT          NOT NULL,
    volunteer_verified         VARCHAR(255) NULL,
    volunteer_street_address   VARCHAR(255) NULL,
    volunteer_zip              INT          NULL,
    volunteer_city             VARCHAR(255) NULL,
    volunteer_state            VARCHAR(255) NULL,
    volunteer_tshirt_size      VARCHAR(255) NULL,
    volunteer_about_us         TEXT         NULL,
    volunteer_interest         TEXT         NULL,
    volunteer_relocating       VARCHAR(3)   NULL,
    volunteer_minimum          VARCHAR(3)   NULL,
    volunteer_annual           VARCHAR(3)   NULL,
    volunteer_availability     TEXT         NULL,
    volunteer_motivated        TEXT         NULL,
    volunteer_experience       TEXT         NULL,
    volunteer_youth_experience TEXT         NULL,
    volunteer_skills           TEXT         NULL,
--     volunteer_emailing         VARCHAR(255) NULL,
-- hiding the emailing list right now per Sprint 4 feedback
    volunteer_status           VARCHAR(255) NULL,
    volunteer_notes            TEXT         NULL,
    volunteer_consent          VARCHAR(3)   NULL,

    PRIMARY KEY (volunteer_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Contact
(
    contact_id           INT          NOT NULL AUTO_INCREMENT,
    user_id              INT          NOT NULL,
    contact_name         VARCHAR(255) NULL,
    contact_relationship VARCHAR(255) NULL,
    contact_email        VARCHAR(255) NULL,
    contact_phone        VARCHAR(255) NULL,
    contact_type         VARCHAR(255) NULL,

    PRIMARY KEY (contact_id),
    FOREIGN KEY (user_id) references User (user_id)
);

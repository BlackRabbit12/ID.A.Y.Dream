/**
 * @author Shayna Jamieson
 * @author Keller Flint
 * @author Bridget Black
 * @version 1.0
 * 2019-11-09
 * Last Updated: 2019-12-08
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
 *      Interest are the type of volunteer work a volunteer would like to do for the organization. Options include but
 *          are not limited to: 'Activities/Events', 'Fundraising', 'Other'.
 *      Volunteer_Interest is a linking table to allow one volunteer to have many interest (one-to-many).
 *
 *      ******Currently Unused:
 *      Chapter table will allow Admin to send pertinent information to appropriate volunteers and dreamers when
 *          sending 'newsletters', 'emails', 'etc'.
 *      User_Chapter is a linking table to allow one volunteer to belong to many chapters (one-to-many).
 *
 *      There are 'Interest' descriptions to match interest_id, this allows many interests to be added or deleted for
 *          future management. (order corresponds to order listed in volunteer_form.php.
 *
 *      TODO Delete Sample Data When Live:
 *      Sample Users, Volunteers, Dreamers, Contacts are added for testing purposes only.
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
    volunteer_availability     TEXT         NULL,
    volunteer_motivated        TEXT         NULL,
    volunteer_experience       TEXT         NULL,
    volunteer_youth_experience TEXT         NULL,
    volunteer_skills           TEXT         NULL,
--     volunteer_emailing         VARCHAR(255) NULL,
-- hiding the emailing list right now per Sprint 4 feedback
    volunteer_status           VARCHAR(255) NULL,
    volunteer_notes            TEXT         NULL,

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


/* Insert sample data for dreamers */
INSERT INTO User
VALUES (default, 'Keller', 'Flint', 'kflint0068@gmail.com', '2534411380', now());
INSERT INTO Dreamer
VALUES (1, 1, 'Green River College', '2007/01/01', '2019', 'Male', 'White non-Hispanic', 'Pretzel', 'Be a teacher',
        'pending', 'Funny guy');

INSERT INTO User
VALUES (default, 'Shayna', 'Jamieson', 'jamieson.shayna@gmail.com', '2532136729', now());
INSERT INTO Dreamer
VALUES (2, 2, 'Highline College', '2007/02/01', '2019', 'Female', 'Bi/Multiracial', 'Saltine',
        'Live in the countryside with a ton of animals', 'pending', 'Loves animals');

INSERT INTO User
VALUES (default, 'Bridget', 'Black', 'bridget@beeze.com', '5037987921', now());
INSERT INTO Dreamer
VALUES (3, 3, 'Portland Community College', '2007/03/01', '2021', 'Female', 'White non-Hispanic', 'Cheeze It',
        'have the best ratio of happiness to work', 'pending', 'Hates shrimp');

INSERT INTO User
VALUES (default, 'Jane', 'Doe', 'rielysblackcats@yahoo.com', '5032222222', now());
INSERT INTO Dreamer
VALUES (4, 4, 'Green River College', '2007/04/01', '2021', 'Prefer Not to Say', 'Prefer Not to Say', 'Sour Patch Kids',
        'No goals', 'inactive', 'No notes');

INSERT INTO User
VALUES (default, 'Erin', 'Fonz', 'bsblack12@gmail.com', '5033333333', now());
INSERT INTO Dreamer
VALUES (5, 5, 'UW Seattle, UW Tacoma', '2007/05/01', '2019', 'Other', 'White non-Hispanic', 'Hummus and cucumber',
        'get monies', 'inactive', 'Allergic to shellfish');

INSERT INTO User
VALUES (default, 'Erin', 'Zane', 'rielysblackcats@yahoo.com', '5037878787', now());
INSERT INTO Dreamer
VALUES (6, 6, 'none', '2007/06/01', '2021', 'Female', 'Native Hawaiian or Other Pacific Islander', 'Chips and Salsa',
        'Be happy', 'inactive', 'Not available on second Thursday of each month');

/* Insert sample data for volunteers */
INSERT INTO User
VALUES (default, 'Brie', 'Larson', 'opSuperHuman@gmail.com', '2534418050', now());
INSERT INTO Volunteer
VALUES (1, 7, 'yes', '785 E St', 98188, 'Kent', 'WA', 'medium', 'I heard about you from a flier', 'Liaison', 'Weekends',
        'Enjoy working with at risk youth', 'Volunteer for after school programs for kids',
        'Works with kids in after school programs', 'Good with teaching kids', 'active', 'No Notes');

INSERT INTO User
VALUES (default, 'Jackie', 'Daniels', 'notYourBestDay@gmail.com', '2539654123', now());
INSERT INTO Volunteer
VALUES (2, 8, 'yes', '9615 L St', 98188, 'Kent', 'WA', 'xLarge', 'I heard about you from a friend',
        'I want to partner with ID.A.Y.Dream', 'Summer Camp only', 'Want to make a difference in the community', 'None',
        'None', 'No skills', 'inactive', 'Allergic to peanuts');

INSERT INTO User
VALUES (default, 'Hermione', 'Granger', 'bsblack12@gmail.com', '5037987651', now());
INSERT INTO Volunteer
VALUES (3, 9, 'yes', '3333 Third St', 98188, 'De Moines', 'WA', 'large', 'I was a dreamer',
        'Writing newsletter if it is online', 'Weekends', 'Want to help kids achieve their goals',
        'Worked with college level students as tutor', 'None', 'Experience with writing newsletters', 'inactive',
        'No notes');

INSERT INTO User
VALUES (default, 'Grace', 'Hopper', 'bridget@beeze.com', '2537418569', now());
INSERT INTO Volunteer
VALUES (4, 10, 'no', '8569 L Ave', 98188, 'Kent', 'WA', 'medium',
        'I heard about you from a coworker who has a kid in the program', 'Unsure', 'Unsure', 'Love helping kids',
        'Volunteer chaperon', 'Chaperon youth events', 'Chaperon experience', 'pending',
        'Only available summer');

INSERT INTO User
VALUES (default, 'Carie', 'Fisher', 'layaWasABoss@beeze.com', '5037987921', now());
INSERT INTO Volunteer
VALUES (5, 11, 'no', '0000 Zero St', 98188, 'SeaTac', 'WA', 'medium',
        'I heard about you from another youth organization function', 'Unsure', 'Weekends', 'Enjoy volunteering',
        'Volunteer for Marion County Search and Rescue', 'None', 'No skills added', 'pending', 'No notes');

INSERT INTO User
VALUES (default, 'Happy', 'Dad', 'best_dad_44@gmail.com', '2537985489', now());
INSERT INTO Volunteer
VALUES (6, 12, 'yes', '4523 H St', 98188, 'Kent', 'WA', 'small', 'My kid is a dreamer, I would like to help them',
        'None', 'Every weekend, any events my kid signs up for', 'My kid is a dreamer', 'None', 'None', 'yes',
        'active', 'Allergic to cats');

/* Insert sample data for contacts */
INSERT INTO Contact
VALUES (1, 1, 'Lynda Flint', 'Mother', 'jamieson.shayna@gmail.com', '425-222-2222', 'guardian');

INSERT INTO Contact
VALUES (2, 2, 'Anne Jamieson', 'mom', 'bridget@beeze.com', '503-777-7777', 'guardian');

INSERT INTO Contact
VALUES (3, 3, 'Tuna Ostrander', 'step mom', 'kflint0068@gmail.com', '503-798-7921', 'guardian');

INSERT INTO Contact
VALUES (4, 4, 'Jay', 'dad', 'contact4@email.com', '503-777-3333', 'guardian');

INSERT INTO Contact
VALUES (5, 5, 'Hermin Grenn', 'step-dad', 'bridget@beeze.com', '503-777-6666', 'guardian');

INSERT INTO Contact
VALUES (6, 6, 'Doreen', 'my mom', 'kflint0068@gmail.com', '503-888-7977', 'guardian');

INSERT INTO Contact
VALUES (7, 7, 'Emma', 'Friend', 'bridget@beeze.com', '425-222-1111', 'reference');
INSERT INTO Contact
VALUES (8, 7, 'Mya', 'Coworker', 'bridget@beeze.com',  '425-222-3333','reference');
INSERT INTO Contact
VALUES (9, 7, 'Aaron', 'Cousin', 'jamieson.shayna@gmail.com', '425-222-3333', 'reference');

INSERT INTO Contact
VALUES (10, 8, 'Emma', 'Friend', 'contact1@email.com', '425-222-1111', 'reference');
INSERT INTO Contact
VALUES (11, 8, 'Rose', 'Friend', 'jamieson.shayna@gmail.com', '425-222-3333', 'reference');
INSERT INTO Contact
VALUES (12, 8, 'Aurora', 'Coworker', 'kflint0068@gmail.com', '425-222-3333', 'reference');

INSERT INTO Contact
VALUES (13, 9, 'Ava', 'Aunt', 'kflint0068@gmail.com', '425-222-1111', 'reference');
INSERT INTO Contact
VALUES (14, 9, 'Novah', 'Friend', 'contact2@email.com', '425-222-3333', 'reference');
INSERT INTO Contact
VALUES (15, 9, 'Olivia', 'Sister', 'contact3@email.com', '425-222-3333', 'reference');

INSERT INTO Contact
VALUES (16, 10, 'Archie', 'Coworker', 'bridget@beeze.com', '425-222-1111', 'reference');
INSERT INTO Contact
VALUES (17, 10, 'Aaron', 'Friend', 'jamieson.shayna@gmail.com', '425-222-3333', 'reference');
INSERT INTO Contact
VALUES (18, 10, 'Erin', 'Friend', 'contact3@email.com', '425-222-3333', 'reference');

INSERT INTO Contact
VALUES (19, 11, 'Evelyn', 'Friend', 'contact1@email.com',  '425-222-1111','reference');
INSERT INTO Contact
VALUES (20, 11, 'Mia', 'Friend', 'kflint0068@gmail.com', '425-222-3333', 'reference');
INSERT INTO Contact
VALUES (21, 11, 'Liam', 'Brother', 'contact3@email.com', '425-222-3333', 'reference');

INSERT INTO Contact
VALUES (22, 12, 'Noah', 'Friend', 'jamieson.shayna@gmail.com', '425-222-1111', 'reference');
INSERT INTO Contact
VALUES (23, 12, 'Benjamin', 'Coworker', 'kflint0068@gmail.com', '425-222-3333', 'reference');
INSERT INTO Contact
VALUES (24, 12, 'Logan', 'Coworker', 'contact3@email.com', '425-222-3333', 'reference');

CREATE TABLE User
(
    user_id    INT          NOT NULL AUTO_INCREMENT,
    user_first VARCHAR(255) NOT NULL,
    user_last  VARCHAR(255) NOT NULL,
    user_phone INT          NOT NULL,
    user_email VARCHAR(255) NOT NULL,

    PRIMARY KEY (user_id)
);

CREATE TABLE Dreamer
(
    dreamer_id              INT          NOT NULL AUTO_INCREMENT,
    dreamer_college         VARCHAR(255),
    dreamer_date_of_birth   DATE         NOT NULL,
    dreamer_graduation_date DATE         NOT NULL,
    dreamer_ethnicity       VARCHAR(255) NOT NULL,
    dreamer_food            VARCHAR(255),
    dreamer_goals           TEXT,
    dreamer_active          TINYINT      NOT NULL,
    user_id                 INT          NOT NULL,

    PRIMARY KEY (dreamer_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE ICE
(
    ICE_id           INT          NOT NULL AUTO_INCREMENT,
    ICE_name         VARCHAR(255) NOT NULL,
    ICE_phone        INT          NOT NULL,
    ICE_relationship VARCHAR(255) NOT NULL,

    PRIMARY KEY (ICE_id)
);

CREATE TABLE Dreamer_ICE
(
    dreamer_id INT NOT NULL,
    ICE_id     INT NOT NULL,

    PRIMARY KEY (dreamer_id, ICE_id),
    FOREIGN KEY (dreamer_id) REFERENCES Dreamer (dreamer_id),
    FOREIGN KEY (ICE_id) REFERENCES ICE (ICE_id)
);

CREATE TABLE Volunteer
(
    volunteer_id                   INT          NOT NULL AUTO_INCREMENT,
    volunteer_verified             TINYINT      NOT NULL,
    volunteer_street_address       VARCHAR(255) NOT NULL,
    volunteer_zip                  INT          NOT NULL,
    volunteer_city                 VARCHAR(255) NOT NULL,
    volunteer_state                VARCHAR(255) NOT NULL,
    volunteer_tshirt_size          VARCHAR(255) NOT NULL,
    volunteer_about_us             TEXT,
    volunteer_motivated            TEXT         NOT NULL,
    volunteer_volunteer_experience TEXT,
    volunteer_dreamer_experience   TEXT,
    volunteer_skills               TEXT,
    volunteer_emailing             TINYINT      NOT NULL,
    volunteer_active               TINYINT      NOT NULL,
    user_id                        INT          NOT NULL,

    PRIMARY KEY (volunteer_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE Reference
(
    reference_id           INT          NOT NULL AUTO_INCREMENT,
    reference_phone        INT          NOT NULL,
    reference_email        VARCHAR(255) NOT NULL,
    reference_relationship VARCHAR(255) NOT NULL,
    reference_name         VARCHAR(255) NOT NULL,

    PRIMARY KEY (reference_id)
);

CREATE TABLE Volunteer_Reference
(
    volunteer_id INT NOT NULL,
    reference_id INT NOT NULL,

    PRIMARY KEY (volunteer_id, reference_id),
    FOREIGN KEY (volunteer_id) REFERENCES Volunteer (volunteer_id),
    FOREIGN KEY (reference_id) REFERENCES Reference (reference_id)
);

CREATE TABLE Interest
(
    interest_id               INT NOT NULL AUTO_INCREMENT,
    interest_name_of_interest VARCHAR(255),

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
    chapter_location VARCHAR(255) NOT NULL,
    user_id          INT          NOT NULL,

    PRIMARY KEY (chapter_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id)
);

CREATE TABLE User_Chapter
(
    user_id    INT NOT NULL,
    chapter_id INT NOT NULL,

    PRIMARY KEY (user_id, chapter_id),
    FOREIGN KEY (user_id) REFERENCES User (user_id),
    FOREIGN KEY (chapter_id) REFERENCES Chapter (chapter_id)
);
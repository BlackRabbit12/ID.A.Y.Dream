# :blue_heart: iD.A.Y.Dream :blue_heart: #
iD.A.Y.Dream is a non-profit Youth Organization that focuses on helping at risk youth self-actualize, to become their potentialities, through strong community bonds and resources. For more information about, or to become part of, the organization and the communities they are helping, please visit [idaydream.org](https://www.idaydream.org/).

## Authors
* Keller Flint-Blanchard - Github: https://github.com/kellerflint :trollface:
* Shayna Jamieson - Github: https://github.com/jamiesonshayna :sparkles:
* Bridget Black - Github: https://github.com/BlackRabbit12 :rabbit2:

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes only, you will not have access to iD.A.Y.Dream's internal database or organization details.
See deployment for notes on how to deploy a skeleton version of the project on a live system.

<details>
  <summary><strong>Prerequisite</strong></summary>
    <p>What things you need to install the software and how to install them:

```
IDE of chice (we used PhpStorm)
Docker (optional)
Server (remote host)
```
</p>
</details>

<details>
  <summary><strong>Installing</strong></summary>
    <p>This is a step by step that tells you how to get a development enviroment running on your local machine:

```
Step 1:  Install necessary applications
Step 2:  Clone the iD.A.Y.Dream repository into your own repository/IDE
Step 3:  Reconfigure login and database connection credentials
             * If using a remote host:
                 * Move files: db_connect.php, login_creds.php outside of your publicly available files (needs to be private)
                 * Inside file: init.php, update the file path
             * If using docker:
                 * Establish your dockerfile appropriately for database passwords: docker-compose.yml, Dockerfile
Step 4:  Ensure site functions as intended and that you have access to your own administration pages
Step 5:  Have fun changing and improving upon our work!
```
</p>
</details>

<details>
  <summary><strong>File Descriptions</strong></summary>
    <p>Summary of each file and it's function within the application:
    </p>
  
  <details>
  <summary>volunteer_form.php</summary>
    <p>File contains iD.A.Y.Dream Youth Organization's Volunteer Sign Up Form. Interested volunteers fill out
        this form and are entered into the database for admin to contact and 'activate' as status: active Volunteer.
    </p>
</details>
</details>

## Built With
* HTML5 + PHP - Scripting Languages of Choice
* JavaScript + jQuery - Dynamic Scripting Language(s) of Choice
* mySQL - Database Creation
* Ajax - Asynchronous Web Application
* CSS + Bootstrap - Responsive Framework
* Docker - Rapid Testing Enviroment
* Git - Version Control + Terminal
* cPanel - File Management(DBMS) + Deployment

## Versioning
This repository contains version 1.0 of this project. Further iterations of the project will be linked.
* Version 1.0 (As of 2019-12-04)

## Acknowledgments
* Brandi Day - Founder of iD.A.Y.Dream
* Tina Ostrander - Instructor of Web Development, Green River College

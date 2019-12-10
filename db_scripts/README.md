## File Descriptions

<details>
  <summary>db_schema.sql</summary>
    <p>This file contains tables for iD.A.Y.Dream Youth Organization's database. Table interactions are as such: All organization member's basic information is stored in the User table. Volunteers are Users with additional volunteer specific data, stored in the Volunteer table. Dreamers are Users with additional dreamer specific data, stored in the dreamer table. Contacts are either of type 'Reference' (tied to volunteers) or of type 'Guardian' (tied to dreamers) and are stored in the Contact table.
 </p>

+ Volunteers have 3 references (required).
 + Dreamers have 1 guardian (1 required).


<p>TODO Delete Sample Data When Live:</p>

+ Sample Users, Volunteers, Dreamers, Contacts are added for testing purposes only.

</details>

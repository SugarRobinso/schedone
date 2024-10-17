BEGIN;

CREATE TABLE users (

    username    Varchar(16) primary key,
    mail        Varchar(20),
    psw         Varchar(16),
    credits     smallint

);

COMMIT;
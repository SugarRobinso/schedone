BEGIN;

CREATE TABLE friends (

    id SERIAL PRIMARY KEY,
    username1 Varchar(16),
    username2 Varchar(16),

    FOREIGN KEY (username1) REFERENCES users(username),
    FOREIGN KEY (username2) REFERENCES users(username)
);

COMMIT;
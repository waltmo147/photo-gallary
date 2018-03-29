/* TODO: create tables */
CREATE TABLE photos (
    id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    file_name TEXT NOT NULL,
    file_ext TEXT NOT NULL,
    uploader TEXT
);

CREATE TABLE tags (
    id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    tag TEXT NOT NULL
);

CREATE TABLE matches (
    id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    tag_id TEXT NOT NULL,
    photo_id TEXT NOT NULL
);

CREATE TABLE users (
    id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    account_name TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    session TEXT UNIQUE
);


/* TODO: initial seed data */
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('dog.jpeg', 'jpeg', 2);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('cat.jpeg', 'jpeg', 2);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('ferrari.jpg', 'jpeg', 2);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('lambo.jpg', 'jpg', 1);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('nyc.jpg', 'jpg', 1);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('burger.jpg', 'jpg', 1);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('noodle.jpg', 'jpg', 2);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('lake.png', 'png', 1);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('money.jpg', 'jpg', 2);
INSERT INTO photos (file_name, file_ext, uploader) VALUES ('tracy.jpg', 'jpg', 1);

INSERT INTO tags (tag) VALUES ('animal');
INSERT INTO tags (tag) VALUES ('car');
INSERT INTO tags (tag) VALUES ('view');
INSERT INTO tags (tag) VALUES ('city');
INSERT INTO tags (tag) VALUES ('food');
INSERT INTO tags (tag) VALUES ('noodle');
INSERT INTO tags (tag) VALUES ('sport');

INSERT INTO matches (tag_id, photo_id) VALUES (1, 1);
INSERT INTO matches (tag_id, photo_id) VALUES (1, 2);
INSERT INTO matches (tag_id, photo_id) VALUES (2, 3);
INSERT INTO matches (tag_id, photo_id) VALUES (2, 4);
INSERT INTO matches (tag_id, photo_id) VALUES (3, 5);
INSERT INTO matches (tag_id, photo_id) VALUES (3, 8);
INSERT INTO matches (tag_id, photo_id) VALUES (4, 5);
INSERT INTO matches (tag_id, photo_id) VALUES (5, 6);
INSERT INTO matches (tag_id, photo_id) VALUES (5, 7);
INSERT INTO matches (tag_id, photo_id) VALUES (6, 10);

INSERT INTO users (account_name, password, session) VALUES ('username1', '$2y$10$RJ1iuEQEGMN6Fwp.iZzkCexQe561GcZ.Mts29Hi1RixbnxkM/jqjK', NULL); /* password1 */
INSERT INTO users (account_name, password, session) VALUES ('username2', '$2y$10$GDJH6KjMg56Nbjjnc/8TXOk32/bXjeFgT3pJcA5k.6WnK0c9A8MEm', NULL); /* password2 */

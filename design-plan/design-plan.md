# Project 3 - Design & Plan

Your Name: Yufu Mo

## 1. Persona

I've selected **[Abby]** as my persona.

I've selected my persona because:

1) Abby has low confidence about doing unfamiliar computing tasks. I think even if she cannot figure out how this website woks, she will still blame herself first.

2) Abby might be willing to spend time figuring out how the website works.

## 2. Sketches & Wireframes

### Sketches

[Insert your sketches here.]
![index](/images/sketch6.png)
![gallery](/images/sketch3.png)
![add](/images/sketch4.png)
![login](/images/sketch5.png)
![edit](/images/sketch7.png)

### Wireframes

[Insert your wireframes here.]
![index](/images/wireframe6.png)
![gallery](/images/wireframe3.png)
![add](/images/wireframe4.png)
![login](/images/wireframe5.png)
![edit](/images/wireframe7.png)

[Explain why your design would be effective for your persona. 1-3 sentences.]

Because my sketches are based on pretty simple design, which is good for Abby since she rarely has spare time to learn how to use the website. The data visualization like images and tags are shown clearly on the page. There is no need to click any button, which is very easy to get information.

## 3. Database Schema Plan

[Describe the structure of your database. You may use words or a picture. A bulleted list is probably the simplest way to do this.]

Table: photos
* id: INTEGER, not null, PK, AI, U
* file_name: TEXT, not null
* file_ext, not null
* user_id: INTEGER, not null

Table: tags
* id: INTEGER, not null, PK, AI, U
* tag: TEXT, not null

Table: matches
* id: INTEGER, not null, PK, AI, U
* tag_id: INTEGER, not null
* photo_id: INTEGER, not null

Table: users
* id: INTEGER, not null, PK, AI, U
* account_name: TEXT, not null, U
* password: TEXT, not null

Table: sessions
* id: INTEGER, not null, PK, AI, U
* user_id: TEXT, not null
* session: TEXT, not null, U


## 4. Database Query Plan

[Plan your database queries. You may use natural language, pseudocode, or SQL.]

1. All photos
```sql
SELECT * FROM photos;
```

2. All tags
```sql
SELECT * FROM tags;
```

3. Search tags by the input
```sql
SELECT id, tag FROM tags WHERE tag LIKE '%food%';
```

4. Insert images
```sql
INSERT INTO photos (file_name, file_ext, user_id) values (...);
```

5. Add tag
```sql
INSERT INTO tags (tag) values (...);
INSERT INTO matches (tag_id, user_id) values (...);
```

6. Delete tag
```sql
DELETE FROM matches WHERE tag_id = 5 AND photo_id = 3;
```

7. Login
```sql
INSERT INTO sessions (user_id, session) values (...);
```

8. Logout
```sql
DELETE FROM sessions WHERE user_id = 5 AND session = 'AJKLF6567GA86';
```

9. Return photos for a tag
```sql
SELECT photos.id, photos.file_ext FROM ((matches INNER JOIN tags ON matches.tag_id = tags.id) INNER JOIN photos on photos.id = matches.photo_id) WHERE tag = 'car';
```


## 5. Structure and Pseudocode

### Structure

[List the PHP files you will have. You will probably want to do this with a bulleted list.]

* index.php - main page.
* gallery.php - show photos according to the tags.
* edit.php - show single image and delete/add tags.
* includes/init.php - stuff that useful for every web page.
* includes/header.php - stuff that useful for every web page.
* includes/footer.php - stuff that useful for every web page.

### Pseudocode

[For each PHP file, plan out your pseudocode. You probably want a subheading for each file.]

#### index.php

```

include init.php
include header.php

connect to db
echo the search form to filter tags

load all the tags from table tags of the db

foreach tag in result
    escape the output
    echo tag

include footer.php


```

#### includes/init.php

```
messages = array to store messages for user (you may remove this)

// DB helper functions (you do not need to write this out since they are provided.)
function handle_db_error($exception)
function exec_sql_query($db, $sql, $params = array())
function open_or_init_sqlite_db($db_filename, $init_sql_filename)

function print_messages() {
  foreach messages as message {
    print message
  }
}

...

```

#### gallery.php

```
include init.php
include header.php

connect to db
echo the tag

load all the images from table photos of the db

foreach image in result
    escape the output
    echo image

include footer.php

```


#### edit.php

```
include init.php
include header.php

connect to db

escape the output
echo the image

load all the tags from table matches of the db where the image is the image we want

foreach tag in result
    escape the output
    echo tag

echo the edit form

include footer.php

```

#### includes/header.php

```
echo the header
foreach page
    echo the title on the navigation bar

```

#### includes/footer.php

```
echo the references

```


## 6. Seed Data - Username & Passwords

[List the usernames and passwords for your users]

* user1 : password1
* user2 : password2

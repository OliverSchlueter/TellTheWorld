CREATE DATABASE IF NOT EXISTS telltheworld;
USE telltheworld;

CREATE TABLE IF NOT EXISTS users(
    tag VARCHAR(255) NOT NULL PRIMARY KEY,
    joined INT UNSIGNED NOT NULL,
    nickname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    birthdate INT UNSIGNED NOT NULL,
    about_me VARCHAR(255),
    profile_picture VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS follows(
    follower_tag VARCHAR(255) NOT NULL,
    user_tag VARCHAR(255) NOT NULL,
    since INT UNSIGNED NOT NULL,

    PRIMARY KEY (follower_tag, user_tag),
    FOREIGN KEY (follower_tag) REFERENCES users(tag),
    FOREIGN KEY (user_tag) REFERENCES users(tag)
);

CREATE TABLE IF NOT EXISTS messages(
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    time_sent INT UNSIGNED NOT NULL,
    sender_tag VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    amount_likes INT UNSIGNED NOT NULL,
    amount_comments INT UNSIGNED NOT NULL,

    FOREIGN KEY (sender_tag) REFERENCES users(tag)
);

CREATE TABLE IF NOT EXISTS user_likes_message(
    user_tag VARCHAR(255) NOT NULL,
    message_id VARCHAR(255) NOT NULL,
    since INT UNSIGNED NOT NULL,

    PRIMARY KEY (user_tag, message_id),
    FOREIGN KEY (user_tag) REFERENCES users(tag),
    FOREIGN KEY (message_id) REFERENCES messages(id)
);

CREATE TABLE IF NOT EXISTS user_follows_user(
    follower_tag VARCHAR(255) NOT NULL,
    user_tag VARCHAR(255) NOT NULL,
    since INT UNSIGNED NOT NULL,

    PRIMARY KEY (follower_tag, user_tag),
    FOREIGN KEY (follower_tag) REFERENCES users(tag),
    FOREIGN KEY (user_tag) REFERENCES users(tag)
);
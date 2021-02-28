DROP DATABASE IF EXISTS teachers;
CREATE DATABASE IF NOT EXISTS teachers;

USE teachers;

CREATE TABLE projects (
    id INT(5) NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(255) NOT NULL UNIQUE,
    groups_total INT(5) NOT NULL,
    students_per_group INT(5) NOT NULL
);

CREATE TABLE students (
    id INT(5) NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(255) NOT NULL ,
    project_id INT(5) NOT NULL ,
    group_id INT(5),
    position INT(5)
);

CREATE TABLE project_groups (
    id INT(5) NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(20) NOT NULL ,
    project_id INT(5) NOT NULL
)
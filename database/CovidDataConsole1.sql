#create schema covidData;
CREATE schema covidDataDB;
USE assignment;
USE covidDataDB;
# for admin database


SHOW TABLES;
SELECT * FROM Ireland;

CREATE TABLE Ireland(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Uk(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE USA(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE France(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Germany(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Spain(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Switerland(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Italy(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Denmark(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Netherlands(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Sweden(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Austria(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Norway(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Portugal(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Belgium(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);
CREATE TABLE Australia(
    date DATE,
    cases INT,
    deaths INT,
    PRIMARY KEY (date)
);

CREATE TABLE users(
    usersId int(11) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
    name varchar(128) NOT NULL,
    username varchar(128) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL
);
DROP TABLE users;




SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'coviddatadb'  LIMIT 5,5;













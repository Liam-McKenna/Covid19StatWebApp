
#CREATE DATABASE covidapidata;
#use covidapidata;

# SET @MAX_QUESTIONS=0;

# USE covidDataDB;
# for admin database
# SELECT * FROM countries;
# SELECT countryName FROM countries WHERE countryName LIKE 'i%';
# SELECT * FROM covid19Stats WHERE countryID = 'AI';
# SELECT * FROM covid19Stats WHERE countryID = 'ie' ORDER BY reportDate DESC LIMIT 6;
# SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'coviddatadb'  LIMIT 5,5;

DROP TABLE IF EXISTS countries ;
CREATE TABLE countries(
    countryName varchar(128) UNIQUE NOT NULL,
    countryCode varchar(20) UNIQUE NOT NULL
);
#INSERT INTO `countries`(countryName,countryCode) VALUES (v1, v2);

DROP TABLE IF EXISTS covid19Stats;
CREATE TABLE covid19Stats(
    countryID varchar(128) NOT NULL,
    reportDate DATE NOT NULL,
    cases INT,
    deaths INT,
    PRIMARY KEY (countryID,reportDate)
);
#INSERT INTO `covid19Stats`(countryID, reportDate, cases, deaths) VALUES ('ie', '2020-05-11', 398 , 5);

DROP TABLE IF EXISTS users;
CREATE TABLE users(
    usersId int(11) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
    name varchar(128) NOT NULL,
    username varchar(128) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL
);





## get size of the database
# SELECT table_schema AS "Database",
# ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS "Size (MB)"
# FROM information_schema.TABLES
# GROUP BY table_schema;









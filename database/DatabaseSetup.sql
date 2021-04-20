
CREATE DATABASE IF NOT EXISTS covidapidata;
use covidapidata;
-- use heroku_9c118c3fb745a2a;


DROP TABLE IF EXISTS countries ;
CREATE TABLE countries(
    countryName varchar(128) UNIQUE NOT NULL,
    countryCode varchar(20) UNIQUE NOT NULL,
    PRIMARY KEY (countryCode)
);


DROP TABLE IF EXISTS covid19Stats;
CREATE TABLE covid19Stats(
    countryID varchar(128) NOT NULL,
    reportDate DATE NOT NULL,
    cases INT,
    deaths INT,
    PRIMARY KEY (countryID,reportDate)
);


DROP TABLE IF EXISTS users;
CREATE TABLE users(
    usersId int(11) NOT NULL AUTO_INCREMENT UNIQUE,
    name varchar(128) NOT NULL,
    username varchar(128) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL
    PRIMARY KEY (usersId)
);


DROP TABLE IF EXISTS globalCovid;
CREATE TABLE globalCovid(
    globalDate date NOT NULL,
    cases INT,
    deaths INT,
    recovered INT
)








-- get data storage size of the database.
SELECT table_schema AS "Database",
ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS "Size (MB)"
FROM information_schema.TABLES
GROUP BY table_schema;


SELECT countries.countryName, covid19stats.reportDate, covid19stats.cases, covid19stats.deaths FROM covid19stats
INNER JOIN countries ON covid19stats.countryID=countries.countryCode WHERE reportDate = (SELECT MAX(reportDate) FROM covid19stats) ORDER BY cases desc limit 10;






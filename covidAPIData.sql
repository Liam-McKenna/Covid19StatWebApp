CREATE DATABASE covidapidata;
use covidapidata;


CREATE TABLE countries(
    countryName varchar(128) UNIQUE NOT NULL,
    countryCode varchar(20) UNIQUE NOT NULL
);w


DROP TABLE IF EXISTS covid19data;
CREATE TABLE covid19data(
    countryCode varchar(128) NOT NULL,
    reportDate DATE NOT NULL,
    cases INT,
    deaths INT,
    PRIMARY KEY (countryCode,reportDate)
);

DROP TABLE IF EXISTS users;
CREATE TABLE users(
    usersId int(11) NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
    name varchar(128) NOT NULL,
    username varchar(128) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(128) NOT NULL
);
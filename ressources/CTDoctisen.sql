DROP TABLE IF EXISTS Speciality CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Timeslot CASCADE;
DROP TABLE IF EXISTS Meeting CASCADE;
DROP TABLE IF EXISTS Place CASCADE;
DROP TABLE IF EXISTS City CASCADE;
DROP TABLE IF EXISTS works CASCADE;

------------------------------------------------------------
-- Table: Speciality
------------------------------------------------------------
CREATE TABLE Speciality(
	id     SERIAL NOT NULL ,
	type   VARCHAR (128) NOT NULL  ,
	CONSTRAINT Speciality_PK PRIMARY KEY (id)
);

------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE Users(
                      id              SERIAL NOT NULL ,
                      name            VARCHAR (128) NOT NULL ,
                      surname         VARCHAR (128) NOT NULL ,
                      phone           CHAR (10)  NOT NULL UNIQUE,
                      mail            VARCHAR (128) NOT NULL UNIQUE,
                      password        VARCHAR (60) NOT NULL ,
                      id_Speciality   INT    ,
                        picture     VARCHAR (15),
                      CONSTRAINT User_PK PRIMARY KEY (id)

    ,CONSTRAINT User_Speciality_FK FOREIGN KEY (id_Speciality) REFERENCES Speciality(id)
);


------------------------------------------------------------
-- Table: City
------------------------------------------------------------
CREATE TABLE City(
	code_insee    varchar (5)  NOT NULL ,
	city          VARCHAR (128) NOT NULL ,
	code_postal   INT  NOT NULL  ,
	CONSTRAINT City_PK PRIMARY KEY (code_insee)
);


------------------------------------------------------------
-- Table: Place
------------------------------------------------------------
CREATE TABLE Place(
	id           SERIAL NOT NULL ,
	name         VARCHAR (128) NOT NULL ,
	num_street   INT  NOT NULL ,
	street       VARCHAR (128) NOT NULL ,
	code_insee   varchar(5)  NOT NULL  ,
	CONSTRAINT Place_PK PRIMARY KEY (id)

	,CONSTRAINT Place_City_FK FOREIGN KEY (code_insee) REFERENCES City(code_insee)
);


------------------------------------------------------------
-- Table: Meeting
------------------------------------------------------------
CREATE TABLE Meeting(
	id                 SERIAL NOT NULL ,
	beginning          TIMESTAMP  NOT NULL ,
	ending                TIMESTAMP  NOT NULL ,
	id_Place           INT  NOT NULL ,
	id_User            INT  NOT NULL ,
	id_User_Asks_for   INT   NULL  ,
	CONSTRAINT Meeting_PK PRIMARY KEY (id)

	,CONSTRAINT Meeting_Place_FK FOREIGN KEY (id_Place) REFERENCES Place(id)
	,CONSTRAINT Meeting_User0_FK FOREIGN KEY (id_User) REFERENCES Users(id)
	,CONSTRAINT Meeting_User1_FK FOREIGN KEY (id_User_Asks_for) REFERENCES Users(id)
);

------------------------------------------------------------
-- Table: works
------------------------------------------------------------
CREATE TABLE works(
	id        INT  NOT NULL ,
	id_User   INT  NOT NULL  ,
	CONSTRAINT works_PK PRIMARY KEY (id,id_User)

	,CONSTRAINT works_Place_FK FOREIGN KEY (id) REFERENCES Place(id)
	,CONSTRAINT works_User0_FK FOREIGN KEY (id_User) REFERENCES Users(id)
);





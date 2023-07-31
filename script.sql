CREATE TABLE Farmowner(
    id_owner INT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    PRIMARY KEY(id_owner)
); CREATE TABLE Job(
    job_name VARCHAR(20),
    salary_per_hour INT,
    PRIMARY KEY(job_name)
); CREATE TABLE Employee(
    id_employee INT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    job_name VARCHAR(20),
    payer INT,
    payday DATE,
    PRIMARY KEY(id_employee),
    FOREIGN KEY(payer) REFERENCES Farmowner(id_owner) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(job_name) REFERENCES Job(job_name) ON DELETE SET NULL ON UPDATE CASCADE
); 
CREATE TABLE FullTime(
    id_employee INT,
    benefits VARCHAR(30),
    PRIMARY KEY(id_employee),
    FOREIGN KEY(id_employee) REFERENCES Employee(id_employee) ON DELETE CASCADE ON UPDATE CASCADE
); CREATE TABLE Equipment(
    id_equipment INT,
    equipment_type VARCHAR(25) NOT NULL,
    PRIMARY KEY(id_equipment)
); CREATE TABLE Plant(
    plant_name VARCHAR(25),
    quantity INT,
    PRIMARY KEY(plant_name)
); CREATE TABLE FarmAreaName(
    area_name VARCHAR(20),
    area_type VARCHAR(25) NOT NULL,
    PRIMARY KEY(area_name)
); CREATE TABLE FarmArea(
    id_area INT,
    area_name VARCHAR(20),
    PRIMARY KEY(id_area),
    FOREIGN KEY(area_name) REFERENCES FarmAreaName(area_name) ON DELETE SET NULL ON UPDATE CASCADE
); CREATE TABLE Customer(
    id_customer INT,
    username VARCHAR(40) NOT NULL UNIQUE,
    PRIMARY KEY(id_customer)
); CREATE TABLE Animal(
    animal_name VARCHAR(20),
    quantity INT,
    tends INT,
    tend_date DATE,
    PRIMARY KEY(animal_name),
    FOREIGN KEY(tends) REFERENCES Employee(id_employee) ON DELETE SET NULL ON UPDATE CASCADE
); CREATE TABLE Produces_Product(
    animal_name VARCHAR(20),
    product_name VARCHAR(20),
    quantity INT,
    PRIMARY KEY(animal_name, product_name),
    FOREIGN KEY(animal_name) REFERENCES Animal(animal_name) ON DELETE CASCADE ON UPDATE CASCADE
); CREATE TABLE UsedIn(
    id_equipment INT,
    id_area INT,
    PRIMARY KEY(id_equipment, id_area),
    FOREIGN KEY(id_equipment) REFERENCES Equipment(id_equipment) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_area) REFERENCES FarmArea(id_area) ON DELETE CASCADE ON UPDATE CASCADE
); CREATE TABLE Purchases(
    id_customer INT,
    animal_name VARCHAR(20),
    product_name VARCHAR(20),
    quantity INT,
    PRIMARY KEY(
        id_customer,
        animal_name,
        product_name
    ),
    FOREIGN KEY(id_customer) REFERENCES Customer(id_customer) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(animal_name, product_name) REFERENCES Produces_Product(animal_name, product_name) ON DELETE CASCADE ON UPDATE CASCADE
); CREATE TABLE AnimalLivesIn(
    animal_name VARCHAR(20),
    id_area INT,
    PRIMARY KEY(animal_name, id_area),
    FOREIGN KEY(animal_name) REFERENCES Animal(animal_name) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_area) REFERENCES FarmArea(id_area) ON UPDATE CASCADE
); CREATE TABLE PlantLivesIn(
    plant_name VARCHAR(20),
    id_area INT,
    PRIMARY KEY(plant_name, id_area),
    FOREIGN KEY(plant_name) REFERENCES Plant(plant_name) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_area) REFERENCES FarmArea(id_area) ON UPDATE CASCADE
); CREATE TABLE Eats(
    animal_name VARCHAR(20),
    plant_name VARCHAR(20),
    quantity INT,
    PRIMARY KEY(animal_name, plant_name),
    FOREIGN KEY(animal_name) REFERENCES Animal(animal_name) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(plant_name) REFERENCES Plant(plant_name) ON DELETE CASCADE ON UPDATE CASCADE
);



INSERT INTO Farmowner VALUES (1,'Hashirama', 'Senju');
INSERT INTO Farmowner VALUES (2,'Tobirama', 'Senju');
INSERT INTO Farmowner VALUES (3,'Hiruzen', 'Sarutobi');
INSERT INTO Farmowner VALUES (4,'Minato', 'Namikaze');
INSERT INTO Farmowner VALUES (5,'Tsunade', 'Senju');

INSERT INTO Job VALUES ('Manager', 100);
INSERT INTO Job VALUES ('Farmer', 70);
INSERT INTO Job VALUES ('Freelancer', 60);
INSERT INTO Job VALUES ('Admin', 70);
INSERT INTO Job VALUES ('Intern', 40);


INSERT INTO Employee VALUES (7, 'Kakashi', 'Hatake', 'Manager', 4, '2022-09-14');
INSERT INTO Employee VALUES (2, 'Might', 'Guy', 'Manager', 3, '2022-01-01');
INSERT INTO Employee VALUES (10, 'Asuma ', 'Sarutobi', 'Manager', 3, '2022-10-14');
INSERT INTO Employee VALUES (8, 'Kurenai ', 'Sarutobi', 'Manager', 3, '2022-06-11');
INSERT INTO Employee VALUES (3, 'Jiraiya', 'Ogata', 'Manager', 5, '2022-11-11');
INSERT INTO Employee VALUES (0, 'Iruka ', 'Umino', 'Farmer', 3, '2022-05-24');
INSERT INTO Employee VALUES (11, 'Shikaku ', 'Nara ', 'Farmer', 3, '2022-07-14');
INSERT INTO Employee VALUES (12, 'Inoichi ', 'Yamanaka', 'Farmer', 3, '2022-01-24');
INSERT INTO Employee VALUES (13, 'Choza ', 'Akimichi', 'Farmer', 3, '2022-05-01');


INSERT INTO FullTime VALUES (7, 'Personal library');
INSERT INTO FullTime VALUES (2, 'Custom work attire');
INSERT INTO FullTime VALUES (8, 'Free childcare');
INSERT INTO FullTime VALUES (0, 'Weekly ramen');
INSERT INTO FullTime VALUES (13, 'Monthly all-you-can-eat');


INSERT INTO Equipment VALUES (1, 'Hoe');
INSERT INTO Equipment VALUES (2, 'Tractor');
INSERT INTO Equipment VALUES (3, 'Baler');
INSERT INTO Equipment VALUES (4, 'Plow');
INSERT INTO Equipment VALUES (5, 'Plow');

INSERT INTO Plant VALUES ('Spinach', 100);
INSERT INTO Plant VALUES ('Curry', 100);
INSERT INTO Plant VALUES ('Chili', 100);
INSERT INTO Plant VALUES ('Grass', 2022);
INSERT INTO Plant VALUES ('Corn', 5000);


INSERT INTO FarmAreaName VALUES ('Konoha', 'Field');
INSERT INTO FarmAreaName VALUES ('Sunaga', 'Lake');
INSERT INTO FarmAreaName VALUES ('Kiriga', 'Lake');
INSERT INTO FarmAreaName VALUES ('Kumoga', 'Field');
INSERT INTO FarmAreaName VALUES ('Iwaga', 'Field');



INSERT INTO FarmArea VALUES (1, 'Konoha');
INSERT INTO FarmArea VALUES (2, 'Sunaga');
INSERT INTO FarmArea VALUES (3, 'Kiriga');
INSERT INTO FarmArea VALUES (4, 'Kumoga');
INSERT INTO FarmArea VALUES (5, 'Iwaga');




INSERT INTO Customer VALUES (1, 'nagato');
INSERT INTO Customer VALUES (2, 'konan');
INSERT INTO Customer VALUES (3, 'zetsu');
INSERT INTO Customer VALUES (4, 'sasori');
INSERT INTO Customer VALUES (5, 'kisame');


INSERT INTO Animal VALUES ('Eagle', 2, 7, '2022-07-15'); 
INSERT INTO Animal VALUES ('Scorpion', 26, 7, '2022-07-01'); 
INSERT INTO Animal VALUES ('Cow', 5, 7, '2022-07-18'); 
INSERT INTO Animal VALUES ('Salamander', 2, 7, '2022-07-11'); 
INSERT INTO Animal VALUES ('Toad', 100, 3, '2022-07-11'); 

INSERT INTO Produces_Product VALUES ('Scorpion', 'Venom', 1);
INSERT INTO Produces_Product VALUES ('Cow', 'Milk', 10);
INSERT INTO Produces_Product VALUES ('Cow', 'Beef', 5);
INSERT INTO Produces_Product VALUES ('Salamander', 'Glue', 3);
INSERT INTO Produces_Product VALUES ('Toad', 'Poison', 2);

INSERT INTO UsedIn VALUES (1, 4);
INSERT INTO UsedIn VALUES (2, 1);
INSERT INTO UsedIn VALUES (3, 2);
INSERT INTO UsedIn VALUES (4, 3);
INSERT INTO UsedIn VALUES (5, 1);

INSERT INTO Purchases VALUES (4, 'Scorpion', 'Venom', 1);
INSERT INTO Purchases VALUES (3, 'Cow', 'Milk', 1);
INSERT INTO Purchases VALUES (3, 'Cow', 'Beef', 2);
INSERT INTO Purchases VALUES (3, 'Salamander', 'Glue', 2);
INSERT INTO Purchases VALUES (1, 'Toad', 'Poison', 3);

INSERT INTO AnimalLivesIn VALUES ('Eagle', 3);
INSERT INTO AnimalLivesIn VALUES ('Scorpion', 3);
INSERT INTO AnimalLivesIn VALUES ('Cow', 4);
INSERT INTO AnimalLivesIn VALUES ('Salamander', 5);
INSERT INTO AnimalLivesIn VALUES ('Toad', 5);

INSERT INTO PlantLivesIn VALUES ('Spinach', 1);
INSERT INTO PlantLivesIn VALUES ('Curry', 1);
INSERT INTO PlantLivesIn VALUES ('Chili', 1);
INSERT INTO PlantLivesIn VALUES ('Grass', 2);
INSERT INTO PlantLivesIn VALUES ('Corn', 2);

INSERT INTO Eats VALUES ('Cow', 'Spinach', 3);
INSERT INTO Eats VALUES ('Scorpion', 'Curry', 3);
INSERT INTO Eats VALUES ('Scorpion', 'Spinach', 3);
INSERT INTO Eats VALUES ('Scorpion', 'Chili', 3);
INSERT INTO Eats VALUES ('Scorpion', 'Grass', 3);
INSERT INTO Eats VALUES ('Scorpion', 'Corn', 3);
INSERT INTO Eats VALUES ('Cow', 'Chili', 3);
INSERT INTO Eats VALUES ('Cow', 'Grass', 10);
INSERT INTO Eats VALUES ('Toad', 'Corn', 10);

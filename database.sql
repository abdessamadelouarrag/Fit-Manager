CREATE DATABASE FitManager;
USE fitmanager;
CREATE table cours (id_cours INT PRIMARY KEY AUTO_INCREMENT,
                    nom VARCHAR(150),
                    categorie VARCHAR(150),
                    date_cours DATE,
                    heure TIME,
                    duree TIME,
                    nombre_max_de_participants INT);


CREATE TABLE equipement(id_equipement INT PRIMARY KEY AUTO_INCREMENT,
                        nom VARCHAR(150),
                        type VARCHAR(150),
                        quantite_disponible INT,
                        etat VARCHAR(150));
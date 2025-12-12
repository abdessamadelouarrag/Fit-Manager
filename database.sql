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


CREATE TABLE cours_equipement (
        id_cours INT NOT NULL,
        id_equipement INT NOT NULL,
    
        PRIMARY KEY (id_cours, id_equipement),
    
        FOREIGN KEY (id_cours) REFERENCES cours(id_cours),
        FOREIGN KEY (id_equipement) REFERENCES equipement(id_equipement)
    );

CREATE TABLE users (
	id_user INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(30) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(150) NOT NULL
    );

alter table cours add id_user int;

alter table cours add foreign key (id_user) references users(id_user);

alter table equipement ADD id_user int

alter table equipement add foreign key (id_user) references users(id_user);
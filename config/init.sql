-- Initialisation de la DB
DROP DATABASE IF EXISTS orbitWatch;
CREATE DATABASE orbitWatch;
USE orbitWatch;

CREATE TABLE users(
   id_user INT AUTO_INCREMENT PRIMARY KEY,
   user_name VARCHAR(30) NOT NULL,
   user_mdp VARCHAR(30) NOT NULL,
   user_publication_number INT NOT NULL,
   user_account DATE NOT NULL
);

CREATE TABLE missions(
   id_mission INT AUTO_INCREMENT PRIMARY KEY,
   mission_name VARCHAR(100) NOT NULL,
   mission_obj TEXT NOT NULL,
   mission_date DATETIME NOT NULL,
   mission_image VARCHAR(200),
   mission_agency VARCHAR(30) NOT NULL,
   mission_publication VARCHAR(30) NOT NULL,
   mission_publication_date DATE NOT NULL,
   id_user INT NOT NULL,
   FOREIGN KEY(id_user) REFERENCES users(id_user)
);

CREATE TABLE roles(
   id_role INT AUTO_INCREMENT PRIMARY KEY,
   role_name VARCHAR(30) NOT NULL
);

CREATE TABLE affecter(
   id_user INT,
   id_role INT,
   PRIMARY KEY(id_user, id_role),
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(id_role) REFERENCES roles(id_role)
);

-- Remplissage initial pour éviter de démarrer avec un DB vide
INSERT INTO users(user_name, user_mdp, user_publication_number, user_account) VALUES
    ('Leag', 'mdpLeag', 3, '2023-07-28'),
    ('Imas', 'mdpImas', 1, '2023-10-10'),
    ('Hpesoj', 'mdpHpesoj', 0, '2023-08-30'),
    ('Mail', 'mdpMail', 1, '2023-08-21'),
    ('Sira', 'mdpSira', 1, '2023-09-07'),
    ('Mada', 'mdpMada', 1, '2023-10-01');

-- Possibilité d'ajouter autant de rôles que l'on souhaite, on a qu'à les attribuer via l'entité relationnelle affecter. De plus, chaque utilisateur peut avoir plusieurs rôles en même temps
INSERT INTO roles(role_name) VALUES
    ('Visiteur'),
    ('Moderateur'),
    ('Admin');

-- Affectation des rôles
INSERT INTO affecter(id_user, id_role) VALUES
    (1,3),
    (2,2),
    (3,1),
    (4,2),
    (4,3),
    (5,1),
    (6,1);

-- Remplissage par défaut de la table
INSERT INTO missions (mission_name, mission_obj, mission_date, mission_image, mission_agency, mission_publication, mission_publication_date, id_user) VALUES
   ('Mission Apollo 11', 'Atteindre la Lune', '1969-07-20 20:17:40', 'apollo11.jpg', 'NASA', 'Leag', '1969-07-21', 1),
   ('Mission Mars Rover', 'Exploration de Mars', '2021-02-18 13:55:00', 'marsrover.jpg', 'NASA', 'Mail', '2021-02-19', 2),
   ('Mission Hubble', 'Télescope spatial', '1990-04-24 19:33:51', 'hubble.jpg', 'NASA', 'Leag', '1990-04-25', 4),
   ('Mission James Webb', 'Télescope spatial', '2021-12-25 08:00:00', 'jameswebb.jpg', 'NASA', 'Imas', '2021-12-26', 3),
   ('Lancement de LISA', 'Observation de signaux gravitationnels', '2022-09-15 14:30:00', 'lisa.jpg', 'ESA', 'Mada', '2022-09-16', 5),
   ('Mission Voyager 3', 'Exploration interstellaire', '2025-03-10 10:00:00', 'voyager3.jpg', 'NASA', 'Sira', '2025-03-11', 1),
   ('Mission Titan Rover', 'Exploration de Titan (lune de Saturne)', '2023-07-05 09:45:00', 'titanrover.jpg', 'NASA', 'Leag', '2023-07-06', 2);
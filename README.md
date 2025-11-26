# **Projet Web PHP – Gestion de Collection Mihoyo**

Ce projet est une application web développée en PHP natif, utilisant PlatesPHP comme moteur de template, permettant de gérer :

Une liste de personnages (CRUD complet)

Une collection personnelle par utilisateur

Une authentification simple (test / admin)

Un système de logs (fichiers .log)

Une interface avec styles visuels avancés

## _1. Prérequis_

Pour faire fonctionner le projet sur un autre ordinateur, il faut installer :

### Logiciels nécessaires :

WAMP, XAMPP ou Laragon
→ avec PHP 8.x recommandé
→ MySQL ou MariaDB

PHPStorm ou VSCode

Un navigateur moderne (Chrome / Firefox)

### Organisation d’arborescence

Après installation, les fichiers devront être placés dans le dossier :

C:\wamp64\www\ProjetWeb\ ou équivalent selon votre installation.

## 2. Installation du projet - Étape 1 Copier les fichiers

Télécharger/Cloner le projet

Copier le dossier complet dans : C:\wamp64\www\ProjetWeb\


Ouvrir ce dossier avec PHPStorm.

## 3. Base de Données - Étape 2 Création de la base

Lancer WAMP (icône verte)

Ouvrir DataGrip

Aller dans SQL
Copier et executer ce code : 

```
CREATE DATABASE projetweb;
USE projetweb;

DROP TABLE IF EXISTS Personnage;
DROP TABLE IF EXISTS Element;
DROP TABLE IF EXISTS Origin;
DROP TABLE IF EXISTS UnitClass;
DROP TABLE IF EXISTS collection;
DROP TABLE IF EXISTS users;

CREATE TABLE Element (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
url_img VARCHAR(255) NOT NULL
);

CREATE TABLE Origin (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
url_img VARCHAR(255) NOT NULL
);

CREATE TABLE UnitClass (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
url_img VARCHAR(255) NOT NULL
);

CREATE TABLE Personnage (
id VARCHAR(50) PRIMARY KEY,
name VARCHAR(255) NOT NULL,
element INT NOT NULL,
unitclass INT NOT NULL,
origin INT NULL,
rarity INT NOT NULL,
url_img VARCHAR(255) NOT NULL,
CONSTRAINT fk_element FOREIGN KEY (element) REFERENCES Element(id) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_unitclass FOREIGN KEY (unitclass) REFERENCES UnitClass(id) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT fk_origin FOREIGN KEY (origin) REFERENCES Origin(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table ELEMENT
INSERT INTO ELEMENT (name, url_img) VALUES
('Pyro', 'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Pyro.png?strip=all&quality=100&w=16'),
('Hydro', 'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Hydro.png?strip=all&quality=100&w=16'),
('Cryo', 'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Cryo.png?strip=all&quality=100&w=16'),
('Electro', 'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Electro.png?strip=all&quality=100&w=16'),
('Geo', 'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Geo.png?strip=all&quality=100&w=16'),
('Anemo', 'https://i2.wp.com/images.genshin-builds.com/genshin/elements/Anemo.png?strip=all&quality=100&w=16');

-- Table UNITCLASS
INSERT INTO UNITCLASS (name, url_img) VALUES
('Épée à deux mains', 'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Claymore.png?strip=all&quality=100&w=16'),
('Archer', 'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Bow.png?strip=all&quality=100&w=16'),
('Catalyseur', 'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Catalyst.png?strip=all&quality=100&w=16'),
('Arme hast', 'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Polearm.png?strip=all&quality=100&w=16'),
('Épée à une main', 'https://i2.wp.com/images.genshin-builds.com/genshin/weapons_type/Sword.png?strip=all&quality=100&w=16');

-- Table ORIGIN
INSERT INTO ORIGIN (name, url_img) VALUES
('Mondstadt', 'https://static.wikia.nocookie.net/gensin-impact/images/f/f3/Region_Mondstadt.png'),
('Liyue', 'https://static.wikia.nocookie.net/gensin-impact/images/9/9b/Region_Liyue.png'),
('Inazuma', 'https://static.wikia.nocookie.net/gensin-impact/images/2/2e/Region_Inazuma.png'),
('Sumeru', 'https://static.wikia.nocookie.net/gensin-impact/images/5/52/Region_Sumeru.png'),
('Fontaine', 'https://static.wikia.nocookie.net/gensin-impact/images/b/b3/Region_Fontaine.png');

CREATE TABLE users(
id varchar(50) PRIMARY KEY,
username varchar(255) NOT NULL,
hash_pwd varchar(255) NOT NULL);


INSERT INTO USERS (id, username, hash_pwd)
VALUES ('2', 'admin', '$2y$12$aSyJbiwlejbLFFEvQV8LuOPbUajBqmUcq/BblUBWn2vAT6lftvdYa');

INSERT INTO USERS (id, username, hash_pwd)
VALUES ('1', 'test', '$2y$12$btZiTI5qeAUHQFlQskxdGOSRKFU6N9qymzShrHpTMWQURjcgVXWje');

CREATE TABLE collection (
id_user INT NOT NULL,
id_perso CHAR(36) NOT NULL,
PRIMARY KEY (id_user, id_perso),
FOREIGN KEY (id_user) REFERENCES users(id),
FOREIGN KEY (id_perso) REFERENCES personnage(id)
);

INSERT INTO personnage (id, name, element, unitclass, origin, rarity, url_img) VALUES
('1', 'Venti', 6, 2, 4, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/venti/image.png?strip=all&quality=100&w=160'),
('2', 'Escoffier', 3, 4, 5, 5, 'https://i2.wp.com/images.genshin-builds.com/genshin/characters/escoffier/image.png?strip=all&quality=100&w=160');
```

## 4. Configuration PHP

Le fichier de configuration se trouve dans :

Config/dev.ini


Contenu recommandé :
```
[DB]
dsn = "mysql:host=localhost;dbname=projetweb;charset=utf8mb4"
user = "root"
pass = ""
```

## 5. Lancer l'application

Vérifier que WAMP est en vert

Ouvrir PHPStorm

Lancer index.php via le bouton navigateur

L’application s’ouvre à l’adresse :

http://localhost/ProjetWeb/

## 6. Identifiants inclus

Rôle : Utilisateur, Admin

Identifiant : test, admin	

Mot de passe : test, admin

Ces comptes sont déjà inclus dans la base.
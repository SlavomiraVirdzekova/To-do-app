CREATE DATABASE ukoly COLLATE utf8_czech_ci;

CREATE TABLE ukoly (
	id int unsigned primary key auto_increment,
	ukol text,
	termin date,
	kategorie text,
	dulezitost int,
	stav boolean
);

-- Active: 1729325451277@@127.0.0.1@3306
create DATABASE cave_a_vin ;
use cave_a_vin;

create table utilisateur(
    id int primary key auto_increment,
    nom VARCHAR(50) not null,
    mdp VARCHAR(50) not null
);

insert into utilisateur(nom, mdp) values('admin', 'admin');

create table cave(
    id int primary key auto_increment,
    nom VARCHAR(50) not null,
    utilisateur_id int not null,
    foreign key (utilisateur_id) references utilisateur(id)
)

create table vin(
    id int primary key auto_increment,
    nom VARCHAR(50) not null,
    annee int not null,
    couleur VARCHAR(50) not null,
    region VARCHAR(50) not null,
    type_bouteille VARCHAR(50) not null;
    utilisateur_id int not null,
    cave_id int not null,
    foreign key (utilisateur_id) references utilisateur(id),
    foreign key (cave_id) references cave(id)
)

create table commentaire(
    id int primary key auto_increment,
    texte VARCHAR(255) not null,
    utilisateur_id int not null,
    vin_id int not null,
    foreign key (utilisateur_id) references utilisateur(id),
    foreign key (vin_id) references vin(id)
)


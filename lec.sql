drop database if exists lec;
create database lec character set utf8mb4 COLLATE utf8mb4_croatian_ci;
use lec;

alter database cesar_pp22 default character set utf8mb4;

create table operator(
    id int not null primary key auto_increment,
    email varchar(50) not null,
    password char(60) not null,
    name varchar(50) not null,
    surname varchar(50) not null,
    role varchar(10) not null
);

insert into operator values(null,'dominik@edunova.hr','$2y$12$GlcdCH7Xrn/Agx2ddZyHFe2qUQsxN/qeYNDym.e9Mf6ze7AFZtWr2 ','Admin','Dominik','admin');

insert into operator values(null,'op@edunova.hr','$2y$12$GlcdCH7Xrn/Agx2ddZyHFe2qUQsxN/qeYNDym.e9Mf6ze7AFZtWr2 ','Operator','Edunova','op');

create table matchday(
    id int not null primary key auto_increment,
    caster int not null, #FK
    time datetime
);

create table caster(
	id int not null primary key auto_increment,
	name varchar(50),
	surname varchar(50),
	country varchar(50),
	nickname varchar(50) not null,
	iban varchar(50),
	email varchar(50)
	
);


create table organization(
	id int not null primary key auto_increment,
	name varchar(50) not null,
	contact varchar(50),
	twitter varchar(50)
);

create table coach(
	id int not null primary key auto_increment,
	name varchar(50),
	surname varchar(50),
	nickname varchar(50) not null,
	country varchar(50),
	organization int not null,
	iban varchar(50),
	email varchar(50)
);

create table player(
	id int not null primary key auto_increment,
	name varchar(50),
	surname varchar(50),
	country varchar(50),
	nickname varchar(50) not null,
	organization int not null,
	iban varchar(50),
	lane varchar(50),
	email varchar(50),
	substitute boolean
);

create table game(
	id int not null primary key auto_increment,
	organization int not null,
	matchday int not null
);

alter table game add foreign key (organization) references organization(id);
alter table game add foreign key (matchday) references matchday(id);

alter table matchday add foreign key (caster) references caster(id);

alter table player add foreign key (organization) references organization(id);
alter table coach add foreign key (organization) references organization(id);

insert into organization (name,contact,twitter) values
('G2 Esports', 'info@g2esports.com', '@G2esports'),
('Rogue', 'roguenation@rogue.gg', '@ROGUE'),
('MAD Lions','hello@madlions.com', '@MADLions_LoLEN' ),
('Fnatic', 'contact@fnatic.com', '@FNATIC'),
('SK Gaming', 'info@sk-gaming.com', '@SKGaming'),
('Vitality', 'support@vitality.gg', '@TeamVitality'),
('Misfits Gaming', 'info@misfitsgaming.gg','@MisfitsGG'),
('EXCEL','info@excelesports.com','@EXCEL'),
('Astralis','', '@Astralisgg'),
('Schalke 04', 'post@schalke04.de','@S04esports');


insert into player (name, surname,country, nickname, organization, lane, substitute) values
('Martin','Hansen','Denmark','Wunder',1,'Top',0),
('Marcin','Jankowski','Poland','Jankos',1,'Jungle',0),
('Rasmus','Winther','Denmark','Caps',1,'Mid',0),
('Martin','Larsson','Sweden','Rekkles',1,'Bot',0),
('Mihael','Mehle','Slovenia','Mikyx',1,'Support',0),
('Kristoffer','Pedersen','Denmark','P1noy',1,'Bot',1),
('Andrei','Pascu','Romania','Odoamne',2,'Top',0),
('Kacper','Sloma','Poland','Inspired',2,'Jungle',0),
('Emil','Larsson','Sweden','Larssen',2,'Mid',0),
('Steven','Liv','France','Hans sama',2,'Bot',0),
('Adrian','Trybus','Poland','Trymbi',2,'Support',0),
('Nico','Jannet','Germany','Blueknight',2,'Mid',1),
('İrfan','Tükek','Turkey','Armut',3,'Top',0),
('Javier','Batalla','Spain','Elyoya',3,'Jungle',0),
('Marek','Brázda','Czech Republic','Humanoid',3,'Mid',0),
('Matyáš','Orság','Czech Republic','Carzzy',3,'Bot',0),
('Norman','Kaiser','Germany','Kaiser',3,'Support',0),
('Gabriël','Rau','Belgium','Bwipo',4,'Top',0),
('Oskar','Boderek','Poland','Selfmade',4,'Jungle',0),
('Yasin','Dinçer','Belgium','Nisqy',4,'Mid',0),
('Elias','Lipp','Germany','Upset',4,'Bot',0),
('Zdravets','Galabov','Bulgaria','Hylissang',4,'Support',0),
('Janik','Bartels','Germany','Jenax',5,'Top',0),
('Kristian','Hansen','Denmark','TynX',5,'Jungle',0),
('Ersin','Gören','Belgium','Blue',5,'Mid',0),
('Jean','Massol','France','Jezu',5,'Bot',0),
('Erik','Wessén','Sweden','Treatz',5,'Support',0),
('Marc','Behrend','Germany','Canee',5,'Jungle',1),
('Thomas','Huber','Germany','Bertho',5,'Support',1),
('Mathias','Jensen','Denmark','Szygenda',6,'Top',0),
('Duncan','Marquet','France','Skeanz',6,'Jungle',0),
('Aljoša','Kovandžić','Serbia','Milica',6,'Mid',0),
('Juš','Marušić','Slovenia','Crownshot',6,'Bot',0),
('Labros','Papoutsakis','Greece','Labrov',6,'Support',0),
('Shin','Tae-min','South Korea','HiRit',7,'Top',0),
('Iván','Díaz','Spain','Razork',7,'Jungle',0),
('Vincent','Berrié','France','Vetheo',7,'Mid',0),
('Kasper','Kobberup','Denmark','Kobbe',7,'Bot',0),
('Oskar','Bogdan','Poland','Vander',7,'Support',0),
('Tobiasz','Ciba','Poland','Agresivoo',7,'Top',1),
('Petr','Haramach','Czech Republic','denyk',7,'Support',1),
('Felix','Hellström','Sweden','Kryze',8,'Top',0),
('Daniel','Hockley','United Kingdom','Dan',8,'Jungle',0),
('Pawel','Szczepanik','Poland','Czekolad',8,'Mid',0),
('Patrik', 'Jírů','Czech Republic','Patrik',8,'Bot',0),
('Tore','Eilertsen','Norway','Tore',8,'Support',0),
('Matti','Sormunen','Finland','Whiteknight',9,'Top',0),
('Nikolay','Akatov','Russia','Zanzarah',9,'Jungle',0),
('Carl','Boström','Sweden','MagiFelix',9,'Mid',0),
('Jesper','Strömberg','Sweden','Jeskla',9,'Bot',0),
('Hampus','Abrahamsson','Sweden','promisq',9,'Support',0),
('Sergen','Çelik','Germany','Broken Blade',10,'Top',0),
('Erberk','Demir','Germany','Gilius',10,'Jungle',0),
('Felix','Braun','Germany','Abbedagge',10,'Mid',0),
('Matúš','Jakubčík','Slovakia','Neon',10,'Bot',0),
('Dino','Tot','Croatia','LIMIT',10,'Support',0);

insert into coach(name, surname, country, nickname, organization) values
('Fabian','Lohmann','Germany','GrabbZ',1),
('Marcus','Blom','Sweden','Blumigan',2),
('Simon','Payne','United Kingdom','fredy122',2),
('James','MacCormack','United Kingdom','Mac',3),
('Cristophe','van Oudheusden','Belgium','Kaas',3),
('Jakob','Mebdi','Sweden','YamatoCannon',4),
('Jesse','Le','Denmark','Jesiz',5),
('Hadrien','Forestier','France','Duke',6),
('Louis-Victor','Legendre','France','Mephisto',6),
('Maurice','Stückenschneider','Germany','Amazing',7),
('Joey','Steltenpool','Netherlands','YoungBuck',8),
('Baltat','Alin-Ciprian','Romania','AoD',9),
('Dylan','Falco','Canada','Dylan Falco',10);

insert into caster(name,surname,country,nickname) values
('Marc','Lamont','United Kingdom','Caedrel'),
('Christy','Frierson','United States','Ender'),
('Daniel','Drakos','United States','Drakos'),
('Aaron','Chamberlain','United States','Medic'),
('Trevor','Henry','South Africa','Quickshot'),
('Andrew','Day','United Kingdom','Vedius'),
('Eefje','Depoortere','Belgium','sjokz');



select * from caster;
select * from player;
select * from matchday;
select * from game;
select matchday from game;
select organization from game where matchday=1;


insert into matchday(caster, time) values
(2,'2020-10-19 17:00:00'),
(4,'2021-04-15 17:00:00');

insert into game(organization,matchday) values
(2, 1),
(3, 1),
(5, 2),
(6, 2);
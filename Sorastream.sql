CREATE TABLE usuarios (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Nombre` varchar(30) NOT NULL,
  `Nick` varchar(65) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Tarjeta_Credito` bigint(19) DEFAULT NULL,
  `Rol` int(3) NOT NULL
);

INSERT INTO usuarios (Nombre, Nick, Email, Password, Rol) VALUES
('Carlos', 'car640', 'ctardior02@gmail.com', '1234', 2),
('Adrian', 'koib0a', 'adrianprasio@gmail.com', '1234', 1),
('Angel', 'gelet', 'angel@gmail.com', '1234', 0);

CREATE TABLE animes (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `Categoria` varchar(30) NOT NULL
);

INSERT INTO animes (Titulo, Descripcion, Categoria) VALUES
('Dragon Ball Z', 'Dragon Ball Super continúa la legendaria saga de Dragon Ball, llevando a los fanáticos a nuevas y emocionantes aventuras en el vasto universo de Dragon Ball. Después de los eventos de la batalla con Majin Buu, Goku y sus amigos se encuentran enfrentando desafíos aún mayores, incluidos dioses de la destrucción, universos paralelos y seres cósmicos de increíble poder. Con nuevas transformaciones, personajes y enemigos formidables.', 'Shonen'),
('Naruto', '', 'Shonen'),
('One Piece', '', 'Shonen'),
('Fairy Tail', 'Fairy Tail sigue las emocionantes aventuras del gremio de magos más famoso de Fiore: Fairy Tail. La historia gira en torno a Lucy Heartfilia, una joven maga celestial que sueña con unirse a Fairy Tail y vivir sus propias aventuras. Pronto, se encuentra con Natsu Dragneel, un mago de fuego que resulta ser miembro de Fairy Tail, y juntos se unen a otros magos poderosos en misiones llenas de acción, amistad y un sinfín de desafíos. A lo largo de un viaje largo y emocionante.', 'Shonen'),
('Digimon', '', 'Shonen'),
('TsukimichiMoonlit', '', 'Seinen'),
('BlackCover', 'En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.', 'Seinen'),
('ChainsawMan', 'La historia de Chainsaw Man se desarrolla en un mundo ficticio habitado no sólo por humanos, sino también por demonios llamados Akuma. Los demonios nacen en el infierno y poseen la capacidad de adoptar la forma y las características de los peores temores humanos. Diablos de pistola, diablos de serpiente, diablos de zorro: las posibilidades son realmente infinitas. Pero cuanto más común o extendido es el miedo, más fuerte es el demonio que lo personifica, y viceversa.', 'Seinen'),
('DrStone', 'Dr. Stone sigue la historia de Senku Ishigami, un brillante científico que despierta miles de años en el futuro después de que toda la humanidad ha sido petrificada por una misteriosa luz. Decidido a reconstruir la civilización desde cero, Senku utiliza su conocimiento científico para revivir a la humanidad y enfrentarse a los desafíos del mundo post-apocalíptico. Con la ayuda de sus amigos y aliados, Senku busca descubrir los secretos del pasado.', 'Seinen'),
('Frieren', 'La historia sigue a la maga elfa Frieren, una exmiembro del grupo de aventureros que derrotó al Rey Demonio y restauró la armonía en el mundo después de una búsqueda de diez años. En el pasado, el grupo heroico incluía a Frieren, el guerrero enano Eisen y el sacerdote humano Heiter. Antes de separarse, observan una lluvia de meteoritos que ocurre una vez cada cincuenta años. Frieren acepta volver a verlos y darles una mejor vista la próxima vez que ocurra el evento celestial.', 'Seinen'),
('Hell\'s Paradise', 'Hell\'s Paradise es una serie anime que sigue al ninja Gabimaru, que es condenado a muerte después de llevar una vida empapada de sangre. Sin embargo, todos sus intentos de ejecutarlo fracasan inexplicablemente. Por eso le pide la ayuda a un miembro novato de un famoso clan de vergudos para que tome su vida. En esta isla llena de demonios y peligros mortales, los convictos deben luchar por su supervivencia en este mundo en el que lo unico que importa e sobrevivir', 'Isekai'),
('Jujutsu Kaisen', '', 'Isekai'),
('Kimetsu No Yaiba', '', 'Isekai'),
('Kingdom', '', 'Isekai'),
('One Punch Man', '', 'Isekai'),
('Sengoku Youko', '', 'Seinen'),
('Classroom Of The Elite', ' ', 'Seinen'),
('My Hero Academia', ' ', 'Shonen'),
('Spy x Family', ' ', 'Isekai');

CREATE TABLE capitulos (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Num_Episodio` int(30) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Temporada` int NOT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Duracion` int(30) NOT NULL,
  `ID_Anime` int NOT NULL,
  FOREIGN KEY (`ID_Anime`) REFERENCES animes (`ID`)
);

CREATE TABLE favoritos (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ID_Usuario` int NOT NULL,
  `ID_Anime_Fav` int NOT NULL,
  FOREIGN KEY (`ID_Usuario`) REFERENCES usuarios (`ID`),
  FOREIGN KEY (`ID_Anime_Fav`) REFERENCES animes (`ID`)
);

INSERT INTO favoritos (ID_Usuario, ID_Anime_Fav) VALUES 
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4);

CREATE TABLE historial (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Fecha` datetime NOT NULL,
  `anime` int NOT NULL,
  `usuario` int NOT NULL,
  FOREIGN KEY (`usuario`) REFERENCES usuarios (`ID`),
  FOREIGN KEY (`anime`) REFERENCES animes (`ID`)
);

INSERT INTO historial (Fecha, anime, usuario) VALUES 
('2016-01-01 00:00:00', 1, 1),
('2016-01-02 00:00:00', 2, 1),
('2016-01-03 00:00:00', 3, 1),
('2016-01-04 00:00:00', 4, 1),
('2016-01-05 00:00:00', 1, 2),
('2016-01-06 00:00:00', 2, 2),
('2016-01-07 00:00:00', 3, 2),
('2016-01-08 00:00:00', 4, 2);

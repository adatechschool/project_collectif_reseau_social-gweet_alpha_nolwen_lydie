CREATE TABLE `socialnetwork`.`boardgames` 
    (`id` INT(10) NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR (100) NOT NULL , 
    `min_age` INT(2) NOT NULL ,
    `min_players` INT(2) NOT NULL ,
    `max_players` INT(3) NOT NULL ,
    `type` VARCHAR(50),
    `duration` INT(4) NOT NULL COMMENT 'in minutes' ,
    `creator` VARCHAR(255) NOT NULL ,
    PRIMARY KEY (`id`)) 
    ENGINE = InnoDB; 


INSERT INTO `boardgames` (name, min_age, min_players, max_players, type, duration, creator) 
VALUES 
('7 wonders', 10, 2, 7, 'stratégie', 40, 'Antoine Bauza'),
('Dixit', 8, 3, 6, 'créativité', 60, 'Jean-Louis Roubira'), 
('Cluedo', 8, 3, 6, 'déduction', 60, 'Anthony Pratt'),
('Carcassonne', 8, 2, 5, 'stratégie', 60, 'Klaus-Jürgen Wrede'),
('Code Names', 14, 2, 8, 'déduction', 15, 'Vlaada Chvátil'), 
('Saboteur', 9, 3, 10, 'stratégie', 60, 'Frederic Moyersoen'), 
('Blanc Manger Coco', 18, 3, 12, 'ambiance', 60, 'Louis Roudaut'), 
('La Chose', 14,4,12,'bluff',30,'Antonio Ferrara');

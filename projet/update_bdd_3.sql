ALTER TABLE `boardgames` ADD `images` VARCHAR() NULL AFTER `description`; 

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/7Wonders.jpeg?raw=true
")
WHERE name = '7 wonders' ;

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/LaChose.jpeg?raw=true
")
WHERE name = 'La Chose' ;

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/Dixit.jpg?raw=true
")
WHERE name = 'Dixit' ;

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/Carcassonne.jpg?raw=true
")
WHERE name = 'Carcassonne';

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/Codenames.jpg?raw=true
")
WHERE name = 'Code Names';

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/Saboteur.jpg?raw=true
")
WHERE name = 'Saboteur';

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/BlancMangerCoco.jpg?raw=true
")
WHERE name = 'Blanc Manger Coco';

UPDATE boardgames
SET images = ("https://github.com/adatechschool/project_collectif_reseau_social-gweet_alpha_nolwen_lydie/blob/master/images-pour-%20boardgames/Cluedo.jpg?raw=true
")
WHERE name = 'Cluedo'; 
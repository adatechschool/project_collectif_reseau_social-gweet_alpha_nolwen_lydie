ALTER TABLE `boardgames` ADD `description` VARCHAR(1000) NULL AFTER `creator`; 

UPDATE boardgames
SET description = ("
7 Wonders vous propose de prendre la tête d’une prestigieuse civilisation et de la faire prospérer jusqu’à la victoire. C'est un jeu de cartes avec des règles accessibles et le matériel est facile à mettre en place pour des parties rapides et rythmées.
Afin de développer sa cité, les joueurs auront le choix entre 4 chemins de développement différents : Le militaire, le scientifique, le commerce et le civil.")
WHERE name = '7 wonders' ;

UPDATE boardgames
SET description = ("
Vous faites partie de l’expédition de sauvetage envoyée sur l’île récemment émergée de R’lyeh pour enquêter et déterminer ce qui est arrivé à l’expédition archéologique. Une violente tempête éclate dès votre arrivée sur l’île et vous oblige à prendre refuge dans une cabane précaire. Rapidement, vous réalisez que cette cabane est l’avant-poste de la première équipe : à l’intérieur, vous trouvez le corps sans vie de Jack, allongé a côté de la radio un revolver à la main.
Au bout du couloir se dresse ce qui semble être la porte de la salle de stockage dont Jack a parlé lors de sa dernière transmission radio. La porte ne tient plus que par une charnière et les planches qui la barricadaient sont éparpillées au sol, brisées en mille morceaux. Au milieu de la salle, le plancher a été arraché, révélant ce qui semble être un puits rempli d’eau souillée. Une odeur nauséabonde s’en échappe.")
WHERE name = 'La Chose' ;

UPDATE boardgames
SET description = ("
Laissez-vous inspirer par ses illustrations poétiques..!
Dixit est un jeu de société qui vous emmène dans un monde onirique où de douces illustrations vous serviront d'inspiration pour de belles envolées poétiques.
")
WHERE name = 'Dixit' ;

UPDATE boardgames
SET description = ("
Partez à la conquête des alentours de Carcassonne dans ce célèbre jeu de tuiles!
Carcassonne est un jeu de tuiles et de stratégie amusant et familial.")
WHERE name = 'Carcassonne';

UPDATE boardgames
SET description = ("
Jouez les espions et retrouvez vos alliés avec des Noms de Code!
Codenames est un jeu d'expression, d'association d'idées et de déduction qui se joue en équipe.")
WHERE name = 'Code Names';

UPDATE boardgames
SET description = ("
Vous voyez des nains partout ? C'est normal avec ce petit jeu de cartes amusant jouable jusqu'à 10...
Saboteur un jeu de cartes et de parcours où chacun cherche à faire gagner son camps sans savoir qui sont ses coéquipiers ou adversaires.")
WHERE name = 'Saboteur';

UPDATE boardgames
SET description = ("
Accompagne l'Apéro depuis 2013 !
Blanc-Manger Coco est un jeu d'apéro terriblement irrévérencieux avec une bonne dose d'humour noir ! ")
WHERE name = 'Blanc Manger Coco';

UPDATE boardgames
SET description = ("
Cluedo est un jeu de société dans lequel les joueurs doivent découvrir parmi eux qui est le meurtrier d'un crime commis dans un manoir anglais, le Manoir Tudor.")
WHERE name = 'Cluedo'; 
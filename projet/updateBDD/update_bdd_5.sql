ALTER TABLE likes
ADD CONSTRAINT post_id_user_id_unique_id UNIQUE (user_id, post_id);

INSERT INTO `posts` (`id`, `user_id`, `content`, `created`, `parent_id`) 
VALUES (NULL, '9', 'J\'adore Citadelles ! Ce jeu de stratégie et de bluff est parfait pour une soirée entre amis ou en famille.
    Les différents personnages et leurs pouvoirs spéciaux offrent une variété de stratégies à explorer, et la construction de 
    votre citadelle ajoute une touche de compétition excitante. Si vous cherchez un jeu de société amusant et intelligent,
    je recommande vivement Citadelles ! #jeuxdesociété #citadelles #stratégie #bluff', '2023-02-22 18:50:13', NULL),
    (NULL, '8', 'Après avoir essayé Tracks, je dois dire que ce jeu ne m\'a pas vraiment convaincu. Bien que l\'idée
    de construire des rails de train pour relier les différentes villes soit intéressante, la mécanique de jeu m\'a s
    emblé un peu trop répétitive et ennuyeuse à la longue. Les décisions à prendre sont souvent limitées, ce qui rend le jeu 
    prévisible et peu stimulant pour les joueurs expérimentés. De plus, le jeu manque de variété et peut sembler lent et 
    monotone. Dans l\'ensemble, Tracks est un jeu qui pourrait plaire à certains joueurs occasionnels, mais qui ne convient 
    pas vraiment aux joueurs à la recherche d\'un défi stimulant et captivant. #jeuxdesociété #Tracks #avisdejeu 
    #critiquedejeu', '2023-02-22 18:54:08', NULL),
    (NULL, '8', 'Il y a tellement de jeux de société excellents sur le marché, mais voici une liste de mes préférés 
    :\r\n\r\n Les Aventuriers du Rail : un jeu de stratégie de placement de trains passionnant qui offre une grande 
    rejouabilité et est facile à apprendre.\r\n\r\n Carcassonne : un jeu de placement de tuiles où vous construisez 
    un paysage médiéval. Les règles sont simples mais le jeu offre une grande profondeur stratégique.\r\n\r\n Pandemic : 
    un jeu coopératif où vous travaillez ensemble pour sauver le monde d\'une épidémie mondiale. C\'est un jeu 
    intense et gratifiant qui vous oblige à travailler en équipe.\r\n\r\n Splendor : un jeu de développement de moteurs 
    où vous collectez des gemmes et des cartes pour acheter des cartes plus précieuses. C\'est un jeu rapide, facile à 
    apprendre et très satisfaisant.\r\n\r\n Codenames : un jeu de mots où vous devez faire deviner à votre équipe les mots
    qui vous ont été assignés. C\'est un jeu amusant et stimulant qui met à l\'épreuve votre esprit d\'équipe et votre 
    créativité.\r\n\r\n Azul : un jeu de placement de tuiles où vous créez des mosaïques de carreaux. C\'est un jeu simple
    mais très beau et addictif.\r\n\r\nCe ne sont là que quelques-uns de mes jeux de société préférés, mais il y en a 
    tellement d\'autres que j\'aime tout autant. Chacun a sa propre personnalité et son propre charme, ce qui rend chaque
    jeu unique et amusant à sa manière. #jeuxdesociété #avisdejeu #critiquedejeu', '2023-02-22 18:55:43', NULL), 
    (NULL, '9', 'Il est temps de parler de quelque chose qui me tient à cœur en tant que critique de jeu : les packaging 
    de jeu disproportionnés par rapport au matériel de jeu. Les boîtes de jeux de société trop grandes par rapport au 
    contenu sont un problème qui affecte l\'environnement et la praticité du rangement et du transport. Les éditeurs de
    jeux devraient être plus conscients de cet impact et les consommateurs devraient choisir des jeux avec des emballages
    plus raisonnables pour contribuer à réduire le gaspillage inutile. #jeuxdesociété #environnement #packaging',
    '2023-02-22 18:59:04', NULL), 
    (NULL, '9', 'J\'ai découvert le jeu Unanimo lors d\'une soirée chez des amis, et je dois dire que 
    j\'ai été agréablement surpris ! Nous étions un grand groupe et cherchions un jeu qui puisse être joué par tout
    le monde. Unanimo s\'est révélé être la solution idéale, avec ses cartes amusantes et son concept simple mais 
    efficace. Nous avons passé des heures à rire et à deviner les mots, c\'était une soirée mémorable ! Depuis ce jour,
    Unanimo est devenu un incontournable pour toutes nos soirées jeux. #unanimo #jeudecartes #anecdotejeu', 
    '2023-02-22 19:04:24', NULL);

    INSERT INTO `users` (`id`, `email`, `password`, `alias`) VALUES (NULL, 'admin@admin.fr', '21232f297a57a5a743894a0e4a801fc3', 'administrateur')


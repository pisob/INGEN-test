############  About

Pour le test j'ai utilisé :
  - le Framework CodeIgniter version  4
  - API générateur de données aléatoires est https://randomuser.me
  - Bootstrap pour CSS
  - Pour améliorer l'interaction d'affichage avec le DB j'ai combiné Angular, Jquery et AJAX
  
 ############  How to use

1- installer CodeIgniter 4

2- copier les répertoires app et public dans  le racine de votre  CodeIgniter 4

3- ajouter la librairie dompdf

en exécuter la commande ci-dessous :

composer require dompdf/dompdf
        
4- création de table etudiant

4-a) créer la class du migration avec la commande :

 php spark migrate:create etudiants
 
4-b) créer la table etudiant avec la commande ci-dessous :

php spark migrate
          
5- Maintenant aller dans votre site de test

ex :  https://ingtest.ekawoa.com/public/etudiants

n'oublier pas le mot etudiants à la fin du  votre url public

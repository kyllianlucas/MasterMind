# MasterMind en PHP

## Description

Ce projet implémente un jeu de MasterMind en ligne à un joueur contre l’ordinateur. L'ordinateur génère une combinaison secrète de 4 chiffres entre 1 et 6, et le joueur doit deviner cette combinaison. L'ordinateur donne des indices sous forme de pions blancs et rouges pour indiquer les chiffres bien placés et mal placés respectivement.

## Fonctionnalités

- Génération aléatoire de la combinaison secrète.
- Interface de soumission des propositions du joueur.
- Calcul des pions blancs et rouges pour chaque proposition.
- Affichage des propositions précédentes et de leurs résultats.
- Réinitialisation de la partie après une victoire.

## Installation

1. Clonez le dépôt :
   ```bash
   git clone (https://github.com/kyllianlucas/MasterMind)

2. Lancer en local :
    j'ai reussi a le lancer depuis le localhost et depuis le port 12345

## Problème rencontrer 
3. Choix technique: 

    Utilisation des sessions PHP pour gérer la persistance de la combinaison secrète et des tentatives du joueur.
    Structure de code orientée objet pour une meilleure maintenabilité.
    Utilisation de Bootstrap pour un rendu HTML/CSS propre et réactif.

4. Temps Passé:
        environ 8h

5. Difficultés rencontrées:
   
    Gestion des sessions pour persister les données entre les requêtes.
    Comparaison correcte des combinaisons pour calculer les pions blancs et rouges.
    Lancer le Mistermind sur le port demandé

6. Source 
    j'ai été chercher du code sur youtube et j'ai regardé sur les forum et j'ai un peu utilisé ChatGPT pour comprendre le code que j'utilisais
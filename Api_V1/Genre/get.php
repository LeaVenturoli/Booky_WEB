<?php

$genres = array(
    "Roman de littérature contemporaine",
    "Roman sentimental",
    "Roman de mœurs",
    "Roman jeunesse",
    "Roman d’apprentissage",
    "Roman d’anticipation ou de science-fiction",
    "Roman Fantasy",
    "Roman d’aventure",
    "Roman humoristique",
    "Roman philosophique",
    "Roman policier",
    "Roman Noir",
    "Roman Thriller",
    "Roman historique",
    "Roman d’horreur",
    "Roman feel-good",
    "Le conte",
    "La nouvelle",
    "Le scénario",
    "L’auto-biographie",
    "La biographie",
    "Le Memoir",
    "Le livre religieux",
    "La bande-dessinée",
    "Le Manga",
    "La fable",
    "Récits de voyage",
    "Mémoires",
    "Correspondances",
    "Poésie en prose",
    "Poésie en vers",
    "Chanson",
    "Ballade",
    "Calligramme",
    "Chant Royal",
    "Épigramme",
    "Ode",
    "Tragédie",
    "Comédie",
    "Drame",
    "Farce",
    "Le guide pratique",
    "L’essai",
    "Le pamphlet",
    "Livres de recettes de cuisine",
);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($genres, JSON_UNESCAPED_UNICODE);

<?php


namespace classes\business\process;

use classes\AutoLoader;
use classes\business\manager\RecipeManager;

AutoLoader::register();

class SuggestionBuilder implements RecipesBuilder
{
    /**
     * @var RecipeManager
     */
    private $recipe_manager;

    /**
     * @var array
     */
    private $recipes;

    /**
     * @var array
     */
    private $recipes_viewed_session;

    /**
     * @var int
     */
    private $id_client;

    /**
     * SuggestionBuilder constructor.
     * @param array $recipes_viewed_session
     */
    public function __construct($recipes_viewed_session, $id_client)
    {
        $this->recipe_manager = new RecipeManager();
        $this->recipes = array();
        $this->recipes_viewed_session = $this->recipes_viewed_session;
        $this->id_client = $id_client;
    }

    public function buildRecipes()
    {
        // TODO: Implement buildRecipes() method.

        /**
         * --------------Etape 1 - Récupérations des trois meilleurs catégories selon plusieurs critères--------------
         *
         * Rm : Les trois catégories de chaque critères seront stockés dans des tableaux et seront triés par ordre de priorité
         *      (i.e la premiere aura la plus grande priorité .... la derniere la plus petite priorité)
         *
         * 1) Recuperation des trois categories les plus visualisés durant la session à l'aide du tableau $recipes_viewed_session
         * 2) Récuperation des trois catégories les plus enregistrés par l'utilisateur à l'aide de $id_account
         * 3) Récuperation des trois catégories les mieux évalués par l'utilisateur à l'aide de $id_account
         *
         * Rm : Pour le tableau « évalués » la méthode est différente puisqu’il faut prendre en considération l’évaluation globale des livres.
        •
         * 4) Récupération aléatoire de trois catégories des préférences personnelles qui sont celles que l’utilisateur doit choisir lors de son
         *    inscription sur le site web.
         *
         * --------------Etape 2 - Création du tableau "BROBCU" ("Best Recipes Of Best Categories User)--------------
         *
         * 1)On calcule l’ensemble des combinaisons possibles de trois catégories avec les trois tableaux précédemment créés
         * 2)Nous avons à la fin de ces calcules, les trois meilleurs catégories ainsi que leurs recettes respectifs
         *
         * --------------Etape 3 - Trie de 100 ingrédients par ordre de priorité selon le même procédé qu'aux étapes précédentes
         *
         * 1) trie des 100 ingrédients par ordre de priorité des recettes visualisés par l'utilisateur
         * 2) trie des 100 ingrédients par ordre de priorité des recettes enregistrés par l'utilisateur
         * 3) trie des 100 ingrédients par ordre de priorité des recettes évalués par l'utlisateur
         *
         * Rm: Pour les recettes évalués nous, trions d'abord les recettes par rapport à leur note
         *
         * --------------Etape 4 - Fusion des trois tableaux d'ingrédients--------------
         *
         * --------------Etape 5 - Création du table "BRWBI" (Best Recipes With Best Ingredients)--------------
         *
         * Maintenant nous allons trier par ordre de priorité l'ensemble des recettes des trois meilleurs catégories
         * selon les ingrédients sélectionner.
         *
         * --------------Etape 6 - Verification des informations nutritionnelles--------------
         *
         * On effectue la moyenne de chaque information nutritionnelle (calories, glucides, lipides etc...) selon les
         * recettes visualisés, enregistrés et évalués par l'utilisateur.
         *
         * --------------Etape 7 - Création des suggestions de recette--------------
         *
         * Maintenant nous avons :
         *          - Le tableau "BRWBI" qui contient les recette des trois meilleurs catégories de l'utilisateur triés
         *              par ordre de priorité (selon la catégorie et les ingrédients)
         *          - Les moyennes des informations nutritionnelles.
         *
         * Nous allons maintenant triés ces recettes en comparant leurs informations nutritionnelles et celles des moyennes.
         *
         * --------------Etape finale - Filtrage des recettes --------------
         *
         * Nous trions les recettes à suggérées en retirant les recettes redondantes / déja visualisé - noté - enregistré par l'utilisateur
         *
         *
         *
         */
    }

    public function getRecipes(){
        return $this->recipes;
    }
}
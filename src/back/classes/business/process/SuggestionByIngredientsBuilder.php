<?php


class SuggestionByIngredientsBuilder implements RecipesBuilder
{
    /**
     * @var array
     */
    private $ingredients_include = array();
    /**
     * @var array
     */
    private $ingredients_exclude = array();
    /**
     * @var array
     */
    private $recipes = array();

    /**
     * SuggestionByIngredientsBuilder constructor.
     * @param array $ingredients_include
     * @param array $ingredients_exclude
     */
    public function __construct($ingredients_include, $ingredients_exclude)
    {
        $this->ingredients_include = $ingredients_include;
        $this->ingredients_exclude = $ingredients_exclude;
    }

    /**
     * @param $session
     */
    public function buildRecipes($session=null)
    {
        $best_cluster = DecisionTreeCluster::getCluster($this->ingredients_include);
        $recipes_ingredients = RecipePersistence::getRecipesByIngredientsAndCluster($best_cluster, $this->ingredients_include,
            $this->ingredients_exclude);
    }

    /**
     * @return array
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}
<?php

namespace classes\business\process;

use classes\AutoLoader;
AutoLoader::register();

interface RecipesBuilder
{
    public function buildRecipes(array $session);
    public function getRecipes():array;
}
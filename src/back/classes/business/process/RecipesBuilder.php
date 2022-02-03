<?php

namespace classes\business\process;

use classes\AutoLoader;
AutoLoader::register();

interface RecipesBuilder
{
    public function buildRecipes();
    public function getRecipes();
}
<?php

interface RecipesBuilder
{
    public function buildRecipes(array $session);
    public function getRecipes():array;
}
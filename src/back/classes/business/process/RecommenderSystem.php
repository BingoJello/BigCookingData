<?php

/**
 * Interface RecommenderSystem
 * @author arthur mimouni
 */
interface RecommenderSystem
{
    public function buildRecipes($session);
    public function getRecipes();
}
<?php

/**
 * Interface RecommenderSystem
 * @author arthur mimouni
 */
interface RecommenderSystem
{
    /**
     * @param array $session
     * @return mixed
     */
    public function buildRecipes($session);

    /**
     * @return mixed
     */
    public function getRecipes();
}
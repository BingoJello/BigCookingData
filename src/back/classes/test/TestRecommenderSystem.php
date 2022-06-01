<?php

class TestRecommenderSystem
{
    /**
     * @var Client $client
     */
    private $client;
    /**
     * @var array
     */
    private $recipes;

    private $session;

    /**
     * ContentBasedRecommenderSystem constructor.
     * @param string $mail
     * @param string $password
     * @throws Exception
     */
    public function __construct()
    {
        $this->client = ClientPersistence::getClient("client@gmail.com", "azertyuiop");
    }

    public function testRecommenderSystem(){
        try {
            $_SESSION['client'] = $this->client;
            $_SESSION['visualization'] = [];
            $recipes = RecipeFacade::getSuggestedRecipes($this->client, $_SESSION);
            foreach ($recipes as $recipe){
                var_dump($recipe);
            }
        } catch (Exception $e) {
            var_dump($e);
        }
    }

}
<?php

/**
 * Class ClientFacade
 * @author arthur mimouni
 */
class ClientFacade
{
    /**
     * @brief Enregistre un client
     * @param string $pseudo
     * @param string $civility
     * @param string $mail
     * @param string $password
     * @param string $password_confirm
     * @param string $lastname
     * @param string $firstname
     * @param string $ingredients
     * @throws Exception
     */
    public static function registerInscriptionClient($pseudo,$civility,$mail,$password,$password_confirm,$lastname,
                                                     $firstname,$ingredients){
        RegistrationInscription::registerInscriptionClient($pseudo,$civility,$mail,$password,$password_confirm,$lastname,
            $firstname,$ingredients);
    }

    /**
     * @brief Connection au profil d'un client
     * @param string $email
     * @param string $password
     * @throws Exception
     */
    public static function connexionToProfil($email,$password)
    {
        $client = ClientPersistence::getClient($email, $password);

        if (null == $client) {
            header('location:./connexion.php?error=Erreur dauthentification. Vérifier votre mail ou mot de passe.');
        }
        else {
            $_SESSION['client'] = serialize($client);
            $_SESSION['algo'] = "content";
            header('location:./profil.php');
        }
    }

    /**
     * @brief Mets à jour les ingrédients de préférences d'un client
     * @param Client $client
     * @param array $ingredients
     * @return mixed
     */
    public static function updatePreferencesIngredients($client, $ingredients){
        ClientPersistence::updatePreferencesIngredientsLabelClient($client->getId(), $ingredients);

        $process_text_ingredient = new ProcessTextIngredient($ingredients, ';', true);
        $process_text_ingredient->build();

        $id_ingredients = RecipePersistence::getIdIngredientByWord($process_text_ingredient->getWords());
        ClientPersistence::deleteIngredientPreferencesClient($client->getId());

        if(false === empty($id_ingredients)){
            ClientPersistence::insertIngredientsPreferences($client->getId(), $id_ingredients);
        }
        $client->setPreferencesIngredientsLabel($ingredients);
        $client->setPreferencesIngredients(ClientPersistence::getPreferencesIngredientsClient($client->getId()));
        $_SESSION['client'] = serialize($client);

        return $client;
    }

    /**
     * @brief Mets à jour le mot de passe d'un client
     * @param int $id_client
     * @param string $password
     */
    public static function updatePasswordClient($id_client, $password){
        ClientPersistence::updatePasswordClient($id_client, $password);
    }

    /**
     * @brief Insert la note et/ou le commentaire d'un client
     * @param int $id_recipe
     * @param int $id_client
     * @param float $rating
     * @param string $date
     * @param string $commentary
     */
    public static function insertRatingAndCommentary($id_recipe, $id_client, $rating, $date, $commentary = ''){
        ClientPersistence::insertCommentaryAndRating($id_recipe, $id_client, $rating, $date, $commentary);
    }

    /**
     * @brief Vérifie si un client a déjà évalué une recette
     * @param int $id_client
     * @param int $id_recipe
     * @return bool
     */
    public static function hasAlreadyRatingRecipe($id_client, $id_recipe){
        return ClientPersistence::hasAlreadyRatingRecipe($id_client, $id_recipe);
    }
}
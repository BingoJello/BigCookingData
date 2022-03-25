<?php

/**
 * Class ClientFacade
 * @author arthur mimouni
 */
class ClientFacade
{
    /**
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
            header('location:./profil.php');
        }
    }

    /**
     * @param Client $client
     * @param array $ingredients
     * @return mixed
     */
    public static function updatePreferencesIngredients($client, $ingredients){
        $ingredients = explode(";", $ingredients);
        array_pop($ingredients);
        ClientPersistence::updateIngredientsPreferencesClient($client->getId(), $ingredients);
        $client->setPreferencesIngredients(ClientPersistence::getPreferencesIngredientsClient($client->getId()));
        $_SESSION['client'] = serialize($client);

        return $client;
    }

    /**
     * @param int $id_client
     * @param string $password
     */
    public static function updatePasswordClient($id_client, $password){
        ClientPersistence::updatePasswordClient($id_client, $password);
    }

    /**
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
     * @param int $id_client
     * @param int $id_recipe
     */
    public static function insertRecord($id_client, $id_recipe){
        ClientPersistence::insertRecording($id_recipe, $id_client);
    }

    /**
     * @param int $id_client
     * @param int $id_recipe
     * @return bool
     */
    public static function hasAlreadyRatingRecipe($id_client, $id_recipe){
        return ClientPersistence::hasAlreadyRatingRecipe($id_client, $id_recipe);
    }
}
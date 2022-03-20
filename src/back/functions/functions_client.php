<?php
/**
 * @param string $pseudo
 * @param string $civility
 * @param string $mail
 * @param string $password
 * @param string $password_confirm
 * @param string $lastname
 * @param string $firstname
 * @param array $ingredients
 * @throws Exception
 */
function registerInscriptionClient($pseudo,$civility,$mail,$password,$password_confirm,$lastname,$firstname,$ingredients)
{
    if("0" != $civility) {
        if(0 != (strlen($pseudo)) AND (0 != strlen($mail))){
            if((7 < strlen($password)) AND (31 > strlen($password))) {
                if($password_confirm == $password) {
                    if(true === ClientPersistence::findClientExist($mail, $password)) {
                        $client = ClientPersistence::getClient($mail, $password);
                        header('location:./registration.php?error=Le compte contenant le pseudo "'.$client->getPseudo().'" possède cet mail et ce mot de passe. Veuillez choisir un autre email.');
                        return;
                    }
                    if(true === ClientPersistence::findClientExist($mail)) {
                        header('location:./registration.php?error=Ce mail existe déjà. Veuillez en choisir un autre.');
                        return;
                    }
                    if(true == ClientPersistence::findClientExist(false, false, $pseudo)) {
                        header('location:./registration.php?error=Ce pseudo existe déjà. Veuillez en choisir un autre.');
                        return;
                    }

                    $id_client = ClientPersistence::getLastIdClient() + 1;

                    $result = ClientPersistence::insertClient(addslashes($id_client), addslashes($firstname), addslashes($lastname)
                        , $civility, addslashes($pseudo), addslashes($mail), addslashes($password));

                    if($result) {
                        $ingredients = explode(";", $ingredients);
                        array_pop($ingredients);
                        $id_ingredients = RecipePersistence::getIdIngredientByName($ingredients);
                        ClientPersistence::insertIngredientsPreferences($id_client, $id_ingredients);
                        $client = ClientPersistence::getClient($mail, $password);
                        $client->setPreferencesIngredients(ClientPersistence::getPreferencesIngredientsClient($client->getId()));
                        $_SESSION['client'] = serialize($client);

                        header('location:./profil.php');
                    }else{
                        header('location:./registration.php?error=Il y a eu un problème durant l\'inscription. Veuillez recommencer votre inscription.');
                        return;
                    }
                }else{
                    header('location:./registration.php?error=Veuillez entrer le même mot de passe.');
                    return;
                }
            }else{
                header('location:./registration.php?error=Le mot de passe doit contenir entre 8 et 30 caractères.');
                return;
            }
        }else{
            header('location:./registration.php?error=Le mail et le pseudo ne doivent pas être vides.');
            return;
        }
    }else{
        header('location:./registration.php?error=Veuillez entre votre civilité.');
        return;
    }
}
?>

<?php
/**
 * @param string $email
 * @param string $password
 * @throws Exception
 */
function connexionToProfil($email,$password)
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
?>
<?php
/**
 * @param int $id_client
 * @param array $ingredients
 */
function updatePreferencesIngredients($client, $ingredients){
    $ingredients = explode(";", $ingredients);
    array_pop($ingredients);
    ClientPersistence::updateIngredientsPreferencesClient($client->getId(), $ingredients);
    $client->setPreferencesIngredients(ClientPersistence::getPreferencesIngredientsClient($client->getId()));
    $_SESSION['client'] = serialize($client);

    return $client;
}
?>

<?php
/**
 * @param int $id_client
 * @param string $password
 */
function updatePasswordClient($id_client, $password){
    ClientPersistence::updatePasswordClient($id_client, $password);
}
?>

<?php
/**
 * @param int $id_recipe
 * @param int $id_client
 * @param float $rating
 * @param string $commentary
 */
function insertRatingAndCommentary($id_recipe, $id_client, $rating, $date, $commentary = ''){
    ClientPersistence::insertCommentaryAndRating($id_recipe, $id_client, $rating, $date, $commentary);
}
?>

<?php
/**
 * @param int $id_client
 * @param int $id_recipe
 * @return bool
 */
function hasAlreadyRatingRecipe($id_client, $id_recipe){
    return ClientPersistence::hasAlreadyRatingRecipe($id_client, $id_recipe);
}
?>

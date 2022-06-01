<?php

/**
 * @brief Effectue l'enregistrement d'une inscription d'un client
 * Class RegistrationInscription
 * @author arthur mimouni
 */
class RegistrationInscription
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
                            ClientPersistence::updatePreferencesIngredientsLabelClient($id_client, $ingredients);
                            $process_text_ingredient = new ProcessTextIngredient($ingredients, ';', true);
                            $process_text_ingredient->build();
                            $id_ingredients = RecipePersistence::getIdIngredientByWord($process_text_ingredient->getWords());
                            ClientPersistence::insertIngredientsPreferences($id_client, $id_ingredients);
                            $client = ClientPersistence::getClient($mail, $password);
                            $client->setPreferencesIngredientsLabel($ingredients);
                            $client->setPreferencesIngredients(ClientPersistence::getPreferencesIngredientsClient($client->getId()));
                            $_SESSION['client'] = serialize($client);
                            $_SESSION['algo'] = "content";

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
}
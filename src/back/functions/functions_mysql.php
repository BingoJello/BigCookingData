<?php
function registerInscriptionClient($pseudo,$civility,$mail,$password,$password_confirm,$lastname,$firstname,$ingredients)
{
    if("0" != $civility)
    {
        if(0 != (strlen($pseudo)) AND (0 != strlen($mail))){
            if((7 < strlen($password)) AND (31 > strlen($password)))
            {
                if($password_confirm == $password)
                {
                    if(true === ClientPersistence::findClientExist($mail, $password))
                    {
                        $client = ClientPersistence::getClient($mail, $password);
                        header('location:./registration.php?error=Le compte contenant le pseudo "'.$client->getPseudo().'" possède cet mail et ce mot de passe. Veuillez choisir un autre email.');
                        return;
                    }
                    if(true === ClientPersistence::findClientExist($mail))
                    {
                        header('location:./registration.php?error=Ce mail existe déjà. Veuillez en choisir un autre.');
                        return;
                    }
                    if(true == ClientPersistence::findClientExist(false, false, $pseudo))
                    {
                        header('location:./registration.php?error=Ce pseudo existe déjà. Veuillez en choisir un autre.');
                        return;
                    }

                    $id_client = ClientPersistence::getLastIdClient() + 1;
                    //ClientPersistence::insertIngredientsPreferences($id_client, $ingredients);
                    $result = ClientPersistence::insertClient($id_client, $firstname, $lastname, $civility, $pseudo, $mail, $password);

                    if($result)
                    {
                        $_SESSION['pseudo'] = $pseudo;
                        $_SESSION['email'] = $mail;
                        $_SESSION['password'] = $password;
                        $_SESSION['visualization']=array();

                        header('location:./profil.php');
                    }else{
                        header('location:./registration.php?error=Il y a eu un problème durant l\'inscription. Veuillez recommencer votre inscription.');
                        return;
                    }
                }else{
                    header('location:./inscription.php?error=Veuillez entrer le même mot de passe.');
                    return;
                }
            }else{
                header('location:./inscription.php?error=Le mot de passe doit contenir entre 8 et 30 caractères.');
                return;
            }
        }else{
            header('location:./inscription.php?error=Le mail et le pseudo ne doivent pas être vides.');
            return;
        }
    }else{
        header('location:./inscription.php?error=Veuillez entre votre civilité.');
        return;
    }
}
?>
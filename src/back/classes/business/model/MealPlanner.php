<?php
/**
    Pour la suggestion des calories au client
*/

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class MeanPlanner extends Client{
    private int $nutrition;
    
    /**
    * MeanPlanner constructor.
    */
    public function __construct(int $id, string $first_name, string $last_name, string $civility, string $pseudo,
                                string $mail, string $password, array $assessed_recipes = array(),
                                array $recorded_recipes = array(), array $preferences_ingredients = array(), $nutrition)
    {
        super($id, $first_name, $last_name, $civility, $pseudo, $mail, $password, $assessed_recipes, $recorded_recipes, $preferences_ingredients);
        
        /**
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->civility = $civility;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->password = $password;
        $this->assessed_recipes = $assessed_recipes;
        $this->recorded_recipes = $recorded_recipes;
        $this->preferences_ingredients = $preferences_ingredients;
        */
        
        $this->nutrition = $nutrition;
    }
    
    public function getId(): int
    {
        // return $this->id;
        return super.getId();
    }

    public function setId(int $id)
    {
        // $this->id = $id;
        super.setId($id);
    }

    public function getFirstName(): string
    {
        // return $this->first_name;
        return super.getFirstName();
    }

    public function setFirstName(string $first_name)
    {
        // $this->first_name = $first_name;
        super.setFirstName($first_name);
    }

    public function getLastName(): string
    {
        // return $this->last_name;
        return super.getLastName();
    }

    public function setLastName(string $last_name)
    {
        // $this->last_name = $last_name;
        super.setLastName($last_name);
    }

    public function getCivility(): string
    {
        // return $this->civility;
        return super.getCivility();
    }

    public function setCivility(string $civility)
    {
        // $this->civility = $civility;
        super.setCivility($civility);
    }

    public function getPseudo(): string
    {
        // return $this->pseudo;
        return super.getPseudo();
    }

    public function setPseudo(string $pseudo)
    {
        // $this->pseudo = $pseudo;
        super.setPseudo($pseudo);
    }

    public function getMail(): string
    {
        // return $this->mail;
        return super.getMail();
    }

    public function setMail(string $mail)
    {
        // $this->mail = $mail;
        super.setMail($mail);
    }

    public function getPassword(): string
    {
        // return $this->password;
        return super.getPassword();
    }

    public function setPassword(string $password)
    {
        // $this->password = $password;
        super.setPassword($password);
    }

    public function getAssessedRecipes(): array
    {
        // return $this->assessed_recipes;
        return super.getAssessedRecipes();
    }

    public function setAssessedRecipes(array $assessed_recipes)
    {
        // $this->assessed_recipes = $assessed_recipes;
        super.setAssessedRecipes = $assessed_recipes;
    }

    public function getRecordedRecipes(): array
    {
        // return $this->recorded_recipes;
        return super.getRecordedRecipes();
    }

    public function setRecordedRecipes(array $recorded_recipes)
    {
        // $this->recorded_recipes = $recorded_recipes;
        super.setRecordedRecipes($recorded_recipes);
    }

    public function getPreferencesIngredients(): array
    {
        // return $this->preferences_ingredients;
        return super.getPreferencesIngredients();
    }

    public function setPreferencesCategories(array $preferences_ingredients)
    {
        // $this->preferences_ingredients = $preferences_ingredients;
        super.setPreferencesCategories($preferences_ingredients);
    }
    
    /**
    * DATE: 09/02/2022
    * Developer: Matthieu SAUVAGEOT
    
    * Modifications:
    *   - Ajout d'une fonction de suggestion d'un nombre de calories pour chaque jour
    *   - Ajout d'une fonction pour calculer le Metabolisme d'un client
    */
    
    /**
    * Calcul du Métabolisme d'un client
    * https://www.passionsante.be/index.cfm?fuseaction=art&art_id=13657
    *
    * Méthode de Calcul:
    *   - Multiplier le poids (en kg) par 10
    *   - Multiplier la taille (en cm) par 6.25
    *   - Additionner les résultats (exemple : vous pesez 65 kg et vous mesurez 1,70 m : 650 + 1062,5 = 1712,5)
    *   - Multiplier l'âge par 5 et retirez ce chiffre du résultat précédent (40 ans x 5 = 200, 1712,5 - 200 = 1512,5)
    *   - Enfin, Retirer 161 pour une Femme OU Ajouter 5 pour un Homme
    */
    
    /**
    * Dans la classe Client, il y a les fonctions pour récupérer son poids, sa taille, son age et son genre (homme ou femme)
    * Il y a aussi une fonction qui permet de connaître la pratique sportive du client (s'il pratique peu, un peu ou beaucoup d'exercice)
    */
    public metabolism($client){
        $metabol = 0;
        /**
        * $metabol = ($client->getWeight())*10;
        * $metabol += ($client->getSize())*6.25;
        * $metabol -= ($client->getAge())*5;
        */
        
        $metabol = super.getWeight()*10;
        $metabol += super.getSize()*6.25;
        * $metabol -= super.getAge()*5;
        
        // if($client->getGender() == 'woman'){
        if(super.getGender() == 'woman'){
            $metabol -= 161;
        }
        else{ // if(super.getGender() == 'man')
            $metabol += 5;
        }
        
        return $metabol;
    }
    
    /**
    * Suggestion de Calories
    *
    * Le nombre de calories suggérées est déterminé selon les attributs de l'utilisateur suivants:
    *   - son Âge
    *   - son Poids (en kg)
    *   - sa Taille (en cm)
    *   - son Genre (Homme ou Femme)
    */
    public function suggestedCalories($id){
        foreach ($this->clients as $key => $client){
            if($client-> getId() == $id){
                /**
                * Calcul des calories suggérées
                * https://www.passionsante.be/index.cfm?fuseaction=art&art_id=13657
                */
                
                // Calcul du métabolisme
                $metabol = metabolism($client);
                
                /**
                *   - Si le client ne pratique une actvité physique "Légère" (-30 minutes de marche à bon rythme par jour, au moins cinq jours par semaine):
                *   multipliez votre métabolisme (MB) par 1.2.
                *   - Si le client pratique une activité physique "Modérée", multiplier le MB par 1.55
                *   - Si le client pratique une activité physique "Intense", multiplier le MB par 1.725.
                */
                if($client -> getActivity() == 'light'){
                    $metabol *= 1.2;
                }
                elif($client -> getActivity() == 'moderate'){
                    $metabol *= 1.55;
                }
                else{
                    $metabol *= 1.725;
                }
                
                print("\nNombre de calories suggérées pour le client",$id,":",$metabol);
                
                return True;
            }
        }
        return False;
    }
}

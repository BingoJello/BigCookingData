<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Suggestion
{
    
    /**
     * @var array
     */
    private $recipes;
    
    /**
    * DATE: 06/02/2022
    * Developer: Matthieu SAUVAGEOT
    
    * Modifications:
    *   - Ajout d'un attribut "clients"
    *   - Ajout d'une fonction de suggestion d'un nombre de calories pour chaque jour
    *   - Ajout d'une fonction pour calculer le Metabolisme d'un client
    */
    
    private $clients;

    /**
     * Suggestion constructor.
     * @param array $recipes
     */
    // public function __construct($recipes = array())
    public function __construct($recipes = array(), $clients = array())
    {
        $this->recipes = $recipes;
        
        $this->clients = $clients;
    }

    public function addRecipes($recipe){
        array_push($this->recipes, $recipe);
    }

    public function deleteRecipe($id){
        foreach ($this->recipes as $key => $recipe){
            if($recipe->getId() == $id){
                array_splice($this->recipes, $id);
            }
        }
        return null;
    }

    public function getRecipe($id){
        foreach ($this->recipes as $key => $recipe){
            if($recipe->getId() == $id){
                return $recipe;
            }
        }
        return null;
    }

    public function alreadyExist($id){
        foreach ($this->recipes as $key => $recipe){
            if($recipe->getId() == $id){
                return True;
            }
        }
        return False;
    }

    /**
    * @return array
    */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
    * @param array $recipes
    */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;
    }
    
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
    public metabolism($client){
        $metabol = 0;
        $metabol = ($client->getWeight())*10;
        $metabol += ($client->getSize())*6.25;
        $metabol -= ($client->getAge())*5;
        
        if($client->getGender() == 'woman'){
            $metabol -= 161;
        }
        else{
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

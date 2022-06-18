from database import databaseConnection as dc, databaseQuery as dq
from processDecisionTree import decisionTree as dt, stats as dst
from processNaivesBayes import NaivesBayes as nb, stats as nst
import utils as ut
import os
os.environ["PATH"] += os.pathsep + 'D:/Programmes/lib_python/Graphviz/bin'

#**************Construction de l'arbre de décision**************

ingredients_to_remove = ['sel', 'poivre', 'beurre']
mydb = dc.get_co()
list_ingredients = dq.getAllIngredients(mydb)
recipes = dq.getRecipes(mydb)
recipes_for_tree = []

for key, value in recipes.items():
    if key == 'ingredients_name':
        for all_ingredients in value:
            recipe_row = [0] * (len(list_ingredients))
            for ingredient_recipe in all_ingredients:
                if ingredient_recipe in list_ingredients and ingredient_recipe not in ingredients_to_remove:
                    recipe_row[list_ingredients.index(ingredient_recipe)] = 1
            recipes_for_tree.append(recipe_row)
    if key == 'id_cluster':
        index = 0
        for id_cluster in value:
            recipes_for_tree[index].append(int(id_cluster))
            index+=1

list_ingredients.append('cluster')
ut.serialize(list_ingredients, "list_ingredients")

X, Y, X_train, x_test, Y_train, y_test = dt.split_dataset(recipes_for_tree, list_ingredients, 0.33)
outputTree = dt.trainDecisionTree(X, Y, 'entropy', 11)
dt.getTreePDF(outputTree, list_ingredients)
ut.serialize(outputTree, 'serialized_tree')


#**************Statistique pour la profondeur de l'arbre**************
'''
X, Y, X_train, x_test, Y_train, y_test = dt.split_dataset(recipes_for_tree, list_ingredients, 0.33)
dst.stats1(X, Y, "entropy", 10)
'''

#**************Statistique pour les data-traininf**************
'''
X, Y, X_train, x_test, Y_train, y_test = dt.split_dataset(recipes_for_tree, list_ingredients, 0.33)
dst.stats2(X, Y, "entropy")
'''

'''
X, Y, X_train, x_test, Y_train, y_test = nb.split_dataset(recipes_for_tree, list_ingredients, 0.33)
nst.stats1(X, Y, 10)
'''
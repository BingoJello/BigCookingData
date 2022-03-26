#@author arthur mimouni

from database import databaseConnection as dc, databaseQuery as dq
from process_decision_tree import decisionTree as dt, stats as dst
import utils as ut
import os
os.environ["PATH"] += os.pathsep + 'D:/Programmes/lib_python/Graphviz/bin'

#*************Création de l'arbre de décision*************
'''
mydb = dc.get_co()
list_ingredients = dq.getAllIngredients(mydb)
recipes = dq.getRecipes(mydb)
recipes_for_tree = []

for key, value in recipes.items():
    if key == 'ingredients_name':
        for all_ingredients in value:
            recipe_row = [0] * (len(list_ingredients))
            for ingredient_recipe in all_ingredients:
                if ingredient_recipe in list_ingredients:
                    recipe_row[list_ingredients.index(ingredient_recipe)] = 1
            recipes_for_tree.append(recipe_row)
    if key == 'id_cluster':
        index = 0
        for id_cluster in value:
            recipes_for_tree[index].append(int(id_cluster))
            index+=1

list_ingredients.append('cluster')

X, Y, X_train, x_test, Y_train, y_test = dt.split_dataset(recipes_for_tree, list_ingredients, 0.33)
outputTree = dt.trainDecisionTree(X, Y, 'entropy', 6)
dt.getTreePDF(outputTree, list_ingredients)
ut.serialize(outputTree, 'serialized_tree')
'''

#*************Stats 1*************
'''
X, Y, X_train, x_test, Y_train, y_test = dt.split_dataset(recipes_for_tree, list_ingredients, 0.33)
dst.stats1(X, Y, "entropy", 15)
'''

#*************Stats 2*************
'''
X, Y, X_train, x_test, Y_train, y_test = dt.split_dataset(recipes_for_tree, list_ingredients, 0.33)
dst.stats2(X, Y, "entropy")
'''
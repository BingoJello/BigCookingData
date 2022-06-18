from ladon.ladonizer import ladonize
from database import databaseConnection as dc
from database import databaseQuery as dq
import utils as ut

#Pour activer le server : ecrire dans la console "python venv/Scripts/ladon-3.9-ctl.py testserve DecisionTreeService.py -p 8080"
#http://localhost:8080/

class DecisionTreeService(object):
    @ladonize(str, rtype=int)

    def add(self, ingredients_user) :
        mydb = dc.get_co()
        list_ingredients = dq.getAllIngredients(mydb)
        ingredients_user_list = ingredients_user.split(";")
        ingredients_vector = [0] * (len(list_ingredients))
        for ingredient in ingredients_user_list :
            if ingredient in list_ingredients :
                ingredients_vector[list_ingredients.index(ingredient)] = 1

        outputTree = ut.deserialize("serialized_tree")
        return int(outputTree.predict([ingredients_vector]))
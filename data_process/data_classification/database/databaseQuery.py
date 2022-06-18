def getAllIngredients(mydb):
    mycursor = mydb.cursor()
    ingredients = []
    query = "SELECT DISTINCT ingredient.name FROM ingredient" \
            " WHERE ingredient.is_active = 1" \
            " ORDER BY ingredient.id_ingredient"
    mycursor.execute(query)

    myresult = mycursor.fetchall()

    for row in myresult :
        ingredients.append(row[0])

    return ingredients

def getRecipes(mydb):
    mycursor = mydb.cursor()
    recipes = {'id' : [], 'ingredients_name' : [], 'id_cluster' : []}

    query = "SELECT recipe.id_recipe, ingredient.name, recipe.clusterNumber FROM recipe " \
            "INNER JOIN contain_recipe_ingredient as cri ON cri.id_recipe = recipe.id_recipe " \
            "INNER JOIN ingredient ON ingredient.id_ingredient = cri.id_ingredient " \
            "ORDER BY(recipe.id_recipe)"

    mycursor.execute(query)
    myresult = mycursor.fetchall()
    start = True
    for row in myresult:
        if row[0] in recipes['id']:
            ingredients.append(row[1])
        else:
            recipes['id'].append(row[0])
            recipes['id_cluster'].append(row[2])
            if start == True:
                ingredients =[]
                ingredients.append(row[1])
            else:
                recipes['ingredients_name'].append(ingredients)
                ingredients = []
                ingredients.append(row[1])
            start = False
    recipes['ingredients_name'].append(ingredients)
    return recipes
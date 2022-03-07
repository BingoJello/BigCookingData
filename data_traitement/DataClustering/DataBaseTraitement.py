#!/usr/bin/env python
# coding: utf-8

# In[1]:


import MySQLdb

import pandas as pd

import re
import json


# In[2]:


location = "127.0.0.1"

user = "root"

password = ""

database_name = "bigcookingdata"

db = None

cursor = None

def connect():
    global cursor
    global db
    db = MySQLdb.connect(location,user,password,database_name )
    cursor = db.cursor()
def disconnect():
    db.close()

def get_version():
    cursor.execute( "SELECT VERSION()" )
    return cursor.fetchone()[0]


# In[3]:


# Create Databases
def createDB():
    connect()
    sql_create_db = """
        DROP TABLE IF EXISTS assess;
        DROP TABLE IF EXISTS client;
        DROP TABLE IF EXISTS contain_recipe_ingredient;
        DROP TABLE IF EXISTS have_preferences_ingredient;
        DROP TABLE IF EXISTS ingredient;
        DROP TABLE IF EXISTS recipe;
        DROP TABLE IF EXISTS record;


       CREATE TABLE assess (
        id_recipe int(11) NOT NULL,
        id_client int(11) NOT NULL,
        rating tinyint(4) DEFAULT NULL,
        commentary varchar(280) DEFAULT NULL,
        PRIMARY KEY (id_recipe,id_client),
        KEY id_client (id_client)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1
        ;

        CREATE TABLE client (
        id_client int(11) NOT NULL,
        firstname varchar(25) DEFAULT NULL,
        lastname varchar(25) DEFAULT NULL,
        civility char(2) DEFAULT NULL,
        pseudo varchar(25) DEFAULT NULL,
        mail varchar(40) DEFAULT NULL,
        password varchar(30) DEFAULT NULL,
        PRIMARY KEY (id_client)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

        CREATE TABLE have_preferences_ingredient (
        id_client int(11) NOT NULL,
        id_ingredient int(11) NOT NULL,
        PRIMARY KEY (id_client,id_ingredient),
        KEY id_ingredient (id_ingredient)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

        CREATE TABLE ingredient (
          id_ingredient int(11) NOT NULL,
          name varchar(40) DEFAULT NULL,
          url_pic text DEFAULT NULL,
          PRIMARY KEY (id_ingredient)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;


        CREATE TABLE recipe (
          id_recipe int(11) NOT NULL,
          name varchar(50) DEFAULT NULL,
          categories text,
          url_pic text,
          clusterNumber varchar(20) NOT NULL,
          directions text,
          prep_time varchar(20) DEFAULT NULL,
          cook_time varchar(20) DEFAULT NULL,
          break_time varchar(20) DEFAULT NULL,
          difficulty varchar(15) DEFAULT NULL,
          budget varchar(15) DEFAULT NULL,
          serving varchar(6) DEFAULT NULL,
          coordonnees char(70) DEFAULT NULL,
          PRIMARY KEY (id_recipe)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
        
        CREATE TABLE contain_recipe_ingredient (
          id_recipe int(11) NOT NULL,
          id_ingredient int(11) NOT NULL,
          quantity varchar(20) DEFAULT NULL,
          PRIMARY KEY (id_recipe,id_ingredient),
          KEY id_ingredient (id_ingredient)
        )ENGINE=MyISAM DEFAULT CHARSET=latin1;



        CREATE TABLE record (
          id_recipe int(11) NOT NULL,
          id_client int(11) NOT NULL,
          PRIMARY KEY (id_recipe,id_client),
          KEY id_client (id_client)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
    
    """
#     global sql_assess,sql_contain_recipe_ingredient,sql_have_preferences_ingredient,sql_ingredient
#     global sql_recipe,sql_client,sql_record,table_recipe,table_user
    sql_assess = "drop table assess;"
    sql_contain_recipe_ingredient = "drop table contain_recipe_ingredient;"
    sql_have_preferences_ingredient = "drop table have_preferences_ingredient;"
    sql_ingredient = "drop table ingredient;"
    sql_recipe = "drop table recipe;"
    sql_client = "drop table client;"
    sql_record = "drop table record;"
    table_recipe = 'l_recipe_ingredient'
    table_user = 'user'
    _SQL = """SHOW TABLES"""
    try:
#         cursor.execute( _SQL )
        cursor.execute( sql_create_db )
        results = cursor.fetchall()
        print( 'All existing tables:', results )  # Returned as a list of tuples
    except (MySQLdb.Error, MySQLdb.Warning) as e:
        print('error')
        print(e)
    results_list = [item[0] for item in results]  # Conversion to list of str
    if(table_recipe and table_user in results_list):
        print(table_recipe, table_record, table_user, "was found")
        try:
            # Execute the SQL command
            cursor.execute(sql_recipe)
            cursor.execute(sql_ingredient)
            cursor.execute(sql_ingredient)
            cursor.execute(sql_client)
            cursor.execute(sql_assess)
            cursor.execute(sql_contain_recipe_ingredient)
            cursor.execute(sql_have_preferences_ingredient)
            cursor.execute(sql_record)
            cursor.execute(sql_create_db)
            # Commit your changes in the database
            db.commit()
        except (MySQLdb.Error, MySQLdb.Warning) as e:
                db.rollback()
                print(e)
    else:
        print(table_recipe, table_user, "was found")
        try:
#             cursor.execute(sql_drop)
            cursor.execute( sql_create_db )
        except:
            db.rollback()
            disconnect()

            


# In[4]:


createDB()


# In[45]:


def persisetDB(recipes):
    global sql_assess,sql_contain_recipe_have_preferences_ingredient,sql_ingredient,sql_recipe
    global sql_client,sql_record,  liste_ingre_totale_pd, categories, categorie_str, liste_ingre,dict_ingre
    global ing_id_unique, ing_quantity,list_utensil_total_pd,title_recipe,ingre, id_fetch,id_fetch_rec
    
    listDic_Ingre = []
    dict_ingre = {}
    connect()
    ################# Création table ingredients sans doublons #####################
    for values in recipes:
        ingredients = values[0]['ingredients']
        categories =  values[0]['category']
        title =  values[0]['nom']
        img_url =  values[0]['img_url']
        time_prepa =  values[0]['time_prepa']
        time_repo =  values[0]['time_repo']
        time_cuisson =  values[0]['time_cuisson']
        difficulty =  values[0]['difficulty']
        budget =  values[0]['budget']
        directions =  "NO VALUES"
        if ingredients is None:
            pass
            print( "0 ingrédients" )
        else:
            for ing in ingredients:
                liste_ingre = []
                dict_Ingre = {}
                ing_id_unique = 0
                liste_ingre_by_recipe = []
                ing_name = re.escape( str( ing['nom_ingre']))
                ing_img_url = re.escape( str( ing['image_ingre']))
                dict_Ingre[ing_name] = ing_img_url
                listDic_Ingre.append(dict_Ingre)
               
                                        
#     print( "LEN LIST INGREDIENT :",listDic_Ingre)
    newListIngre = [i for n, i in enumerate(listDic_Ingre) if i not in listDic_Ingre[n + 1:]]
#     print( "LEN LIST INGREDIENT :",newListIngre)

    #insert ingredients in base
    counter = 0
    for key,ingredient in enumerate(newListIngre):
        key += 1
        for ingre, url_pic in ingredient.items():
            ingre = ingre.replace('\u0301', ' ')
            ingre = ingre.replace('\u00ae\ufe0f', ' ')
            sql_ingredient = """ insert into ingredient
            (name,id_ingredient,url_pic) values("%s","%s","%s");""" % (ingre, key,url_pic)
        print( "INGREDIENT :", sql_ingredient )

        try:
            # Execute the SQL command ingredient
            cursor.execute( sql_ingredient )
            # Commit your changes in the database
            db.commit()
        except:
            # Rollback in case there is any error
            db.rollback()
            
    
    # insert recette
    compteur = 0
    for values in recipes:
        name=  values[0].get('nom')
        name = name.replace("\"", "\\'")
        name = name.replace('\u0301', ' ')
        name = name.replace('\u00ae\ufe0f', ' ')
        prep_time =   values[0].get( 'time_prepa' )
        cook_time =   values[0].get( 'time_cuisson' )
        break_time =  values[0].get( 'time_repo' )
        rating = values[0].get( 'global_rating' )
        difficulty =  values[0].get( 'difficulty' )
        budget =  values[0].get( 'budget' )
        categories =  values[0].get( 'category' )
        title_recipe =  values[0].get( 'title' )
        directions =  "NO VALUES"
        url_pic =  values[0].get('img_url')
        coordonnees = values[2]
        serving = 1
        clusterNumber = values[1]

         # Affichage numerous recipe et compteur
        compteur = compteur + 1
#         print( "--- NUMEROUS RECIPE :", compteur, ":", name, "---" )

        # Condition if None everywhere
        if not name and not budget and not difficulty and not categories and not rating:
            name = 0
            prep_time =  0
            cook_time = 0
            break_time =0
            rating = 0
            difficulty = 0
            budget = 0
            categories = 0
            title_recipe =0
            utensils = 0
            etape =  0
            coordonnees = 0
            number_of_person = 0
            clusterNumber = 0.0

            sql_recipe = """insert into recipe (id_recipe,name,categories,url_pic,clusterNumber,directions,prep_time,cook_time,
            break_time,difficulty,budget,serving,coordonnees)\
                                        values ("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s");"""  % (
                    compteur,name, categories,url_pic, clusterNumber, directions, prep_time, cook_time, break_time,
                    difficulty,budget,serving,coordonnees)
            
      
        # Condition for Categories
        if categories is None:
            categories = 'Vide'
            print( "0 categorie" )
        else:
            pass
        
        if budget is None:
                budget = 0
                sql_recipe = """insert into recipe (id_recipe,name,categories,url_pic,clusterNumber,directions,prep_time,cook_time,
                                break_time,difficulty,budget,serving,coordonnees)\
                                values ("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s");"""  % (
                    compteur,name, categories, url_pic, clusterNumber, directions, prep_time, cook_time, break_time,
                    difficulty,budget,serving,coordonnees)
                
        elif rating is None:
                rating = 0
                sql_recipe = """insert into recipe (id_recipe,name,categories,url_pic,clusterNumber,directions,prep_time,cook_time,
                                break_time,difficulty,budget,serving,coordonnees)\
                                 values ("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s");""" % (
                    compteur,name, categories, url_pic, clusterNumber, directions, prep_time, cook_time, break_time,
                    difficulty,budget,serving,coordonnees)
                
        else:
             sql_recipe = """insert into recipe (id_recipe,name,categories,url_pic,clusterNumber,directions,prep_time,cook_time,
                                break_time,difficulty,budget,serving,coordonnees)\
                                values ("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s");"""  % (
                   compteur, name, categories, url_pic, clusterNumber, directions, prep_time, cook_time, break_time,
                    difficulty,budget,serving,coordonnees)
                
                
        print( "RECIPE ::", sql_recipe )
        
        # Injection des recipes en base
        try:
            # Execute the SQL command recipe
            cursor.execute(sql_recipe)
            # Commit your changes in the database
            db.commit()
        except (MySQLdb.Error, MySQLdb.Warning) as e:
                db.rollback()
                print(e)
                
        # liaison recette  recette ingredients
    compteur = 0
    for values in recipes:
        ingredients =  values[0]['ingredients']
        title_recipe =  values[0]['nom']
        title_recipe = title_recipe.replace("\"", "\\'")
        title_recipe = title_recipe.replace('\u0301', ' ')
        title_recipe = title_recipe.replace('\u00ae\ufe0f', ' ')
        title_recipe = str(title_recipe)
        img_url =  values[0]['img_url']
        if ingredients is None:
            pass
            print( "0 ingrédients" )
        else:
            for ing in ingredients:
                ing_quantity = ing['quantity']
                ing_name = re.escape( str( ing['nom_ingre']))
                ing_name = ing_name.replace('\u0301', ' ')
                ing_name = ing_name.replace('\u00ae\ufe0f', ' ')
                ing_img_url = re.escape( str( ing['image_ingre']))
                sql_get_id_ingredient = """select id_ingredient from ingredient 
                where name= "%s";""" % (ing_name)
                print( "SQL GET ID INGRE :::::::::", sql_get_id_ingredient )
                sql_get_id_recipe = """select id_recipe from recipe where name= "%s";""" % (title_recipe)
                print( "GET ID RECIPE :", sql_get_id_recipe )
                id_fetch_rec = 0
                id_fetch = 0
                                 
                try:
                    cursor.execute(
                        """select id_recipe from recipe where name= "%s";""" % (title_recipe) )
                    id_rec = cursor.fetchall()
                    for id_rec_att in id_rec:
                        id_fetch_rec = id_rec_att[0]
                        print( "CLE PRIMAIRE RECIPE :", id_fetch_rec )
                        print("TITRE RECIPE :::::", title_recipe)
                        print("++++++++++++++++++++++++")
                except (MySQLdb.Error, MySQLdb.Warning) as e:
                        db.rollback()
                        print( "Error get ID Recipe" )
                        print(e)
                try:
                    cursor.execute(
                        """select id_ingredient from ingredient where name= "%s";""" % (ing_name) )
                    id_ingre = cursor.fetchall()
                    for id_att in id_ingre:
                        id_fetch = id_att[0]
                        print( "CLE PRIMAIRE ING = ", id_fetch )
                        print( "Title Ingredient = ", ing_name )
                except (MySQLdb.Error, MySQLdb.Warning) as e:
                    print( "Error get ID Ingredient" )
                    db.rollback()
                    print(e)
                if ing_quantity is None:
                    sql_l_recipe_ingredient = """ insert into contain_recipe_ingredient (id_recipe,id_ingredient,quantity) values("%s","%s","%s");""" % (
                    id_fetch_rec, id_fetch, None)
                    print( "LIAISON INGREDIENT : None Quantity", sql_l_recipe_ingredient )
                else:
                    sql_l_recipe_ingredient = """ insert into contain_recipe_ingredient (id_recipe,id_ingredient,quantity)  values("%s","%s","%s");""" % (
                    id_fetch_rec, id_fetch, ing_quantity)
                    print( "LIAISON INGREDIENT :", sql_l_recipe_ingredient )   
                try:
                    # Execute the SQL command liaison
                    cursor.execute( sql_l_recipe_ingredient )
                        # Commit your changes in the database
                    db.commit()
                except:
                    # Rollback in case there is any error
                    db.rollback()
                    


# In[46]:


recette = [
    
   [ 
       {"id": 1, "nom": "Mont d'Or au four", "img_url": "https://assets.afcdn.com/recipe/20131219/14392_w96h96c1cx1250cy1354cxb2500cyb2708.jpg", "category": ["Plat principal", "Plats au fromage"], "global_rating": "4.8", "time_prepa": "10\u00a0min", "time_repo": "-", "time_cuisson": "20\u00a0min", "difficulty": "tr\u00e8s facile", "budget": "moyen", "numberP": 1, "etape": ["Le Mont d'Or est un fromage du Haut-Jura, vendu \u00e0 la coupe ou dans une bo\u00eete en \u00e9pic\u00e9a. Pour cette recette, choisissez le fromage en bo\u00eete.", "Prenez votre Mont d'Or, faites un trou au milieu dans lequel vous verserez un peu de vin blanc.", "Placez le fromage au four \u00e0 180\u00b0C (thermostat 6) jusqu'\u00e0 ce qu'il soit fondu. ", "Accompagnez de pommes de terre vapeur, de charcuterie, et d'un vin blanc."], 
        "ingredients": [
            {"id_ingre": 1, "nom_ingre": "vin blanc", "quantity": "5", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67771_w96h96c1cx350cy350.jpg"}, 
            {"id_ingre": 2, "nom_ingre": "oignons", "quantity": "2", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67621_w96h96c1cx350cy350.jpg"},
            {"id_ingre": 3, "nom_ingre": "mont d'or", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20171229/76410_w96h96c1cx2500cy1681cxb5000cyb3362.jpg"}]},
       0,7
   ]
    ,
    [
        
    {"id": 2, "nom": "Poulet au four simple et savoureux", "img_url": "https://assets.afcdn.com/recipe/20200408/109519_w96h96c1cx1933cy2466cxb3744cyb5616.jpg", "category": ["Plat principal", "Viande", "Viande r\u00f4tie"], "global_rating": "4.8", "time_prepa": "15\u00a0min", "time_repo": "-", "time_cuisson": "1\u00a0h\u00a040\u00a0min", "difficulty": "facile", "budget": "moyen", "numberP": 1, "etape": ["Pr\u00e9chauffer le four \u00e0 200\u00b0C (thermostat 6).\n Placer \u00e0 l'int\u00e9rieur du poulet deux gousses d'ail et les feuilles de laurier.", "Pr\u00e9parer la sauce en m\u00e9langeant le jus de citron et le verre de bouillon de volaille. Arroser copieusement le poulet et verser le reste du jus dans le plat.", "Saupoudrer le gros sel sur le poulet. ", "Placer le poulet dans le plat, avec les oignons coup\u00e9s en quatre et les tomates cerises. ", "Placer le poulet au four durant environ 1 heure 40 \u00e0 200\u00b0C. (Au bout de 20 min de cuisson, retourner le poulet et laisser cuire 20 min, puis le replacer \u00e0 l'endroit pour la suite de la cuisson) ", "Attention : Arroser le poulet avec son jus le plus souvent possible durant la cuisson (ajouter de l'eau si n\u00e9cessaire). Le poulet n'en sera que plus moelleux !", "R\u00e9cup\u00e9rer le jus \u00e0 la fin de la cuisson, avec les tomates et les oignons, dans un bol, et placer sur la table, avec une belle salade verte et une po\u00eal\u00e9e de pommes de terres nouvelles."],
     "ingredients": [
    {"id_ingre": 1, "nom_ingre": "oignons", "quantity": "2", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67621_w96h96c1cx350cy350.jpg"}, 
    {"id_ingre": 2, "nom_ingre": "oignons", "quantity": "2", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67621_w96h96c1cx350cy350.jpg"},
    {"id_ingre": 3, "nom_ingre": "tomates cerise", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67652_w96h96c1cx350cy350.jpg"}, 
    {"id_ingre": 4, "nom_ingre": "ail", "quantity": "3", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67514_w96h96c1cx350cy350.jpg"}, 
    {"id_ingre": 5, "nom_ingre": "jus de citron", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67412_w96h96c1cx350cy350.jpg"}, 
    {"id_ingre": 6, "nom_ingre": "bouillon de volaille", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67586_w96h96c1cx350cy350.jpg"}, 
    {"id_ingre": 7, "nom_ingre": "feuille de laurier", "quantity": "empty", "image_ingre": "https://assets.afcdn.com/recipe/20170621/68932_w96h96c1cxb700cyb700.jpg"}, 
    {"id_ingre": 8, "nom_ingre": "sel", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67687_w96h96c1cx350cy350.jpg"}, 
    {"id_ingre": 9, "nom_ingre": "poivre", "quantity": "empty", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67563_w96h96c1cx350cy350.jpg"}, 
    {"id_ingre": 10, "nom_ingre": "poulet", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67769_w96h96c1cx350cy350.jpg"}]}
   ,0,7],
    
    [
        {"id": 3, "nom": "Salade \"chou original\"", "img_url": "https://assets.afcdn.com/recipe/20100101/recipe_default_img_placeholder_w96h96c1.jpg", "category": ["Salade"], "global_rating": "5", "time_prepa": "20\u00a0min", "time_repo": "-", "time_cuisson": "-", "difficulty": "tr\u00e8s facile", "budget": "bon march\u00e9", "numberP": 1, "etape": ["Hachez les oignons fins et mettez les dans un bol empli de vinaigrette. Ajoutez-y les raisins blonds. Laissez mac\u00e9rer le tout. (Faites attention \u00e0 ce qu'il y ait assez de vinaigrette)", "\u00c9bouillantez les lardons et faites rissoler rapidement les pignons (attention \u00e0 ce qu'ils ne noircissent pas!).", "\u00c9mincez finement le chou et coupez les pommes en petits cubes.", "M\u00e9langez le tout dans un grand saladier et d\u00e9gustez. Encore meilleur quand pr\u00e9par\u00e9 au moins 2h \u00e0 l'avance!!!!!"], "ingredients": [{"id_ingre": 1, "nom_ingre": "oignon", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67621_w96h96c1cx350cy350.jpg"}, {"id_ingre": 2, "nom_ingre": "pignons", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67441_w96h96c1cx350cy350.jpg"}, {"id_ingre": 3, "nom_ingre": "pommes", "quantity": "2", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67365_w96h96c1cx350cy350.jpg"}, {"id_ingre": 4, "nom_ingre": "lardons", "quantity": "1.5", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67383_w96h96c1cx350cy350.jpg"}, {"id_ingre": 5, "nom_ingre": "chou", "quantity": "\u2044", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67685_w96h96c1cx350cy350.jpg"}, {"id_ingre": 6, "nom_ingre": "raisin", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67749_w96h96c1cx350cy350.jpg"}, {"id_ingre": 7, "nom_ingre": "vinaigrette", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20210316/118623_w96h96c1cx540cy541cxb1080cyb1082.jpg"}]},
        0,7
    ],
    
    
    [
       {"id": 697, "nom": "Meringue sapin", "img_url": "https://assets.afcdn.com/recipe/20191205/103592_w96h73c1cx1728cy2592cxb3455cyb5184.jpg", "category": ["Confiserie"], "global_rating": "0", "time_prepa": "15\u00a0min", "time_repo": "-", "time_cuisson": "50\u00a0min", "difficulty": "moyenne", "budget": "bon march\u00e9", "numberP": 1, "etape": ["Pr\u00e9chauffer le four \u00e0 120\u00b0C.", "\u00c0 l\u2019aide d\u2019un batteur \u00e9lectrique, ou d\u2019un robot, commencer \u00e0 monter les blancs en neige avec la pinc\u00e9e de sel.", "Ajouter le sucre tout en continuant \u00e0 battre les blancs d\u2019oeufs. La meringue est pr\u00eate lorsqu\u2019elle forme un pic, un \u00ab bec d\u2019oiseau \u00bb, si l\u2019on soul\u00e8ve le fouet.", "R\u00e9partir la pr\u00e9paration dans une poche \u00e0 douille.", "Sur une plaque de cuisson, recouverte de papier sulfuris\u00e9, r\u00e9aliser des petits tas en forme de sapin.", "Cuire les sapins \u00e0 120\u00b0C pendant 2h. Si la meringue n\u2019est pas encore s\u00e8che, et ne se d\u00e9colle pas toute seule, enfourner \u00e0 nouveau pendant 30 minutes en surveillant la cuisson."], "ingredients": [{"id_ingre": 1, "nom_ingre": "blanc d'oeuf Simplement Bon et Bio \u00ae", "quantity": "60", "image_ingre": "https://assets.afcdn.com/recipe/20100101/ingredient_default_w96h96c1.jpg"}, {"id_ingre": 2, "nom_ingre": "sucre Sucandise\u00ae\ufe0f", "quantity": "60", "image_ingre": "https://assets.afcdn.com/recipe/20100101/ingredient_default_w96h96c1.jpg"}, {"id_ingre": 3, "nom_ingre": "sel", "quantity": "1", "image_ingre": "https://assets.afcdn.com/recipe/20170607/67687_w96h96c1cx350cy350.jpg"}]},
        0,7
    ]
  ]
# persisetDB(recette)


# In[ ]:





# In[ ]:





# In[ ]:





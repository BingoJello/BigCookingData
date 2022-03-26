#@author arthur mimouni

import mysql.connector

def get_co():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="A123456*",
        database="big_cooking_data"
    )
    return mydb
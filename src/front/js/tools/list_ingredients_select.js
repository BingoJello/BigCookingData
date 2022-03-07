var listIngredients = [
    "tomate", "oignon", "ail", "haricot",
    "haricot vert", "agneau", "poulet", "porc", "poisson",
    "vodka", "cumin", "curry", "lentille", "petit pois",
    "laitue", "origan", "boeuf", "semoule", "riz",
    "pate", "mozzarella", "pain", "broccoli", "choux"
    ];
    $("#list_ingredients").mSelectDBox({
    "list": listIngredients,
    "builtInInput": 0,
    "multiple": true,
    "autoComplete": true,
    "name": "b"
});
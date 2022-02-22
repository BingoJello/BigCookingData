def normalizeForClassification(recipes, clusters_kmean, ingredients):
    i = -1
    for recipe in recipes :
        i += 1
        recipe.append(clusters_kmean['pca_clusters'][i])

    ingredients.append('cluster')

    return recipes, ingredients
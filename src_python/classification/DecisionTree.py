from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import train_test_split
from sklearn import tree
import pandas as pd
import graphviz as graphviz


def split_dataset(dataset, features, test_size):
    df_data = pd.DataFrame(dataset, columns=features)
    Y = df_data["cluster"].values

    # get all the columns except the last one which is the target attribute
    X = df_data.drop(["cluster"], axis=1).values

    X_train, x_test, Y_train, y_test = train_test_split(X, Y, test_size=test_size, random_state=10)

    return X, Y, X_train, x_test, Y_train, y_test

def trainDecisionTree(X_train, Y_train, criterion, max_depth):

    clf = DecisionTreeClassifier(criterion=criterion, random_state=100, max_depth=max_depth)
    outputTree = clf.fit(X_train, Y_train)

    return outputTree

def predictCluster(tree, data):
    y_pred = tree.predict(data)
    print("Predicted values:")
    print(y_pred)
    return y_pred

def getTreePDF(outputTree, features, classes = ['0', '1', '2', '3', '4']):
    features.remove('cluster')
    dot_data = tree.export_graphviz(outputTree, out_file=None, feature_names=features,class_names=classes)

    # Create the graph with the DOT data
    graph = graphviz.Source(dot_data)

    # Name of the DOT/pdf file
    graph.render("./tree_graph")

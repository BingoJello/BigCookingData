from sklearn.naive_bayes import GaussianNB
from sklearn.model_selection import train_test_split
import pandas as pd

def split_dataset(dataset, features, test_size):
    df_data = pd.DataFrame(dataset, columns=features)
    Y = df_data["cluster"].values

    # get all the columns except the last one which is the target attribute
    X = df_data.drop(["cluster"], axis=1).values

    X_train, x_test, Y_train, y_test = train_test_split(X, Y, test_size=test_size, random_state=10)

    return X, Y, X_train, x_test, Y_train, y_test

def trainNaivesBayes(X_train, Y_train):
    # Create a Gaussian Classifier
    model = GaussianNB()

    # Train the model using the training sets
    model.fit(X_train, Y_train)

    return model

def predictCluster(model, data):
    y_pred = model.predict(data)
    print("Predicted values:")
    print(y_pred)
    return y_pred
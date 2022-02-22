from sklearn.tree import DecisionTreeClassifier
from sklearn.metrics import accuracy_score
from sklearn.model_selection import train_test_split
from sklearn.model_selection import KFold
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt

def stats1(X, Y, criterion, nb_split_kfold):
    # Data set used for classification
    # 0 --> whole data set
    # 25 --> 75% of the data set
    # 50 --> 50% of data set
    # 75 --> 25% of data set
    sizeData = [0, 25, 50, 75]
    j = -1
    framesAccuracy = []
    framesAverageAccuracy = []

    for i in sizeData :
        # Array that contains the training accuracies on the given test data and labels.
        train_accuracy = []
        # Array that contains the average accuracy of the classifiers for different sizes of data set
        average_accuracies = []
        testSize = i / 100

        if testSize != 0 :
            # We first divide the data set according to the size "i". At this time we have i% of the dataset.
            # Then we re-divide the dataset to test the classifier
            X_train, x_test, Y_train, y_test = train_test_split(X, Y, test_size=testSize, random_state=10)
            X_train, x_test, Y_train, y_test = train_test_split(X_train, Y_train, random_state=10)
        # Case where we use the whole dataset
        else :
            X_train, x_test, Y_train, y_test = train_test_split(X, Y, random_state=8)

        j = j + 1
        # We calculate the average of the classifier for a maximum tree depth ranging from 3 to 10
        for depth in range(3, 11) :
            # creating the decision tree function with the entropy method
            # We use the random_state attribute to have the same sequence of random numbers generated each time we run the code.
            clf_entropy = DecisionTreeClassifier(criterion=criterion, max_depth=depth, random_state=8)
            # Fitting the model with the training data of X and Y
            clf_entropy.fit(X_train, Y_train)

            # predictions on validation/test set
            y_pred_en = clf_entropy.predict(x_test)

            # We store in the array the mean accuracy on the given test data and labels.
            train_accuracy.append(accuracy_score(y_test, y_pred_en) * 100)
            kfold = KFold(n_splits=nb_split_kfold, shuffle=True, random_state=8)
            accuracy = 0
            # For each "depth", we use the K-fold cross-validation method, for K=10, to compute the average accuracy of the classifier.
            for train, test in kfold.split(X_train) :
                # "train" contain the indexes of the lines which contain the training data set
                # "test" contain the indexes of the lines which contain the testing data set
                X_trainK, x_testK, Y_trainK, y_testK = X_train[train], X_train[test], Y_train[train], Y_train[test]
                # Fitting the model with the training data of X and Y
                clf_entropy.fit(X_trainK, Y_trainK)

                # predictions on validation/test set
                y_pred_en = clf_entropy.predict(x_testK)

                # Classification accuracy between correct labels (y_test) and predicted labels (y_pred_en)
                ac_score = accuracy_score(y_testK, y_pred_en) * 100
                accuracy = accuracy + ac_score
            # We store the average accuracy for the specific depth in the array
            average_accuracy = accuracy / 10
            average_accuracies.append(average_accuracy)
            # print("Average Accuracy for the  is ", average_accuracy)
        frame = pd.DataFrame({'max_depth' : range(3, 11), 'train_acc' : train_accuracy})
        frame2 = pd.DataFrame({'max_depth' : range(3, 11), 'average_acc' : average_accuracies})
        framesAccuracy.append(frame)
        framesAverageAccuracy.append(frame2)

    fig, [[ax1, ax2], [ax3, ax4]] = plt.subplots(2, 2, figsize=(15, 10))
    fig.suptitle("Accuracy of a tree with different depths and percentages of data set");
    axes = [ax1, ax2, ax3, ax4]
    j = -1
    for i in axes :
        j = j + 1
        if j == 0 :
            i.set_title("100% of the data set", fontsize="11")
        elif j == 1 :
            i.set_title("75% of the data set", fontsize="11")
        elif j == 2 :
            i.set_title("50% of the data set", fontsize="11")
            pos1 = ax1.get_position()  # get the original position
            pos2 = [pos1.x0, pos1.y0 - 0.47, pos1.width, pos1.height]
            i.set_position(pos2)  # set a new position
        else :
            i.set_title("25% of the data set", fontsize="11")
            pos1 = ax2.get_position()  # get the original position
            pos2 = [pos1.x0, pos1.y0 - 0.47, pos1.width, pos1.height]
            i.set_position(pos2)  # set a new position

        frame = framesAccuracy[j]
        frame2 = framesAverageAccuracy[j]

        i.plot(frame['train_acc'].values, label='accuracy')
        i.plot(frame2['average_acc'].values, label='Average accuracy')
        i.tick_params(axis='both', which='major', labelsize=11)
        i.set_xticks(np.arange(len(frame['max_depth'].values)))
        i.set_xticklabels(frame['max_depth'].values)
        i.set_xlabel("Depth", fontsize='11')
        i.set_ylabel('Performance', fontsize='11')
        i.legend(fontsize="13")
    plt.show()

def stats2(X, Y, criterion):
    # array that contains that contains the averages accuracy of the classifier for different sizes of training data
    average_accuracies = []
    sizeDataTest = [90, 75, 67, 50, 34, 25, 5]
    sizeDataTrainingLabel = ['10%', '25%', '33%', '50%', '66%', '75%', "95"]

    for i in [90, 75, 67, 50, 34, 25, 5] :
        testSize = i / 100
        accuracy = 0
        # Random Subsampling method to computer the average accuracy of the classifier.
        for j in range(1, 11) :
            # We extract randomly the same size of training data set to train the classifier and test its accuracy with the other part of data set.
            # We do this 10 times to compute the average accuracy for the size i of training data set
            X_train, X_test, y_train, y_test = train_test_split(X, Y, test_size=testSize, random_state=8)
            clf_entropy = DecisionTreeClassifier(criterion=criterion)
            clf_entropy.fit(X_train, y_train)
            y_pred_en = clf_entropy.predict(X_test)

            ac_score = accuracy_score(y_test, y_pred_en) * 100
            accuracy = accuracy + ac_score
        average_accuracy = accuracy / 10
        # We store the average accuracy for the specific size of data training in the array
        average_accuracies.append(average_accuracy)

    fig, ax = plt.subplots(1, 1, figsize=(11, 6))

    ax.set_title("Relationship between the size of training data set and the accuracy of the tree", fontsize="18")
    ax.plot(average_accuracies, label='Average accuracy', marker='o')
    ax.tick_params(axis='both', which='major', labelsize=14)
    ax.set_xticks(np.arange(len(sizeDataTest)))
    ax.set_xticklabels(sizeDataTrainingLabel)
    ax.set_xlabel("Size of training data set", fontsize='16')
    ax.set_ylabel('Performance', fontsize='16')
    ax.legend(fontsize="13")
    plt.show()
from ladon.ladonizer import ladonize
import pickle

# ecrire "python venv/Scripts/ladon-3.9-ctl.py testserve DecisionTreeService.py -p 8080" pour activer serveur SOAP python
class DecisionTreeService(object) :
    @ladonize(str, rtype=int)
    def getCluster(self, ingredients) :
        file_decision_tree = open("decisionTree", "rb")
        decisionTree = pickle.load(file_to_read)

from ladon.ladonizer import ladonize

# ecrire "python venv/Scripts/ladon-3.9-ctl.py testserve DecisionTreeService.py -p 8080" pour activer serveur SOAP python
class DecisionTreeService(object) :
    statut = -1
    """
    This service does the math, and serves as example for new potential Ladon users.
    In-line documentation ends up in the web service online browsable API
    """
    @ladonize(str, rtype=int)
    def add(self, ingredients) :
        """
        Add two integers together and return the result

        @param a: 1st integer
        @param b: 2nd integer
        @rtype: The result of the addition
        """
        if self.statut == -1:
            self.statut = 1
            return 10
        else :
            return 9
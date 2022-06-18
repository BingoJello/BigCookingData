import pickle

def serialize(object, file_name):
    file_to_store = open("files/"+file_name, "wb")
    pickle.dump(object, file_to_store)
    file_to_store.close()

def deserialize(file_name):
    file_to_read = open("files/"+file_name, "rb")
    loaded_object = pickle.load(file_to_read)
    file_to_read.close()

    return loaded_object
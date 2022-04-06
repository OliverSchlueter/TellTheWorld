import pymongo

db = None

class Database:
    def __init__(self):
        self.client = None
        self.mongodb = None
        self.collections = {}

    def connect(self):
        self.client = pymongo.MongoClient("mongodb://localhost:27017", serverSelectionTimeoutMS=5000)
        print("Connected to MongoDB")

        self.mongodb = self.client.get_database("tell_the_world")

        collection_names = self.mongodb.list_collection_names()
        default_collections = ["users", "messages"]
        for c in default_collections:
            if c not in collection_names:
                self.collections[c] = self.mongodb.create_collection(c)
            else:
                self.collections[c] = self.mongodb.get_collection(c)

        print("Created all default collections")
        print(self.collections)

from flask import Flask
from flask_restful import Api
from endpoints.user_endpoint import UserEndpoint


class ApiApp:
    def __init__(self):
        self.app = Flask(__name__)
        self.api = Api(self.app)

    def run(self):
        print("Adding endpoints")
        self.api.add_resource(UserEndpoint, "/api/v1/user/<string:tag>/")
        print("Running api app")
        self.app.run(host="localhost", port=8080, debug=True)


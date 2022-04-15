from flask import Flask
from flask_restful import Api

from endpoints.message_endpoint import MessageEndpoint
from endpoints.user_endpoint import UserEndpoint


class ApiApp:
    def __init__(self):
        self.app = Flask(__name__)
        self.api = Api(self.app)
        self.api.add_resource(UserEndpoint, "/api/v1/user/<string:tag>/")
        self.api.add_resource(MessageEndpoint, "/api/v1/message/<string:message_id>/")

    def run(self):
        print("Running api app")
        self.app.run(host="localhost", port=8080, debug=True)


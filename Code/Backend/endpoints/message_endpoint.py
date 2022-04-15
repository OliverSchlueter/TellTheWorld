from flask_restful import Resource, abort

from classes.Message import get_message_from_database


class MessageEndpoint(Resource):

    def get(self, message_id):
        message = get_message_from_database(message_id)
        if message is None:
            abort(404, message="Could not find message")

        return {message.message_id: message.to_json()}

    def put(self, tag):
        pass

    def delete(self, tag):
        pass

    def patch(self, tag):
        pass

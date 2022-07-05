from flask import request
from flask_restful import Resource, abort

from classes.Message import get_message_from_database, add_message_to_database


class MessageEndpoint(Resource):

    def get(self, message_id):
        message = get_message_from_database(message_id)
        if message is None:
            abort(404, message="Could not find message")

        return {message.message_id: message.to_json()}

    def put(self, message_id):
        needed_keys = ["message_id", "timestamp", "user_tag", "content"]

        message_data = request.form

        for key in needed_keys:
            if key not in message_data:
                abort(404, message=f"Invalid or missing data ({key})")

        m = add_message_to_database(message_data["message_id"], message_data["timestamp"], message_data["user_tag"], message_data["content"])


        return {"pog added": m.to_json()}

    def delete(self, tag):
        pass

    def patch(self, tag):
        pass

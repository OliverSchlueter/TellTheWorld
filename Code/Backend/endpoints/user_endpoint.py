from flask_restful import Resource, abort

from classes.User import get_from_database


class UserEndpoint(Resource):

    def get(self, tag):
        user = get_from_database(tag)
        if user is None:
            abort(404, message="Could not find user")

        return {user.tag: user.to_json()}

    def put(self, tag):
        pass

    def delete(self, tag):
        pass

    def patch(self, tag):
        pass

import database
from time import sleep
from flask_app import ApiApp

if __name__ == '__main__':
    database.db = database.Database()
    database.db.connect()
    sleep(2.0)
    app = ApiApp()
    app.run()

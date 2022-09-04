package de.oliver.telltheworldapi;

import de.oliver.telltheworldapi.database.Database;
import de.oliver.telltheworldapi.database.DatabaseInformation;

import java.util.logging.Logger;


public class TellTheWorldApi {

    private final Logger logger;
    private final DatabaseInformation databaseInformation;
    private final Database database;

    public TellTheWorldApi(Logger logger, DatabaseInformation databaseInformation) {
        this.logger = logger;
        this.databaseInformation = databaseInformation;
        this.database = new Database(databaseInformation);
    }

    public void connectDatabase(){
        if(!database.connect()){
            TellTheWorldApiApplication.getAppContext().close();
        }
    }

    public DatabaseInformation getDatabaseInformation() {
        return databaseInformation;
    }

    public Database getDatabase() {
        return database;
    }

    public Logger getLogger() {
        return logger;
    }

}

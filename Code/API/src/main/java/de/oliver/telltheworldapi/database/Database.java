package de.oliver.telltheworldapi.database;

import de.oliver.telltheworldapi.TellTheWorldApiApplication;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;

public class Database {

    private final DatabaseInformation databaseInformation;
    private Connection connection;

    public Database(DatabaseInformation databaseInformation){
        this.databaseInformation = databaseInformation;
    }

    public boolean connect(){
        if(!isConnected()) {
            if (databaseInformation != null) {
                try {
                    connection = databaseInformation.newConnection();
                    TellTheWorldApiApplication.getInstance().getLogger().info("Connected to database successful");
                    return true;
                } catch (SQLException e) {
                    e.printStackTrace();
                    return false;
                }
            } else {
                TellTheWorldApiApplication.getInstance().getLogger().info("Could not connect to database - database information is missing");
                return false;
            }
        }

        return true;
    }

    public void close(){
        if(isConnected()){
            try{
                connection.close();
                TellTheWorldApiApplication.getInstance().getLogger().info("Disconnected database successful");
            } catch (SQLException e){
                e.printStackTrace();
            }
        }
    }

    public boolean isConnected(){
        return connection != null;
    }

    public void execute(String sql){
        if(isConnected()){
            try {
                connection.createStatement().executeUpdate(sql);
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public ResultSet getResult(String sql) {
        if (isConnected()) {
            try {
                return connection.createStatement().executeQuery(sql);
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        return null;
    }

    public Connection getConnection() {
        return connection;
    }
}

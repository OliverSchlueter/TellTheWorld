package de.oliver.telltheworldapi.database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public record DatabaseInformation(String host, String port, String username, String password, String database) {

    public String connectionURL(){
        return "jdbc:mysql://" + host + ":" + port + "/" + database;
    }

    public Connection newConnection() throws SQLException {
        return DriverManager.getConnection(connectionURL(), username, password);
    }
}
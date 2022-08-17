package de.oliver.telltheworldapi;

import de.oliver.telltheworldapi.database.DatabaseInformation;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ConfigurableApplicationContext;

import java.util.logging.Logger;

@SpringBootApplication
public class TellTheWorldApiApplication {

	private static TellTheWorldApi instance;
	private static ConfigurableApplicationContext appContext;

	public static void main(String[] args) {
		appContext =  SpringApplication.run(TellTheWorldApiApplication.class, args);
		//TODO: save database information in a config file
		instance = new TellTheWorldApi(Logger.getGlobal(), new DatabaseInformation("localhost", "3306", "root", "", "telltheworld"));
		instance.connectDatabase();
	}

	public static TellTheWorldApi getInstance() {
		return instance;
	}

	public static ConfigurableApplicationContext getAppContext() {
		return appContext;
	}
}

package de.oliver.telltheworldapi.entities;

import de.oliver.telltheworldapi.TellTheWorldApi;
import de.oliver.telltheworldapi.TellTheWorldApiApplication;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;

public record User(String tag, long joined, String nickname, String email, String birthdate, String aboutMe) {
    private static final Map<String, User> userCache = new HashMap<>();

    public User {
        if(!userCache.containsKey(tag))
            userCache.put(tag, this);
    }

    public static User getUser(String tag){
        User user = getFromCache(tag);

        if(user == null)
            user = loadFromDatabase(tag);

        return user;
    }

    public static User getFromCache(String tag){
        if(userCache.containsKey(tag))
            return userCache.get(tag);

        return null;
    }

    public static User loadFromDatabase(String tag){
        ResultSet resultSet = TellTheWorldApiApplication.getInstance().getDatabase().getResult("SELECT * FROM users WHERE tag='" + tag + "' LIMIT 1");
        try{
            resultSet.next();
            return new User(
                    resultSet.getString("tag"),
                    resultSet.getLong("joined"),
                    resultSet.getString("nickname"),
                    resultSet.getString("email"),
                    resultSet.getString("birthdate"),
                    resultSet.getString("about_me")
            );

        }catch (SQLException e){
            e.printStackTrace();
        }

        return null;
    }

    public static Map<String, Object> userToMap(User user){
        Map<String, Object> map = new HashMap<>();
        map.put("tag", user.tag);
        map.put("joined", user.joined);
        map.put("nickname", user.nickname);
        map.put("email", user.email);
        map.put("birthdate", user.birthdate);
        map.put("about_me", user.aboutMe);

        return map;
    }

    public static User mapToUser(Map<String, Object> map){
        return new User(
                (String) map.get("tag"),
                (Long) map.get("joined"),
                (String) map.get("nickname"),
                (String) map.get("email"),
                (String) map.get("birthdate"),
                (String) map.get("about_me")
            );
    }
}

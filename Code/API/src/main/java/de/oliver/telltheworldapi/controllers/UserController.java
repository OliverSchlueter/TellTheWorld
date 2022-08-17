package de.oliver.telltheworldapi.controllers;

import de.oliver.telltheworldapi.TellTheWorldApi;
import de.oliver.telltheworldapi.TellTheWorldApiApplication;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;

@RestController
@RequestMapping("/user")
public class UserController {

    @GetMapping
    public Map<String, Object> userByTag(@RequestParam String tag){
        Map<String, Object> map = new HashMap<>();

        ResultSet resultSet = TellTheWorldApiApplication.getInstance().getDatabase().getResult("SELECT * FROM users WHERE tag='" + tag + "' LIMIT 1");
        try{

            if(resultSet.getRow() == 0){
                map.put("error", "invalid tag");
                return map;
            }

            resultSet.next();
            map.put("joined", resultSet.getObject("joined"));
            map.put("nickname", resultSet.getObject("nickname"));
            map.put("email", resultSet.getObject("email"));
            map.put("birthdate", resultSet.getObject("birthdate"));
            map.put("about_me", resultSet.getObject("about_me"));
        }catch (SQLException e){
            e.printStackTrace();
        }

        return map;
    }

}

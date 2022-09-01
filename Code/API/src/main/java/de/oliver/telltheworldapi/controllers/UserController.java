package de.oliver.telltheworldapi.controllers;

import de.oliver.telltheworldapi.entities.User;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import java.util.HashMap;
import java.util.Map;

@RestController
@RequestMapping("/user")
public class UserController {

    @GetMapping
    public Map<String, Object> userByTag(@RequestParam String tag){
        Map<String, Object> map = new HashMap<>();

        User user = User.getUser(tag);

        if(user == null){
            map.put("error", "Could not find user");
            return map;
        }

        map = User.userToMap(user);

        return map;
    }

}

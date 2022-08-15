package de.oliver.telltheworldapi.controllers;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.HashMap;
import java.util.Map;

@RestController
@RequestMapping("/test")
public class TestController {

    @GetMapping
    public Map<String, Object> helloWorld(){
        Map<String, Object> map = new HashMap<>();
        map.put("Hello", "World");
        return map;
    }
}

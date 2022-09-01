package de.oliver.telltheworldapi.entities;

import org.junit.jupiter.api.Test;

import java.util.HashMap;
import java.util.Map;

class UserTest {

    @Test
    void userToMap() {
        User user = new User(
                "tag#1245",
                52L,
                "test_nickname",
                "test@email.com",
                "01-01-2022",
                "about me"
        );

        Map<String, Object> map = User.userToMap(user);

        assert map.containsKey("tag");
        assert map.containsKey("joined");
        assert map.containsKey("nickname");
        assert map.containsKey("email");
        assert map.containsKey("birthdate");
        assert map.containsKey("about_me");

        assert ((String) map.get("tag")).equals("tag#1245");
        assert (long) map.get("joined") == 52L;
        assert ((String) map.get("nickname")).equals("test_nickname");
        assert ((String) map.get("email")).equals("test@email.com");
        assert ((String) map.get("birthdate")).equals("01-01-2022");
        assert ((String) map.get("about_me")).equals("about me");
    }

    @Test
    void mapToUser() {
        Map<String, Object> map = new HashMap<>();
        map.put("tag", "myTag");
        map.put("joined", 123L);
        map.put("nickname", "my nickname");
        map.put("email", "my@email.com");
        map.put("birthdate", "02-03-2022");
        map.put("about_me", "hello world");

        User user = User.mapToUser(map);

        assert user.tag().equals("myTag");
        assert user.joined() == 123L;
        assert user.nickname().equals("my nickname");
        assert user.email().equals("my@email.com");
        assert user.birthdate().equals("02-03-2022");
        assert user.aboutMe().equals("hello world");
    }
}
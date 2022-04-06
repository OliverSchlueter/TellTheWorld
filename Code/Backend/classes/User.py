import database


class User:
    def __init__(self,
                 tag: str,
                 joined: int,
                 nickname: str,
                 email: str,
                 birthdate: int,
                 followers: [],
                 following: [],
                 about_me: str,
                 profile_picture: str
                 ):
        self.tag = tag
        self.joined = joined
        self.nickname = nickname
        self.email = email
        self.birthdate = birthdate
        self.followers = followers
        self.following = following
        self.about_me = about_me
        self.profile_picture = profile_picture

    def to_json(self):
        return {"tag": self.tag, "joined": self.joined, "nickname": self.nickname, "email": self.email,
                "birthdate": self.birthdate, "followers": self.followers, "following": self.following,
                "about_me": self.about_me, "profile_picture": self.profile_picture}


def get_from_database(tag: str):
    res = database.db.collections["users"].find_one({"tag": tag})
    if res is None:
        return None

    return User(res["tag"], res["joined"], res["nickname"], res["email"], res["birthdate"], res["followers"],
                res["following"], res["about_me"], res["profile_picture"])

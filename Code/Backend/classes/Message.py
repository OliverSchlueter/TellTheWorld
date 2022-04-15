import database


class Message:
    def __init__(self,
                 message_id: str,
                 timestamp: int,
                 user_tag: str,
                 content: str,
                 amount_likes: int,
                 likes: [],
                 amount_comments: int,
                 comments: []):
        self.message_id = message_id
        self.timestamp = timestamp
        self.user_tag = user_tag
        self.content = content
        self.amount_likes = amount_likes
        self.likes = likes
        self.amount_comments = amount_comments
        self.comments = comments

    def to_json(self):
        return {"message_id": self.message_id, "timestamp": self.timestamp, "user": self.user_tag,
                "content": self.content,
                "amount_likes": self.amount_likes, "likes": self.likes, "amount_comments": self.amount_comments,
                "comments": self.comments}


def get_message_from_database(message_id: str):
    res = database.db.collections["messages"].find_one({"message_id": message_id})
    if res is None:
        return None

    return Message(res["message_id"], res["timestamp"], res["user_tag"], res["content"], res["amount_likes"],
                   res["likes"],
                   res["amount_comments"], res["comments"])

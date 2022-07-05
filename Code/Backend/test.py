import requests

BASE = "http://localhost:8080/api/v1/"

# "message_id", "timestamp", "user_tag", "content"
response = requests.put(BASE + "message/msgasfasfasf/", {"message_id": "12344242141", "timestamp": "5464651", "user_tag": "Oliver#80273", "content": "POG POGPO GOPGOO :beers:"})
print(response.json())


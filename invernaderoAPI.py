import requests

url = "http://localhost/crops/admin/invernadero.api.php"

payload = {}
files={}
headers = {}

response = requests.request("GET", url, headers=headers, data=payload, files=files)

print(response.text)

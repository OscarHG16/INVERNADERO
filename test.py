import requests

url = "http://localhost/crops/admin/permisos.api.php"

payload = {}
headers = {
  'Cookie': 'PHPSESSID=cadpg4tsa6pit737bjcovm3m0u'
}

response = requests.request("GET", url, headers=headers, data=payload)

print(response.text)

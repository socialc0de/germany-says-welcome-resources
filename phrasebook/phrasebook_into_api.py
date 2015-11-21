import json
import requests
import glob
from getpass import getpass
url = "https://gsw.pajowu.de"
phrases = {}
categories = {}
headers={'content-type': 'application/json', "Accept-Language":"en"}
username = input("Username: ")
password = str(getpass("Pass: "))
req = requests.post(url + "/api/api-token-auth/", data={"username":username,"password":password})
headers['Authorization'] = 'Token ' + req.json()['token']
req = requests.get(url + "/api/phrasecategories/")
for cat in req.json():
    categories[cat['id']] = cat
with open("phrasebook.json") as jsonfile:
    jsondata = json.load(jsonfile)
    for language_name, language_data in jsondata.items():
        language_code = language_data['lang']
        for category_id, category_data in language_data['categories'].items():
            category_url = "%s/api/phrasecategories/%s/"%(url,category_id)
            if int(category_id) not in categories:
                categories[int(category_id)] = {"id": int(category_id), "translations":{language_code:{"name":category_data['label']}}}
            else:
                if language_code not in categories[int(category_id)]['translations']:
                    categories[int(category_id)]['translations'][language_code] = {'name':category_data['label']}
                else:
                    categories[int(category_id)]['translations'][language_code]['name'] = category_data['label']

            for phrase_id, phrase in category_data['phrases'].items():
                pid = phrase_id.replace(".","_").replace("/","_")
                if pid not in phrases:
                    phrases[pid] = {"text_id": pid, "translations":{language_code:{"phrase":phrase}}, "category":category_url}
                else:
                    if language_code not in phrases[pid]['translations']:
                        phrases[pid]['translations'][language_code] = {'phrase':phrase}
                    else:
                        phrases[pid]['translations'][language_code]['name'] = phrase

for category, category_data in categories.items():
    req = requests.get("%s/api/phrasecategories/%s/"%(url,category),headers=headers)
    if req.status_code == 404:
        req = requests.post("%s/api/phrasecategories/"%url,json=category_data,headers=headers)
        print("%d: %s %s" % (req.status_code,req.text, category_data))
    else:
        req = requests.put("%s/api/phrasecategories/%s/"%(url,category),json=category_data,headers=headers)
for phrase, phrase_data in phrases.items():
    req = requests.get("%s/api/phrasebook/%s/"%(url,phrase),headers=headers)
    if req.status_code == 404:
        req = requests.post("%s/api/phrasebook/"%url,json=phrase_data,headers=headers)
        print("%d: %s %s" % (req.status_code,req.text, phrase_data))
    else:
        req = requests.put("%s/api/phrasebook/%s/"%(url,phrase),json=phrase_data,headers=headers)
    print("%d: %s" % (req.status_code,req.text))
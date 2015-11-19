# Phrasebook related resources

"Germany Says Welcome" uses phrasebook data from the fellow project [Refugee Phrasebook](http://www.refugeephrasebook.de).
 This project maintains a phrasebook with common and useful phrases in many languages. The data is kept in a
 Google docs spreadsheet with one phrase per row. 
 
 To make use of the data, "Germany Says Welcome" exports the phrasebook to JSON and imports the data into the API data 
 model. To export the data, we developed a Google App Script for https://script.google.com 
 which can be deployed as a Web-App. 
 
<b>Note: The export script is very slow and takes at least 3 minutes to return something.</b>
 
 
## Files

### phrasebook.json

The phrasebook data as a nested JSON object.
  
### export.js

Creates phrasebook.json from the Google Apps document in the official project repository of 
[Refugee Phrasebook](http://www.refugeephrasebook.de). Meant to be run at [https://script.google.com](https://script.google.com).

### database.sql

A possible database structure. This is not the database structure from "Germany Says Welcome" but can be used as a good starting
point for own development work.

### import.js

An import script to import the `phrasebook.json` into the database defined by `database.sql`. This script is a node.js
script and prints SQL instructions to be run by MySQL. Run this command to get started:

    npm install
  




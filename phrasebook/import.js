var squel = require("squel");
var jsonfile = require("jsonfile");

var squelOptions = {
    replaceSingleQuotes: true,
    singleQuoteReplacement: "\\'"
};

var phraseIds = {};

var phrasesSql = [];
var categoriesSql = [];

var ID = 1;
var json = jsonfile.readFileSync("phrasebook.json");
for ( var language in json ) {
    var langRoot= json[language];
    var lang = langRoot.lang;
    var categories = langRoot.categories;
    for ( var catId in categories ) {
        var cat = categories[catId];
        var catLabel = cat.label;
        catLabel = catLabel.trim();
        var sql = squel.insert(squelOptions)
            .into('phrasebook_categories')
            .set('id', catId)
            .set('lang', lang, '')
            .set('label', catLabel)
            .toString();
        categoriesSql.push(sql.trim());
        var phrases = cat.phrases;
        for ( var textId in phrases ) {
            phraseIds[textId] = phraseIds[textId] || ID++;
            var phraseId = phraseIds[textId];
            var translation = phrases[textId];
            sql = squel.insert(squelOptions)
                .into("phrasebook_phrases")
                .set('id', phraseId)
                .set('lang', lang)
                .set('cat_id', catId)
                .set('translation', translation)
                .toString();
            phrasesSql.push(sql.trim());
        }
    }
}

// Output
console.log("DELETE FROM phrasebook_categories;");
categoriesSql.forEach(function(sql) {
    console.log(sql + ";");
});
console.log("\n");
phrasesSql.forEach(function(sql) {
    console.log(sql + ";");
});

/* This script must be run at http://script.google.com. */

function exportRefugeePhrasebook() {
    var ss = SpreadsheetApp.openByUrl(
        'https://docs.google.com/spreadsheets/d/1IpkETNzRzletRpLEeLUKAldB2j_O8UJVn1zM_sYg56Y/edit#gid=0'
    );
    var sheet = ss.getSheets()[0];
    var lastCol = sheet.getLastColumn();
    var lastRow = sheet.getLastRow();

    // Find row with column headings.
    var columns = {};
    var translations = {
        "German": { lang: "de" },
        "English": { lang: "en" },
        "French": { lang: "fr" },
        "Standard Arabic": { lang: "ar" }
    };
    var captionRow = undefined;
    var idCol = undefined;
    for ( var row = 1; row <= lastRow && captionRow === undefined; row++ ) {
        for ( var col = 1; col <= lastCol && captionRow === undefined; col++ ) {
            var values = sheet.getSheetValues(row, col, 1, 1);
            if ( values[0][0] == "ID" ) {
                captionRow = row;
                idCol = col;
            }
        }
    }
    if ( captionRow === undefined ) {
        Logger.log("ERROR: Unable to find row with ID caption");
        return;
    }
    for ( var col = 1; col <= lastCol; col++ ) {
        var values = sheet.getSheetValues(captionRow, col, 1, 1);
        var caption = values[0][0];
        if ( translations[caption] !== undefined ) {
            columns[caption] = col;
        }
    }
    var catId;
    var ID = 1;
    for ( var row = captionRow+1; row <= lastRow; row++ ) {
        var values = sheet.getSheetValues(row, 1, 1, lastCol)[0];
        var id = values[idCol-1];
        var range = sheet.getRange(row, 1);
        var bg = range.getBackground();
        if ( bg == "#ffff00" ) {
            // Yellow cell background indicates a category.
            catId = ID++;
            for ( var key in translations ) {
                var targetCol = columns[key];
                var label = values[targetCol-1];
                label = label || "";
                translations[key].categories = translations[key].categories || {};
                translations[key].categories[catId] = { label: label };
            }
        } else {
            // Non-yellow background indicates a phrase.
            if ( catId === undefined ) continue; // Skip until first category found.
            if ( id === undefined || id == "" ) continue; // Skip everything without an ID string.
            for ( var key in translations ) {
                if ( translations[key].categories[catId] === undefined ) {
                    continue; // Skip if there is no category in the language.
                }
                translations[key].categories[catId].phrases = translations[key].categories[catId].phrases || {};
                var targetCol = columns[key];
                var label = values[targetCol-1];
                if ( label == "" ) {
                    continue; // If there is no label, skip this item for the language.
                }
                translations[key].categories[catId].phrases[id] = label;
            }
        }
    }
    return translations;
}

function doGet() {
    var json = JSON.stringify(exportRefugeePhrasebook());
    return ContentService.createTextOutput(json);
}

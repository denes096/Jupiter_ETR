(function(window, undefined) {
  var dictionary = {
    "8692f08e-cc38-457b-9041-10f1d5a14933": "admin_login",
    "11eacf90-b208-44aa-a1e9-f0ca9003ba18": "uzenetek",
    "175456e3-6802-4a58-99e6-5f8778cbe562": "home_tanar",
    "b17d17d4-41cb-4326-91d4-70a640a23c62": "Vizsgák",
    "09ebde7b-044b-48c8-90a3-104956cab25a": "Adminvizsga",
    "a70827e6-ce87-4ff1-922c-62830142c122": "adminkurzus",
    "26311608-0dc7-42f5-908b-db83f710338d": "Szemelyesa",
    "5ea3172a-48c1-4cce-8777-8d950b2d8c34": "adminaddhallgato",
    "16ef5ecc-7226-4278-9318-2809fca374a7": "adminadatok",
    "d12245cc-1680-458d-89dd-4f0d7fb22724": "Screen 1",
    "b2045abd-51dc-4da9-9a9c-6661c82ab30a": "kurzusok",
    "81304014-f3a7-49a5-b3ae-0ecad979ccb6": "eredmenyek",
    "18f856ca-2a8b-48e7-8284-70e3b3c1203a": "admin_page",
    "6b3e3f2a-4dbc-4af4-9ce7-385692ac1787": "horarend",
    "e6a84bbd-a714-4b0c-ad65-8cba722e6f11": "home",
    "4e3f95d9-73d7-4fde-ab31-23d035ceb8d1": "orarend",
    "8a78a37a-b89c-4534-95d5-70b92ebf8898": "adminaddtanar",
    "688f1826-0025-4e71-b8c5-5acf4b81d594": "statisztika",
    "e849d2d0-5f65-4772-ab9e-8baf7ade8ffe": "felh_template",
    "a5d057ff-1dc7-40e1-b0c9-6f44e9938885": "tanartemplate",
    "b4432832-687d-4f9b-ae19-37b678c2c177": "admin template",
    "f39803f7-df02-4169-93eb-7547fb8c961a": "Template 1",
    "bb8abf58-f55e-472d-af05-a7d1bb0cc014": "default"
  };

  var uriRE = /^(\/#)?(screens|templates|masters|scenarios)\/(.*)(\.html)?/;
  window.lookUpURL = function(fragment) {
    var matches = uriRE.exec(fragment || "") || [],
        folder = matches[2] || "",
        canvas = matches[3] || "",
        name, url;
    if(dictionary.hasOwnProperty(canvas)) { /* search by name */
      url = folder + "/" + canvas;
    }
    return url;
  };

  window.lookUpName = function(fragment) {
    var matches = uriRE.exec(fragment || "") || [],
        folder = matches[2] || "",
        canvas = matches[3] || "",
        name, canvasName;
    if(dictionary.hasOwnProperty(canvas)) { /* search by name */
      canvasName = dictionary[canvas];
    }
    return canvasName;
  };
})(window);
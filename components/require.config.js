var components = {
    "packages": [
        {
            "name": "angular-resource",
            "main": "angular-resource-built.js"
        },
        {
            "name": "angular-route",
            "main": "angular-route-built.js"
        },
        {
            "name": "angularjs",
            "main": "angularjs-built.js"
        },
        {
            "name": "bootstrap3",
            "main": "bootstrap3-built.js"
        },
        {
            "name": "foundation",
            "main": "foundation-built.js"
        },
        {
            "name": "jquery",
            "main": "jquery-built.js"
        },
        {
            "name": "modernizr",
            "main": "modernizr-built.js"
        },
        {
            "name": "underscore",
            "main": "underscore-built.js"
        }
    ],
    "shim": {
        "bootstrap3": {
            "deps": [
                "jquery"
            ]
        },
        "foundation": {
            "exports": "window.Foundation",
            "deps": [
                "jquery",
                "modernizr"
            ]
        },
        "modernizr": {
            "exports": "window.Modernizr"
        },
        "underscore": {
            "exports": "_"
        }
    },
    "baseUrl": "components"
};
if (typeof require !== "undefined" && require.config) {
    require.config(components);
} else {
    var require = components;
}
if (typeof exports !== "undefined" && typeof module !== "undefined") {
    module.exports = components;
}
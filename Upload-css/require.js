/* browser js require 
   adds a script tag to the document to load the required js file */
var require = function(name) {

    'use strict';

    var head = document.getElementsByTagName('head')[0];

    // check if the required file is already included
    var scripts = head.getElementsByTagName('script');
    for (var i=0; i<scripts.length; i++) {
	if (scripts[i].src === window.location.origin+name)
	    return;
    }

    var script = document.createElement('script');
    script.src = name;
    head.appendChild(script);
}

var requireStyle = function(name) {

    'use strict';

    var head = document.getElementsByTagName('head')[0];

    // check if the required file is already included
    var styles = head.getElementsByTagName('link');
    for (var i=0; i<styles.length; i++) {
	if (styles[i].src == name)
	    return;
    }

    var style = document.createElement('link');
    style.rel = 'stylesheet';
    style.href = name;
    head.appendChild(style);
}

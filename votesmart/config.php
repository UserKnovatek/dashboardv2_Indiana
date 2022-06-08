<?php

define("_KEY_", "0b70613994592885bd605a7862655911");      // Authentication key provided to you

define("_OUTPUT_", "JSON");        // Don't change this unless you have to
                                // XML/JSON
                                
define("_ERRORLEVEL_", 1);        // 0 - displays basic errors
                                // 1 - more detailed errors

/** Do not edit below this line **/
                                
if (_ERRORLEVEL_ >= 1) {
        error_reporting(E_ALL ^ E_NOTICE); // All but notice errors
} else {
        error_reporting(E_NONE);
}
                                
define("_APISERVER_", "https://api.votesmart.org");       // Without trailing slash and with protocol

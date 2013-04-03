/**
 * VERY Simple PhantomJS Based Script to snapshot/render ajax pages
 *
 * @version 1.0
 * @see www.klederson.com
 * @author Klederson Bueno <klederson@klederson.com>
 * @licence Creative Commons
 */
var arrayOfUrls = [
  "www.flisolcampinas.net/#!/home/",
  "www.flisolcampinas.net/#!/sobre/",
  "www.flisolcampinas.net/#!/sobre/flisol-campinas/",
  "www.flisolcampinas.net/#!/inscreva-se/"
];

// Render Multiple URLs to file
var RenderUrlsToFile, system,fs;

system = require("system");
fs = require("fs");

//define
RenderUrlsToFile = function(urls, callbackPerUrl, callbackFinal) {
    var getFilename, next, page, retrieve, urlIndex, webpage, dest;
    urlIndex = 0;
    dest = "./snapshots/";
    webpage = require("webpage");
    page = null;
    getFilename = function(url) {
        //let's create the snapshot path
        var fragment, path, pattern = null;
        pattern = new RegExp("#!/(.+)","g");
        fragment = pattern.exec(url);
        path = (fragment[1].replace("#!/","")).split("/");

        //higienize path
        if(path[path.length-1] == "")
          path = path.slice(0,path.length-1);

        //define filename and cleanup path array
        var fileName = path.slice(-1) + ".html";

        if(path.length > 1) {
          path = path.slice(0,path.length-1);
          path = path.join("/") + "/";

          //create deph of folders
          fs.makeTree(path);

          fileName = path + fileName;
        }

        return fileName;
    };
    next = function(status, url, file) {
        page.close();
        callbackPerUrl(status, url, file);
        return retrieve();
    };
    retrieve = function() {
        var url;
        if (urls.length > 0) {
            url = urls.shift();
            urlIndex++;
            page = webpage.create();
            page.viewportSize = {
                width: 800,
                height: 600
            };
            page.settings.userAgent = "snapshot ro-bot";
            return page.open("http://" + url, function(status) {
                var file;
                file = dest + getFilename(url);
                if (status === "success") {
                    return window.setTimeout((function() {
                        //page.render(file + ".png");
                        fs.write(file, page.content,"w");
                        return next(status, url, file);
                    }), 200);
                } else {
                    return next(status, url, file);
                }
            });
        } else {
            return callbackFinal();
        }
    };
    return retrieve();
};

//calling
RenderUrlsToFile(arrayOfUrls, (function(status, url, file) {
    if (status !== "success") {
        //return console.log("Unable to render '" + url + "'");
    } else {
        //return console.log("Rendered '" + url + "' at '" + file + "'");
    }
}), function() {
    return phantom.exit();
});

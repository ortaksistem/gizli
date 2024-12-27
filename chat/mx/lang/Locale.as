class mx.lang.Locale
{
    static var __get__autoReplace, flaName, defaultLang, xmlDoc, callback, currentLang, __set__autoReplace, __get__languageCodeArray, __get__stringIDArray;
    function Locale()
    {
    } // End of the function
    static function get autoReplace()
    {
        return (mx.lang.Locale.autoReplacment);
    } // End of the function
    static function set autoReplace(auto)
    {
        autoReplacment = auto;
        //return (mx.lang.Locale.autoReplace());
        null;
    } // End of the function
    static function get languageCodeArray()
    {
        var _loc1 = new Array();
        for (var _loc2 in mx.lang.Locale.xmlMap)
        {
            if (_loc2 != undefined)
            {
                _loc1.push(_loc2);
            } // end if
        } // end of for...in
        return (_loc1);
    } // End of the function
    static function get stringIDArray()
    {
        var _loc1 = new Array();
        for (var _loc2 in mx.lang.Locale.stringMap)
        {
            if (_loc2 != "")
            {
                _loc1.push(_loc2);
            } // end if
        } // end of for...in
        return (_loc1);
    } // End of the function
    static function setFlaName(name)
    {
        flaName = name;
    } // End of the function
    static function getDefaultLang()
    {
        return (mx.lang.Locale.defaultLang);
    } // End of the function
    static function setDefaultLang(langCode)
    {
        defaultLang = langCode;
    } // End of the function
    static function addXMLPath(langCode, path)
    {
        if (mx.lang.Locale.xmlMap[langCode] == undefined)
        {
            mx.lang.Locale.xmlMap[langCode] = new Array();
        } // end if
        mx.lang.Locale.xmlMap[langCode].push(path);
    } // End of the function
    static function addDelayedInstance(instance, stringID)
    {
        mx.lang.Locale.delayedInstanceArray.push({inst: instance, strID: stringID});
        var _loc1 = mx.lang.Locale.delayedInstanceArray.length;
    } // End of the function
    static function checkXMLStatus()
    {
        var _loc1 = mx.lang.Locale.xmlDoc.loaded && mx.lang.Locale.xmlDoc.status == 0;
        return (_loc1);
    } // End of the function
    static function setLoadCallback(loadCallback)
    {
        callback = loadCallback;
    } // End of the function
    static function loadString(id)
    {
        return (mx.lang.Locale.stringMap[id]);
    } // End of the function
    static function loadStringEx(stringID, languageCode)
    {
        var _loc1 = mx.lang.Locale.stringMapList[languageCode];
        if (_loc1 != undefined)
        {
            return (_loc1[stringID]);
        }
        else
        {
            return ("");
        } // end else if
    } // End of the function
    static function setString(stringID, languageCode, stringValue)
    {
        var _loc1 = mx.lang.Locale.stringMapList[languageCode];
        if (_loc1 != undefined)
        {
            _loc1[stringID] = stringValue;
        }
        else
        {
            _loc1 = new Object();
            _loc1[stringID] = stringValue;
            mx.lang.Locale.stringMapList[languageCode] = _loc1;
        } // end else if
    } // End of the function
    static function initialize()
    {
        xmlDoc = new XML();
        mx.lang.Locale.xmlDoc.ignoreWhite = true;
        mx.lang.Locale.xmlDoc.onLoad = function (success)
        {
            mx.lang.Locale.onXMLLoad(success);
            mx.lang.Locale.callback.call(null, success);
        };
        var _loc1 = mx.lang.Locale.xmlLang;
        if (mx.lang.Locale.xmlMap[mx.lang.Locale.xmlLang] == undefined)
        {
            _loc1 = mx.lang.Locale.defaultLang;
        } // end if
        currentXMLMapIndex = 0;
        mx.lang.Locale.xmlDoc.load(mx.lang.Locale.xmlMap[_loc1][0]);
    } // End of the function
    static function loadLanguageXML(xmlLanguageCode, customXmlCompleteCallback)
    {
        var _loc1 = xmlLanguageCode == "" ? (System.capabilities.language) : (xmlLanguageCode);
        if (mx.lang.Locale.xmlMap[_loc1] == undefined)
        {
            _loc1 = mx.lang.Locale.defaultLang;
        } // end if
        if (customXmlCompleteCallback)
        {
            callback = customXmlCompleteCallback;
        } // end if
        if (mx.lang.Locale.stringMapList[xmlLanguageCode] == undefined)
        {
            if (mx.lang.Locale.xmlDoc)
            {
                delete mx.lang.Locale.xmlDoc;
            } // end if
            xmlDoc = new XML();
            mx.lang.Locale.xmlDoc.ignoreWhite = true;
            mx.lang.Locale.xmlDoc.onLoad = function (success)
            {
                mx.lang.Locale.onXMLLoad(success);
                mx.lang.Locale.callback.call(null, success);
            };
            mx.lang.Locale.xmlDoc.load(mx.lang.Locale.xmlMap[_loc1][0]);
        }
        else
        {
            stringMap = mx.lang.Locale.stringMapList[_loc1];
            if (mx.lang.Locale.callback)
            {
                mx.lang.Locale.callback.call(null, true);
            } // end if
        } // end else if
        currentLang = _loc1;
    } // End of the function
    static function onXMLLoad(success)
    {
        if (success == true)
        {
            delete mx.lang.Locale.stringMap;
            stringMap = new Object();
            mx.lang.Locale.parseStringsXML(mx.lang.Locale.xmlDoc);
            if (mx.lang.Locale.stringMapList[mx.lang.Locale.currentLang] == undefined)
            {
                mx.lang.Locale.stringMapList[mx.lang.Locale.currentLang] = mx.lang.Locale.stringMap;
            } // end if
            if (mx.lang.Locale.autoReplacment)
            {
                mx.lang.Locale.assignDelayedInstances();
            } // end if
        } // end if
    } // End of the function
    static function parseStringsXML(doc)
    {
        if (doc.childNodes.length > 0 && doc.childNodes[0].nodeName == "xliff")
        {
            mx.lang.Locale.parseXLiff(doc.childNodes[0]);
        } // end if
    } // End of the function
    static function parseXLiff(node)
    {
        if (node.childNodes.length > 0 && node.childNodes[0].nodeName == "file")
        {
            mx.lang.Locale.parseFile(node.childNodes[0]);
        } // end if
    } // End of the function
    static function parseFile(node)
    {
        if (node.childNodes.length > 1 && node.childNodes[1].nodeName == "body")
        {
            mx.lang.Locale.parseBody(node.childNodes[1]);
        } // end if
    } // End of the function
    static function parseBody(node)
    {
        for (var _loc1 = 0; _loc1 < node.childNodes.length; ++_loc1)
        {
            if (node.childNodes[_loc1].nodeName == "trans-unit")
            {
                mx.lang.Locale.parseTransUnit(node.childNodes[_loc1]);
            } // end if
        } // end of for
    } // End of the function
    static function parseTransUnit(node)
    {
        var _loc2 = node.attributes.resname;
        if (_loc2.length > 0 && node.childNodes.length > 0 && node.childNodes[0].nodeName == "source")
        {
            var _loc1 = mx.lang.Locale.parseSource(node.childNodes[0]);
            if (_loc1.length > 0)
            {
                mx.lang.Locale.stringMap[_loc2] = _loc1;
            } // end if
        } // end if
    } // End of the function
    static function parseSource(node)
    {
        if (node.childNodes.length > 0)
        {
            return (node.childNodes[0].nodeValue);
        } // end if
        return ("");
    } // End of the function
    static function assignDelayedInstances()
    {
        for (var _loc1 = 0; _loc1 < mx.lang.Locale.delayedInstanceArray.length; ++_loc1)
        {
            if (mx.lang.Locale.delayedInstanceArray[_loc1] != undefined)
            {
                var _loc3 = mx.lang.Locale.delayedInstanceArray[_loc1].inst;
                var _loc2 = mx.lang.Locale.delayedInstanceArray[_loc1].strID;
                _loc3.text = mx.lang.Locale.loadString(_loc2);
            } // end if
        } // end of for
    } // End of the function
    static var xmlLang = System.capabilities.language;
    static var xmlMap = new Object();
    static var stringMap = new Object();
    static var delayedInstanceArray = new Array();
    static var currentXMLMapIndex = -1;
    static var autoReplacment = true;
    static var stringMapList = new Object();
} // End of Class

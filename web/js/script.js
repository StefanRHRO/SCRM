/**
 * jquery.numberformatter - Formatting/Parsing Numbers in jQuery
 *
 * Written by
 * Michael Abernethy (mike@abernethysoft.com),
 * Andrew Parry (aparry0@gmail.com)
 *
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * @author Michael Abernethy, Andrew Parry
 * @version 1.2.2-RELEASE ($Id$)
 *
 * Dependencies
 *
 * jQuery (http://jquery.com)
 * jshashtable (http://www.timdown.co.uk/jshashtable)
 *
 * Notes & Thanks
 *
 * many thanks to advweb.nanasi.jp for his bug fixes
 * jsHashtable is now used also, so thanks to the author for that excellent little class.
 *
 * This plugin can be used to format numbers as text and parse text as Numbers
 * Because we live in an international world, we cannot assume that everyone
 * uses "," to divide thousands, and "." as a decimal point.
 *
 * As of 1.2 the way this plugin works has changed slightly, parsing text to a number
 * has 1 set of functions, formatting a number to text has it's own. Before things
 * were a little confusing, so I wanted to separate the 2 out more.
 *
 *
 * jQuery extension functions:
 *
 * formatNumber(options, writeBack, giveReturnValue) - Reads the value from the subject, parses to
 * a Javascript Number object, then formats back to text using the passed options and write back to
 * the subject.
 *
 * parseNumber(options) - Parses the value in the subject to a Number object using the passed options
 * to decipher the actual number from the text, then writes the value as text back to the subject.
 *
 *
 * Generic functions:
 *
 * formatNumber(numberString, options) - Takes a plain number as a string (e.g. '1002.0123') and returns
 * a string of the given format options.
 *
 * parseNumber(numberString, options) - Takes a number as text that is formatted the same as the given
 * options then and returns it as a plain Number object.
 *
 * To achieve the old way of combining parsing and formatting to keep say a input field always formatted
 * to a given format after it has lost focus you'd simply use a combination of the functions.
 *
 * e.g.
 * $("#salary").blur(function(){
 *              $(this).parseNumber({format:"#,###.00", locale:"us"});
 *              $(this).formatNumber({format:"#,###.00", locale:"us"});
 * });
 *
 * The syntax for the formatting is:
 * 0 = Digit
 * # = Digit, zero shows as absent
 * . = Decimal separator
 * - = Negative sign
 * , = Grouping Separator
 * % = Percent (multiplies the number by 100)
 *
 * For example, a format of "#,###.00" and text of 4500.20 will
 * display as "4.500,20" with a locale of "de", and "4,500.20" with a locale of "us"
 *
 *
 * As of now, the only acceptable locales are
 * Arab Emirates -> "ae"
 * Australia -> "au"
 * Austria -> "at"
 * Brazil -> "br"
 * Canada -> "ca"
 * China -> "cn"
 * Czech -> "cz"
 * Denmark -> "dk"
 * Egypt -> "eg"
 * Finland -> "fi"
 * France  -> "fr"
 * Germany -> "de"
 * Greece -> "gr"
 * Great Britain -> "gb"
 * Hong Kong -> "hk"
 * India -> "in"
 * Israel -> "il"
 * Japan -> "jp"
 * Russia -> "ru"
 * South Korea -> "kr"
 * Spain -> "es"
 * Sweden -> "se"
 * Switzerland -> "ch"
 * Taiwan -> "tw"
 * Thailand -> "th"
 * United States -> "us"
 * Vietnam -> "vn"
 **/

(function(jQuery) {

    var nfLocales = new Hashtable();

    var nfLocalesLikeUS = [ 'ae','au','ca','cn','eg','gb','hk','il','in','jp','sk','th','tw','us' ];
    var nfLocalesLikeDE = [ 'at','br','de','dk','es','gr','it','nl','pt','tr','vn' ];
    var nfLocalesLikeFR = [ 'cz','fi','fr','ru','se','pl' ];
    var nfLocalesLikeCH = [ 'ch' ];

    var nfLocaleFormatting = [
        [".", ","],
        [",", "."],
        [",", " "],
        [".", "'"]
    ];
    var nfAllLocales = [ nfLocalesLikeUS, nfLocalesLikeDE, nfLocalesLikeFR, nfLocalesLikeCH ]

    function FormatData(dec, group, neg) {
        this.dec = dec;
        this.group = group;
        this.neg = neg;
    }

    ;

    function init() {
        // write the arrays into the hashtable
        for (var localeGroupIdx = 0; localeGroupIdx < nfAllLocales.length; localeGroupIdx++) {
            localeGroup = nfAllLocales[localeGroupIdx];
            for (var i = 0; i < localeGroup.length; i++) {
                nfLocales.put(localeGroup[i], localeGroupIdx);
            }
        }
    }

    ;

    function formatCodes(locale) {
        if (nfLocales.size() == 0)
            init();

        // default values
        var dec = ".";
        var group = ",";
        var neg = "-";

        // hashtable lookup to match locale with codes
        var codesIndex = nfLocales.get(locale);
        if (codesIndex) {
            var codes = nfLocaleFormatting[codesIndex];
            if (codes) {
                dec = codes[0];
                group = codes[1];
            }
        }
        return new FormatData(dec, group, neg);
    }

    ;


    /*      Formatting Methods      */


    /**
     * Formats anything containing a number in standard js number notation.
     *
     * @param {Object}      options                 The formatting options to use
     * @param {Boolean}     writeBack               (true) If the output value should be written back to the subject
     * @param {Boolean} giveReturnValue     (true) If the function should return the output string
     */
    jQuery.fn.formatNumber = function(options, writeBack, giveReturnValue) {

        return this.each(function() {
            // enforce defaults
            if (writeBack == null)
                writeBack = true;
            if (giveReturnValue == null)
                giveReturnValue = true;

            // get text
            var text;
            if (jQuery(this).is(":input"))
                text = new String(jQuery(this).val());
            else
                text = new String(jQuery(this).text());

            // format
            var returnString = jQuery.formatNumber(text, options);

            // set formatted string back, only if a success
//                      if (returnString) {
            if (writeBack) {
                if (jQuery(this).is(":input"))
                    jQuery(this).val(returnString);
                else
                    jQuery(this).text(returnString);
            }
            if (giveReturnValue)
                return returnString;
//                      }
//                      return '';
        });
    };

    /**
     * First parses a string and reformats it with the given options.
     *
     * @param {Object} numberString
     * @param {Object} options
     */
    jQuery.formatNumber = function(numberString, options) {
        var options = jQuery.extend({}, jQuery.fn.formatNumber.defaults, options);
        var formatData = formatCodes(options.locale.toLowerCase());

        var dec = formatData.dec;
        var group = formatData.group;
        var neg = formatData.neg;

        var validFormat = "0#-,.";

        // strip all the invalid characters at the beginning and the end
        // of the format, and we'll stick them back on at the end
        // make a special case for the negative sign "-" though, so
        // we can have formats like -$23.32
        var prefix = "";
        var negativeInFront = false;
        for (var i = 0; i < options.format.length; i++) {
            if (validFormat.indexOf(options.format.charAt(i)) == -1)
                prefix = prefix + options.format.charAt(i);
            else
            if (i == 0 && options.format.charAt(i) == '-') {
                negativeInFront = true;
                continue;
            }
            else
                break;
        }
        var suffix = "";
        for (var i = options.format.length - 1; i >= 0; i--) {
            if (validFormat.indexOf(options.format.charAt(i)) == -1)
                suffix = options.format.charAt(i) + suffix;
            else
                break;
        }

        options.format = options.format.substring(prefix.length);
        options.format = options.format.substring(0, options.format.length - suffix.length);

        // now we need to convert it into a number
        //while (numberString.indexOf(group) > -1)
        //      numberString = numberString.replace(group, '');
        //var number = new Number(numberString.replace(dec, ".").replace(neg, "-"));
        var number = new Number(numberString);

        return jQuery._formatNumber(number, options, suffix, prefix, negativeInFront);
    };

    /**
     * Formats a Number object into a string, using the given formatting options
     *
     * @param {Object} numberString
     * @param {Object} options
     */
    jQuery._formatNumber = function(number, options, suffix, prefix, negativeInFront) {
        var options = jQuery.extend({}, jQuery.fn.formatNumber.defaults, options);
        var formatData = formatCodes(options.locale.toLowerCase());

        var dec = formatData.dec;
        var group = formatData.group;
        var neg = formatData.neg;

        var forcedToZero = false;
        if (isNaN(number)) {
            if (options.nanForceZero == true) {
                number = 0;
                forcedToZero = true;
            } else
                return null;
        }

        // special case for percentages
        if (suffix == "%")
            number = number * 100;

        var returnString = "";
        if (options.format.indexOf(".") > -1) {
            var decimalPortion = dec;
            var decimalFormat = options.format.substring(options.format.lastIndexOf(".") + 1);

            // round or truncate number as needed
            if (options.round == true)
                number = new Number(number.toFixed(decimalFormat.length));
            else {
                var numStr = number.toString();
                numStr = numStr.substring(0, numStr.lastIndexOf('.') + decimalFormat.length + 1);
                number = new Number(numStr);
            }

            var decimalValue = number % 1;
            var decimalString = new String(decimalValue.toFixed(decimalFormat.length));
            decimalString = decimalString.substring(decimalString.lastIndexOf(".") + 1);

            for (var i = 0; i < decimalFormat.length; i++) {
                if (decimalFormat.charAt(i) == '#' && decimalString.charAt(i) != '0') {
                    decimalPortion += decimalString.charAt(i);
                    continue;
                } else if (decimalFormat.charAt(i) == '#' && decimalString.charAt(i) == '0') {
                    var notParsed = decimalString.substring(i);
                    if (notParsed.match('[1-9]')) {
                        decimalPortion += decimalString.charAt(i);
                        continue;
                    } else
                        break;
                } else if (decimalFormat.charAt(i) == "0")
                    decimalPortion += decimalString.charAt(i);
            }
            returnString += decimalPortion
        } else
            number = Math.round(number);

        var ones = Math.floor(number);
        if (number < 0)
            ones = Math.ceil(number);

        var onesFormat = "";
        if (options.format.indexOf(".") == -1)
            onesFormat = options.format;
        else
            onesFormat = options.format.substring(0, options.format.indexOf("."));

        var onePortion = "";
        if (!(ones == 0 && onesFormat.substr(onesFormat.length - 1) == '#') || forcedToZero) {
            // find how many digits are in the group
            var oneText = new String(Math.abs(ones));
            var groupLength = 9999;
            if (onesFormat.lastIndexOf(",") != -1)
                groupLength = onesFormat.length - onesFormat.lastIndexOf(",") - 1;
            var groupCount = 0;
            for (var i = oneText.length - 1; i > -1; i--) {
                onePortion = oneText.charAt(i) + onePortion;
                groupCount++;
                if (groupCount == groupLength && i != 0) {
                    onePortion = group + onePortion;
                    groupCount = 0;
                }
            }

            // account for any pre-data 0's
            if (onesFormat.length > onePortion.length) {
                var padStart = onesFormat.indexOf('0');
                if (padStart != -1) {
                    var padLen = onesFormat.length - padStart;

                    // pad to left with 0's
                    while (onePortion.length < padLen) {
                        onePortion = '0' + onePortion;
                    }
                }
            }
        }

        if (!onePortion && onesFormat.indexOf('0', onesFormat.length - 1) !== -1)
            onePortion = '0';

        returnString = onePortion + returnString;

        // handle special case where negative is in front of the invalid characters
        if (number < 0 && negativeInFront && prefix.length > 0)
            prefix = neg + prefix;
        else if (number < 0)
            returnString = neg + returnString;

        if (!options.decimalSeparatorAlwaysShown) {
            if (returnString.lastIndexOf(dec) == returnString.length - 1) {
                returnString = returnString.substring(0, returnString.length - 1);
            }
        }
        returnString = prefix + returnString + suffix;
        return returnString;
    };


    /*      Parsing Methods */


    /**
     * Parses a number of given format from the element and returns a Number object.
     * @param {Object} options
     */
    jQuery.fn.parseNumber = function(options, writeBack, giveReturnValue) {
        // enforce defaults
        if (writeBack == null)
            writeBack = true;
        if (giveReturnValue == null)
            giveReturnValue = true;

        // get text
        var text;
        if (jQuery(this).is(":input"))
            text = new String(jQuery(this).val());
        else
            text = new String(jQuery(this).text());

        // parse text
        var number = jQuery.parseNumber(text, options);

        if (number) {
            if (writeBack) {
                if (jQuery(this).is(":input"))
                    jQuery(this).val(number.toString());
                else
                    jQuery(this).text(number.toString());
            }
            if (giveReturnValue)
                return number;
        }
    };

    /**
     * Parses a string of given format into a Number object.
     *
     * @param {Object} string
     * @param {Object} options
     */
    jQuery.parseNumber = function(numberString, options) {
        var options = jQuery.extend({}, jQuery.fn.parseNumber.defaults, options);
        var formatData = formatCodes(options.locale.toLowerCase());

        var dec = formatData.dec;
        var group = formatData.group;
        var neg = formatData.neg;

        var valid = "1234567890.-";

        // now we need to convert it into a number
        while (numberString.indexOf(group) > -1)
            numberString = numberString.replace(group, '');
        numberString = numberString.replace(dec, ".").replace(neg, "-");
        var validText = "";
        var hasPercent = false;
        if (numberString.charAt(numberString.length - 1) == "%")
            hasPercent = true;
        for (var i = 0; i < numberString.length; i++) {
            if (valid.indexOf(numberString.charAt(i)) > -1)
                validText = validText + numberString.charAt(i);
        }
        var number = new Number(validText);
        if (hasPercent) {
            number = number / 100;
            number = number.toFixed(validText.length - 1);
        }

        return number;
    };

    jQuery.fn.parseNumber.defaults = {
        locale: "us",
        decimalSeparatorAlwaysShown: false
    };

    jQuery.fn.formatNumber.defaults = {
        format: "#,###.00",
        locale: "us",
        decimalSeparatorAlwaysShown: false,
        nanForceZero: true,
        round: true
    };

    Number.prototype.toFixed = function(precision) {
        return $._roundNumber(this, precision);
    };

    jQuery._roundNumber = function(number, decimalPlaces) {
        var power = Math.pow(10, decimalPlaces || 0);
        var value = String(Math.round(number * power) / power);

        // ensure the decimal places are there
        if (decimalPlaces > 0) {
            var dp = value.indexOf(".");
            if (dp == -1) {
                value += '.';
                dp = 0;
            } else {
                dp = value.length - (dp + 1);
            }

            while (dp < decimalPlaces) {
                value += '0';
                dp++;
            }
        }
        return value;
    };

})(jQuery);


/**
 Created by: Michael Synovic
 on: 01/12/2003

 This is a Javascript implementation of the Java Hashtable object.

 Contructor(s):
 Hashtable()
 Creates a new, empty hashtable

 Method(s):
 void clear()
 Clears this hashtable so that it contains no keys.
 boolean containsKey(String key)
 Tests if the specified object is a key in this hashtable.
 boolean containsValue(Object value)
 Returns true if this Hashtable maps one or more keys to this value.
 Object get(String key)
 Returns the value to which the specified key is mapped in this hashtable.
 boolean isEmpty()
 Tests if this hashtable maps no keys to values.
 Array keys()
 Returns an array of the keys in this hashtable.
 void put(String key, Object value)
 Maps the specified key to the specified value in this hashtable. A NullPointerException is thrown is the key or value is null.
 Object remove(String key)
 Removes the key (and its corresponding value) from this hashtable. Returns the value of the key that was removed
 int size()
 Returns the number of keys in this hashtable.
 String toString()
 Returns a string representation of this Hashtable object in the form of a set of entries, enclosed in braces and separated by the ASCII characters ", " (comma and space).
 Array values()
 Returns a array view of the values contained in this Hashtable.

 */
function Hashtable() {
    this.clear = hashtable_clear;
    this.containsKey = hashtable_containsKey;
    this.containsValue = hashtable_containsValue;
    this.get = hashtable_get;
    this.isEmpty = hashtable_isEmpty;
    this.keys = hashtable_keys;
    this.put = hashtable_put;
    this.remove = hashtable_remove;
    this.size = hashtable_size;
    this.toString = hashtable_toString;
    this.values = hashtable_values;
    this.hashtable = new Array();
}

/*=======Private methods for internal use only========*/

function hashtable_clear() {
    this.hashtable = new Array();
}

function hashtable_containsKey(key) {
    var exists = false;
    for (var i in this.hashtable) {
        if (i == key && this.hashtable[i] != null) {
            exists = true;
            break;
        }
    }
    return exists;
}

function hashtable_containsValue(value) {
    var contains = false;
    if (value != null) {
        for (var i in this.hashtable) {
            if (this.hashtable[i] == value) {
                contains = true;
                break;
            }
        }
    }
    return contains;
}

function hashtable_get(key) {
    return this.hashtable[key];
}

function hashtable_isEmpty() {
    return (parseInt(this.size()) == 0) ? true : false;
}

function hashtable_keys() {
    var keys = new Array();
    for (var i in this.hashtable) {
        if (this.hashtable[i] != null)
            keys.push(i);
    }
    return keys;
}

function hashtable_put(key, value) {
    if (key == null || value == null) {
        throw "NullPointerException {" + key + "},{" + value + "}";
    } else {
        this.hashtable[key] = value;
    }
}

function hashtable_remove(key) {
    var rtn = this.hashtable[key];
    this.hashtable[key] = null;
    return rtn;
}

function hashtable_size() {
    var size = 0;
    for (var i in this.hashtable) {
        if (this.hashtable[i] != null)
            size ++;
    }
    return size;
}

function hashtable_toString() {
    var result = "";
    for (var i in this.hashtable) {
        if (this.hashtable[i] != null)
            result += "{" + i + "},{" + this.hashtable[i] + "}\n";
    }
    return result;
}

function hashtable_values() {
    var values = new Array();
    for (var i in this.hashtable) {
        if (this.hashtable[i] != null)
            values.push(this.hashtable[i]);
    }
    return values;
}

function strpos (haystack, needle, offset) {
    // Finds position of first occurrence of a string within another
    //
    // version: 1107.2516
    // discuss at: http://phpjs.org/functions/strpos
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Onno Marsman
    // +   bugfixed by: Daniel Esteban
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: strpos('Kevin van Zonneveld', 'e', 5);
    // *     returns 1: 14
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}
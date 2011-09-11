<?php
/* rss2csv.php - convert RSS feed to CSV format

   Created by Brian Cantoni <brian AT cantoni.org>
   scooterlabs.com/hacks/rss2csv.php
*/
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    header ('Allow: GET');
    header ('HTTP/1.0 405 Method Not Allowed');
    exit();
}

include ("./rss2csv.inc");

$url = isset($_GET['url']) ? $_GET['url'] : '';
$convert = ($url <> '') ? true : false;

if ($convert) {
    // fetch RSS content using YQL and output as CSV
    error_log (date(DATE_ISO8601) . "  $url\n",3,"/usr/home/bcantoni/public_html/scooterlabs/hacks/log/rss2csv.log");
    fetchRSSandOutputCSV ($url);
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <title>RSS to CSV Converter - Scoter Labs</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css&2.8.0r4/build/base/base-min.css">
    <style>
        h1 { font-size: 2em; margin: 0.5em; }
        body { overflow: auto; }
    </style>
</head>
<body>
<div id="doc3" class="yui-t7">
<div id="hd"><h1>RSS to CSV Converter</h1></div>
<div id="bd">
<div class="yui-g">

<form id="search-form" action="rss2csv.php" method="get">
  <fieldset>
    <label for="query">Enter URL of CSV file:</label>
    <input type="text" id="query" name="url" size="50" value="<?php echo $url; ?>" />
    <button type="submit">Submit</button>
  </fieldset>
</form>

<p>Notes:</p>
<ul>
<li>Excel does not properly handle UTF-8 CSV files, so you may see some corruption if the RSS feed contains intl characters</li>
<li>Fields output are: title, link, description, pubDate, guid</li>
<li>Only works for RSS feeds; if interested in Atom support, let me know</li>
</ul>

<div id="ft"><hr><p>Feedback/suggestions to Brian Cantoni (brian AT cantoni.org).</p></div>

</div>
</div>
</div>
</body>
</html>

<?php

/* This is a clock page that updates every minute, at
the top of the minute.  It uses client pull techniques
where the browser calls up a new page - usually every
60 seconds, but for the first page rather quicker, and
sometimes it just waits for 59 seconds ... */
date_default_timezone_set('Asia/Colombo');  // Set timezone.
// Find seconds REMAINING in minute
$seconds_to_go = 60 - date("s");
// If (first) minute very short, don't update again
// within 15 seconds!
if ($seconds_to_go < 15) $seconds_to_go += 60;

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta http-equiv="Refresh"
        content="<?php print($seconds_to_go); ?>; URL=<?php print($PHP_SELF); ?>">
        <title>Dynamic Clock Demo - HTML + PHP + CSS + JS </title>
</head>
<body>
        <center><h1>Clock Watcher's Home Page</h1></center>
        This is the main descriptive text of my page.<br /><br />
        It is <?php print(date('H:i (:s) \o\n l, jS F Y')); ?>
        <hr />
        
</body>
</html>
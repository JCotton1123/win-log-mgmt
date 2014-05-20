#!/usr/local/bin/php
<?php

//Set timezone
date_default_timezone_set("America/New_York");

//Connect to MySQL
$mysql_conn = mysql_connect('localhost','app_logmgmt','');
if(!$mysql_conn || !mysql_select_db('syslog')){
        echo "Failed to connect to MySQL. MySQL error: " . mysql_error();
}
else {

    //Delete log messages older than 30 days
    mysql_query("DELETE FROM win_logs where timestamp < '" . date('Y-m-d H:i:s',strtotime('-4 weeks')) . "'");

    //Delete net log messages older than 60 days
    mysql_query("DELETE FROM net_logs where timestamp < '" . date('Y-m-d H:i:s',strtotime('-4 weeks')) . "'");

    //Close mysql connection
    mysql_close($mysql_conn);
}

@mysql_close($mysql_conn);

?>

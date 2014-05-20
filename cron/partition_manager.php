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

        //Remove old partition
        $query = "ALTER TABLE win_logs DROP PARTITION p" . date('Ymd',strtotime("-31 days"));
        $result = mysql_query($query);
        if(!$result)
                echo "Error removing old partition. MySQL error: " . mysql_error() . "\n";


        //Remove max value partition
        $query = "ALTER TABLE win_logs DROP PARTITION pMAX";
        $result = mysql_query($query);
        if(!$result)
                "Error deleting MAXVALUE partition: MySQL error: " . mysql_error() . "\n";


        //Add new partition for tomorrow
        $query = "ALTER TABLE win_logs ADD PARTITION (" .
                "PARTITION p" . date('Ymd',strtotime("+1days")) . " VALUES LESS THAN ('" . date('Y-m-d',strtotime("+2days")) . "'))";
        $result = mysql_query($query);
        if(!$result)
                echo "Error creating new partition. MySQL error: " . mysql_error() . "\n";


        //Add MAX value partiton back
        $query = "ALTER TABLE win_logs ADD PARTITION (PARTITION pMAX VALUES LESS THAN (MAXVALUE))";
        $result = mysql_query($query);
        if(!$result)
                echo "Error re-adding MAXVALUE partition. MySQL error: " . mysql_error() . "\n";

}

@mysql_close($mysql_conn);

?>

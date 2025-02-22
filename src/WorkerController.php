<?php
$steps=0;
// load dependencies
require __DIR__ . '/../vendor/autoload.php'; 
++$steps;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create log
$log = new Logger("LogWorkerDB");
// define logs location
$log->pushHandler(new StreamHandler("../logs/WorkerDB.log", Level::Info)); 
++$steps;

//ddbb connection, read from miConf.ini
$db = parse_ini_file("../conf/miConf.ini");

//TODO
++$steps;

try {
    $mysqli = new mysqli($db["host"], $db["user"], $db["pwd"], $db["db_name"]); //4 db
    // write info message with "Connection successfully"
    $log->info("Connection successfully");
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    //TODO
    ++$steps;

    // Create operation
    $sql_sentence = "INSERT INTO worker(dni,name,surname,salary,phone) 
            VALUES('71111111D','Juan','González',20000,'93500202')";

    try {
        $result = $mysqli->query($sql_sentence);
        // write info message with "Record inserted successfully"
        $log->info("Record inserted successfully");
        //TODO
        ++$steps;
    } catch (mysqli_sql_exception $e) {
        //  write error message with "Error inserting a record"
        $log->error("Error inserting a record");
        //TODO
    }
    $mysqli->close();
} catch (mysqli_sql_exception $e) {
    //  write error message with "Error connection db: + details parameters config"
    $log->error("Error connection db: " . $e->getMessage());
    //TODO
}
echo "steps executed correctly: " . $steps;

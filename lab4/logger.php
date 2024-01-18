<?php

class Logger
{
    private $file;
    private $show;

    public function __construct($file = null, $show = false)
    {
        $this->file = $file;
        $this->show = $show;
    }


    public function log($message)
    {
        $date = date('Y-m-d H:i:s');
        $message = "[$date] $message\n";
        if ($this->show) {
            echo $message;
        }
        if ($this->file) {
            file_put_contents($this->file, $message, FILE_APPEND);
        }
    }
}
if (!($argc == 2 || $argc == 3)) {
    echo "Please enter 1 or 2 parameteres \n";
    return;
}
$findme = '.';
$pos = strpos($argv[1], $findme);
if ($argc == 2) {
    if ($pos !== false) {
        $a = new Logger(file: $argv[1]);

    } else {
        $a = new Logger(show: true);

    }
    $message = $argv[1];
} else {
    if ($pos !== false) {
        $a = new Logger(file: $argv[1]);

    } else {
        $a = new Logger(show: true);

    }
    $message = $argv[2];
}


$a->log($message);
?>
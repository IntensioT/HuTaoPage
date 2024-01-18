<?php
class FileSystemObject {
    public $name;
    public $size;
    public $type;

    function __construct($name, $size, $type) {
        $this->name = $name;
        $this->size = $size;
        $this->type = $type;
    }

    function getSizeInKB() {
        return round($this->size  / 1024, 2);
    }
}

$dir = './';
$files = scandir($dir);
// dsasnsdajsanjkdnsakjdnaskjdnaksjndkjasndjkasndkjasnkdjansjkdnasjknsdjknajksndjkasndjkasn

foreach ($files as $file) {
    if (is_file($dir . '/' . $file)) {
        $fso = new FileSystemObject($file, filesize($dir . '/' . $file), filetype($dir . '/' . $file));
        echo "{$fso->name} - {$fso->getSizeInKB()} kb\n";
    }
}
?>
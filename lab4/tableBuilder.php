<?php

$headers = array("Name", "Age", "Gender");
$tableBuilder = new TableBuilder($headers);
$tableBuilder->addRow(array("Jack", "25", "Male"));
$tableBuilder->addRow(array("Alice", "23", "Female"));
$tableBuilder->addRow(array("Alice111", "23", "Female"));
echo $tableBuilder->getTable();

class TableBuilder {
    private $table;
    private $rows = array();
    private $headers = array();
    
    public function __construct($headers) {
        $this->table = "<table>";
        $this->headers = $headers;
        $this->table .= "<tr>";
        foreach ($headers as $header) {
            $this->table .= "<th>$header</th>";
        }
        $this->table .= "</tr>";
    }
    
    public function addRow($row) {
        $this->rows[] = $row;
        $this->table .= "<tr>";
        foreach ($row as $cell) {
            $this->table .= "<td>$cell</td>";
        }
        $this->table .= "</tr>";
    }
    public function getTable() {
        return $this->table . "</table>";
    }
}
?>
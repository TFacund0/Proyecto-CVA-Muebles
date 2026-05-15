<?php
namespace App\Controllers;
class DebugController extends BaseController {
    public function checkTable() {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames('favoritos');
        echo "Campos en tabla favoritos: " . implode(', ', $fields) . "\n";
        
        $query = $db->query("SHOW CREATE TABLE favoritos");
        print_r($query->getRowArray());
    }
}

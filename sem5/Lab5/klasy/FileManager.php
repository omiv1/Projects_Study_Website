<?php
class FileManager {
    public static function createEmptyFiles() {
        $jsonFile = 'users.json';
        $xmlFile = 'users.xml';

        if (!file_exists($jsonFile)) {
            file_put_contents($jsonFile, json_encode([]));
        }

        if (!file_exists($xmlFile)) {
            $xml = new SimpleXMLElement('<users></users>');
            $xml->asXML($xmlFile);
        }
    }
}
?>

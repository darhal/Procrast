<?php
/*
 * Projet Procrast
 * @class: BDD
 * @brief: Class that abstract away the DB connections and make it easier to interact with
 * the DB
 * @author: Omar CHIDA
 * @date:27/02/2020
 * @version: 1.0
 */

    class BDD extends SQLite3
    {
        private $file_path;
        private $file_name;

        function __construct($filename) {
            $file_path = getenv('PROJECT_PATH')."/Assets/BD/".$filename;
            $file_name = $filename;
            parent::__construct($file_path);
        }

        function __destruct() {
            $this->close();
        }

        function getFilePath() {
            return $this->file_path;
        }

        function getFileName()
        {
            return $this->file_name;
        }

        function fetchResults($tab_name, $what = "*", $condition = "")
        {
            if ($condition != ""){
                $condition = "WHERE ".$condition;
            }

            $query = "SELECT $what from $tab_name $condition;";
            $ret = $this->query($query);
            $res_array = array();

            while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
                array_push($res_array, $row);
            }

            // print_r($res_array);
            return $res_array;
        }

        function execQuery($query)
        {
            $ret = $this->exec($query);
            $this->handleErrors($ret);
        }

        function insertRow($tab_name, $row_data)
        {
            $attribs = "";
            $values = "";

            foreach ( $row_data as $key => $value ) {
                $attribs = $attribs."$key,";
                $values  = $values."'".$value."',";
            }

            // Remove trimming ","
            $attribs = rtrim($attribs, ",");
            $values = rtrim($values, ",");
            $ret = $this->exec("INSERT INTO $tab_name ($attribs) VALUES($values);");
            $this->handleErrors($ret);
        }

        function insertRows($tab_name, $rows)
        {
            foreach ($rows as $value) {
                $this->insertRow($tab_name, $value);
            }
        }

        function createTable($tab_name, $attribs)
        {
            $attrib_str = "";

            foreach ( $attribs as $key => $value ) {
                $attrib_str = $attrib_str."$key $value,";
            }

            $attrib_str = rtrim($attrib_str, ",");
            $this->execQuery("CREATE TABLE IF NOT EXISTS $tab_name ($attrib_str);");
        }

        function handleErrors($ret){
            if(!$ret) { // error managment
                die($this->lastErrorMsg());
            }
        }
    }
?>

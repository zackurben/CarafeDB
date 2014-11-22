<?php
/**
 * This project is licensed under the terms of the MIT license,
 * you can read more in the LICENSE file.
 *
 * @file    lib/zackurben/Carafe/DB.php.
 * @version 0.0.0
 * @github  https://github.com/zackurben/CarafeDB
 * @author  Zack Urben
 * @contact zackurben@gmail.com
 */

namespace zackurben\Carafe;

use \Exception;

/**
 * The Carafe Database implementation.
 */
class DB
{
    /**
     * The name of the loaded file, as a string.
     *
     * @var string
     */
    protected $db;

    /**
     * Carafe Database object Initialization.
     *
     * Sets the database for this object, this will create the file if it is not
     * found.
     *
     * @param string $file
     *   String representation of the file name.
     */
    public function __construct($file)
    {
        if (is_file($file)) {
            $this->db = $file;
        } else {
            file_put_contents($file, '');
            $this->db = $file;
        }
    }

    /**
     * Read the Database file and return the results as an array.
     *
     * @param integer $results
     *   The number of rows to read.
     *
     * @return array
     *   The read results as an associative keyed array.
     */
    private function read($results = 0)
    {
        $results = intval($results);
        if ($results < 0) {
            throw new Exception(
                'Error: Invalid parameter received: read(' . $results
                . '); The given parameter must be a positive integer.'
            );
        } elseif ($results == 0) {
            // Manipulate the results variable to skip the break check.
            $results = -1;
        }

        $temp = file_get_contents($this->db);
        $temp = explode(PHP_EOL, $temp);
        // Remove the last `empty` newline element.
        array_pop($temp);

        $return = array();
        foreach ($temp as $row) {
            if ($results == 0) {
                break;
            }

            $return[] = json_decode($row, true);
            $results--;
        }

        return $return;
    }

    /**
     * Select data rows from the Database object.
     *
     * @param array $param
     *   The search terms in key => value order.
     *
     *   The key is the row name, and value is the search term.
     *   (Note: The wildcard character, %, may be used in the search term.)
     *
     * @return array $result_rows
     *   An array, with associative keys, of the resulting search.
     */
    public function select(array $param)
    {
        // Only continue with select if param list is valid.
        if (count($param) > 0) {
            // Confirm that each param exist as an array key.
            $valid = true;
            $simplex_row = $this->read(1);

            foreach ($param as $key => $val) {
                if (isset($simplex_row[0]) && !array_key_exists($key, $simplex_row[0])) {
                    // At-least one search key did not exist, throw an error.
                    $invalid_key = $key;
                    $valid = false;
                }
            }

            if ($valid) {
                // Read each row to determine our results.
                $all_rows = $this->read();
                $result_rows = array();
                foreach ($all_rows as $row) {
                    // By default each row is a result, until proven otherwise.
                    $result = true;
                    foreach ($param as $key => $val) {
                        if (($row[$key] != $val) && (stripos($val, "%") === false)) {
                            // Value is not found and wildcard is not present.
                            $result = false;
                            break;
                        } elseif (stripos($val, "%") !== false) {
                            // Further verification because wildcard is present.
                            $temp = str_replace("%", "", $val);
                            if (stripos($row[$key], $temp) === false) {
                                $result = false;
                                break;
                            }
                        }
                    }

                    // If the result is valid, add it to the result list.
                    if ($result) {
                        array_push($result_rows, $row);
                    }
                }
            } else {
                throw new Exception(
                    'Error: Invalid column name received: select('
                    . var_export($param, true) . '); The column '
                    . $invalid_key . ' was not found in the database: '
                    . $this->db . '.'
                );
            }
        } else {
            throw new Exception(
                'Error: Invalid parameter received: select('
                . var_export($results, true)
                . '); Must contain an array with at-least one element.'
            );
        }

        return $result_rows;
    }

    /**
     * Insert the given data row into the open Database object.
     *
     * @param array $row
     *   A new row of data to append to the Database object.
     *   (Note: The $row must match the existing rows in the DB.)
     */
    public function insert(array $row)
    {
        // Only continue with insert if param list is valid.
        if (count($row) > 0) {
            // Confirm that each param exist as an array key.
            $valid = true;
            $simplex_row = $this->read(1);

            foreach ($row as $key => $val) {
                if (isset($simplex_row[0]) && !array_key_exists($key, $simplex_row[0])) {
                    // At-least one search key did not exist, throw an error.
                    $invalid_key = $key;
                    $valid = false;
                }
            }

            if ($valid) {
                $temp = "";
                foreach ($row as $data) {
                    $temp .= json_encode($data) . PHP_EOL;
                }

                file_put_contents($this->db, $temp, FILE_APPEND | LOCK_EX);
            } else {
                throw new Exception(
                    'Error: Invalid column name received: insert('
                    . var_export($row, true) . '); The column '
                    . $invalid_key . ' was not found in the database: '
                    . $this->db . '.'
                );
            }
        } else {
            throw new Exception(
                'Error: Invalid parameter received: select('
                . var_export($results, true)
                . '); Must contain an array with at-least one element.'
            );
        }
    }
}

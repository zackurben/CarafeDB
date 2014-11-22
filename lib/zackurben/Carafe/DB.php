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
use zackurben\Carafe\Core;

/**
 * The Carafe Database implementation.
 */
class DB extends Core
{
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
        parent::__construct($file);
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
                . var_export($param, true)
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
                . var_export($row, true)
                . '); Must contain an array with at-least one element.'
            );
        }
    }
}

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

use zackurben\Carafe\Exception\InvalidColumnException;
use zackurben\Carafe\Exception\InvalidParameterException;

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
     *
     * @throws InvalidColumnException
     * @throws InvalidParameterException
     */
    public function select(array $param)
    {
        // Validate parameters type.
        if (!is_array($param)) {
            throw new InvalidParameterException(
                'DB#select()',
                gettype($param),
                'array'
            );
        }

        // Validate input data.
        $invalid_columns = $this->getInvalidColumns($param);
        if (empty($invalid_columns)) {
            throw new InvalidColumnException(
                'DB#select()',
                $invalid_columns
            );
        }

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

        return $result_rows;
    }

    /**
     * Insert the given data row into the open Database object.
     *
     * @param array $row
     *   A new row of data to append to the Database object.
     *   (Note: The $row must match the existing rows in the DB.)
     *
     * @throws InvalidColumnException
     * @throws InvalidParameterException
     */
    public function insert(array $row)
    {
        // Validate parameters type.
        if (!is_array($row)) {
            throw new InvalidParameterException(
                'DB#insert()',
                gettype($row),
                'array'
            );
        }

        // Validate input data.
        $invalid_columns = $this->getInvalidColumns($row);
        if (empty($invalid_columns)) {
            throw new InvalidColumnException(
                'DB#insert()',
                $invalid_columns
            );
        }

        $temp = "";
        foreach ($row as $data) {
            $temp .= json_encode($data) . PHP_EOL;
        }

        file_put_contents($this->db, $temp, FILE_APPEND | LOCK_EX);
    }

    /**
     * Remove all rows from the CarafeDB that matches the given row.
     *
     * @param array $row
     *   The row to delete.
     *
     * @throws InvalidColumnException
     * @throws InvalidParameterException
     */
    public function removeRow(array $row)
    {
        // Validate parameters type.
        if (!is_array($row)) {
            throw new InvalidParameterException(
                'DB#removeRow()',
                gettype($row),
                'array'
            );
        }

        // Validate input data.
        $invalid_columns = $this->getInvalidColumns($row);
        if (empty($invalid_columns)) {
            throw new InvalidColumnException(
                'DB#removeRow()',
                $invalid_columns
            );
        }

        // Read each row to determine our results.
        $all_rows = $this->read();
        foreach ($all_rows as $index => $value) {
            // Delete the current row if its diff is empty.
            if (empty(array_diff($row, $value))) {
                unset($all_rows[$index]);
            }
        }

        // Build new CarafeDB contents to store.
        $data = '';
        foreach ($all_rows as $index => $value) {
            $data .= json_encode($value) . PHP_EOL;
        }

        // Overwrite the current CarafeDB.
        file_put_contents($this->db, $data, LOCK_EX);
    }
}

<?php
/**
 * This project is licensed under the terms of the MIT license,
 * you can read more in the LICENSE file.
 *
 * @file    lib/zackurben/Carafe/Core.php.
 * @version 0.0.0
 * @github  https://github.com/zackurben/CarafeDB
 * @author  Zack Urben
 * @contact zackurben@gmail.com
 */

namespace zackurben\Carafe;

use \Exception;

class Core
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
    protected function read($results = 0)
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
}

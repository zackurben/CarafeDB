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
use zackurben\Carafe\Exception\InvalidParameterException;

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
     *
     * @throws InvalidParameterException
     */
    public function __construct($file)
    {
        // Input validation on parameters.
        if (!is_string($file)) {
            throw new InvalidParameterException(
                'DB#__construct($file)',
                'string',
                gettype($file)
            );
        }

        // Set the file path if it exists or create the file.
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
     *
     * @throws InvalidParameterException
     */
    protected function read($results = 0)
    {
        // Input validation on parameters.
        if (!is_integer($results) || ($results < 0)) {
            throw new InvalidParameterException(
                'DB#read($results)',
                'integer (positive)',
                gettype($results)
            );
        }

        if ($results == 0) {
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

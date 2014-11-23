<?php
/**
 * This project is licensed under the terms of the MIT license,
 * you can read more in the LICENSE file.
 *
 * @file    lib/zackurben/Carafe/Exception/InvalidColumnException.php.
 * @version 0.0.0
 * @github  https://github.com/zackurben/CarafeDB
 * @author  Zack Urben
 * @contact zackurben@gmail.com
 */

namespace zackurben\Carafe\Exception;

class InvalidColumnException extends \Exception
{
    /**
     * The function where this is thrown.
     *
     * @var string
     */
    protected $function;

    /**
     * The incorrect columns in the CarafeDB instance.
     *
     * @var array
     */
    protected $incorrect;

    /**
     * Create the error with a dynamic message.
     */
    public function __construct($function, $incorrect)
    {
        $this->function = $function;
        $this->incorrect = $incorrect;

        parent::__construct();
    }

    /**
     * Format the message string for this error.
     *
     * @return string
     */
    public function __toString()
    {
        return 'exception \'InvalidColumnException\' with message \''
            . $this->function . ' attempted to access the following columns,'
            . ' which are non-existent: .\'';
    }

    /**
     * Format the incorrect columns into a nice string format.
     *
     * @return string
     *   The formatted elements of the incorrect columns array.
     */
    protected function formatColumns()
    {
        $output = '[';
        foreach ($this->incorrect as $column) {
            $output .= $column . ', ';
        }

        // Remove last delimiter, and close the bracket.
        $output = substr($output, 0, -2);
        $output .= ']';

        return $output;
    }
}

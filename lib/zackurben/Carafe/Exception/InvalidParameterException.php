<?php
/**
 * This project is licensed under the terms of the MIT license,
 * you can read more in the LICENSE file.
 *
 * @file    lib/zackurben/Carafe/Exception/InvalidParameterException.php.
 * @version 0.0.0
 * @github  https://github.com/zackurben/CarafeDB
 * @author  Zack Urben
 * @contact zackurben@gmail.com
 */

namespace zackurben\Carafe\Exception;

class InvalidParameterException extends \Exception
{
    /**
     * The parameters expected data type.
     *
     * @var string
     */
    protected $expected;

    /**
     * The function where this is thrown.
     *
     * @var string
     */
    protected $function;

    /**
     * The parameters given data type.
     *
     * @var string
     */
    protected $given;


    /**
     * Create the error with a dynamic message.
     */
    public function __construct($function, $expected, $given)
    {
        $this->function = $function;
        $this->expected = $expected;
        $this->given = $given;

        parent::__construct();
    }

    /**
     * Format the message string for this error.
     *
     * @return string
     */
    public function __toString()
    {
//        return 'Expected ' . $this->expected . ' but got ' . $this->given . '.';
        return 'exception \'InvalidParameterException\' with message \''
        . $this->function . ' expected a parameter of type '
        . $this->expected . ' but got a parameter of type ' . $this->given
        . '.\'';
    }
}

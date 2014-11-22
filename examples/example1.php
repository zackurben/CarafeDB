<?php
/**
 * This project is licensed under the terms of the MIT license,
 * you can read more in the LICENSE file.
 *
 * @file    examples/example1.php.
 * @version 0.0.0
 * @github  https://github.com/zackurben/CarafeDB
 * @author  Zack Urben
 * @contact zackurben@gmail.com
 *
 * The purpose of this example is to demonstrate the functionality of a simple
 * data insert and selection from CarafeDB.
 */

include_once dirname(__DIR__) . '/vendor/autoload.php';

use zackurben\Carafe\DB;

// Create or load the example1 CarafeDB.
$test = new DB('examples/example1.cdb');

// Create some dummy data to work with.
$rows = array(
    array(
        'id' => 1,
        'date' => time(),
        'title' => 'Fusce at lectus at velit.',
        'post' =>
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
            . ' Suspendisse sem lectus, fermentum id ligula quis, vestibulum'
            . ' molestie neque. Vestibulum eget tellus dolor. In in risus vel'
            . ' nisi ultricies fringilla ut nec risus. Vivamus velit lectus, '
            . ' tincidunt in erat sed, tempus viverra arcu. Nullam quis arcu'
            . ' augue. Donec lorem dolor, luctus et interdum rutrum, semper'
            . ' quis arcu. Sed aliquam aliquet arcu. Phasellus vehicula nibh'
            . ' sit amet nibh scelerisque imperdiet. Maecenas dictum felis'
            . ' nisl, sed mollis nulla mattis et. Nulla suscipit aliquam'
            . ' bibendum. Mauris quis egestas lectus. Cras vel ligula vel magna'
            . ' condimentum malesuada nec nec nunc.'
    ),
    array(
        'id' => 2,
        'date' => time(),
        'title' => 'Sed gravida tincidunt ipsum ac.',
        'post' =>
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam'
            . ' vestibulum, arcu a blandit iaculis, neque erat accumsan magna,'
            . ' ut vulputate risus ante quis magna. Nullam non fringilla massa,'
            . ' id eleifend nibh. Sed gravida tincidunt est vel aliquet. Nulla'
            . ' consectetur dapibus libero sit amet molestie. Cras accumsan'
            . ' ultrices erat, ac mattis tortor euismod a. Curabitur'
            . ' sollicitudin enim rutrum orci malesuada, ac fringilla enim'
            . ' fermentum. Etiam in ipsum et sem fermentum fringilla nec eget'
            . ' nunc.'
    ),
);

// Select Row 1 if it exists or insert our dummy data.
$select = $test->select(array('id' => 1));
if ($select) {
    echo 'Row 1 exists' . PHP_EOL . print_r($select, true) . PHP_EOL;
} else {
    echo 'Insert our dummy data..' . PHP_EOL;
    $test->insert($rows);
}

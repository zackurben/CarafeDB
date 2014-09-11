<?php
include_once dirname(__DIR__) . '/vendor/autoload.php';

use zackurben\Carafe\DB;

$test = new DB('example1.db');

$row_1 = array(
    'date' => '1',
    'title' => 'Fusce at lectus at velit.',
    'post' =>
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse '
        . 'sem lectus, fermentum id ligula quis, vestibulum molestie neque. '
        . 'Vestibulum eget tellus dolor. In in risus vel nisi ultricies '
        . 'fringilla ut nec risus. Vivamus velit lectus, tincidunt in erat '
        . 'sed, tempus viverra arcu. Nullam quis arcu augue. Donec lorem '
        . 'dolor, luctus et interdum rutrum, semper quis arcu. Sed aliquam '
        . 'aliquet arcu. Phasellus vehicula nibh sit amet nibh scelerisque '
        . 'imperdiet. Maecenas dictum felis nisl, sed mollis nulla mattis et. '
        . 'Nulla suscipit aliquam bibendum. Mauris quis egestas lectus. Cras '
        . 'vel ligula vel magna condimentum malesuada nec nec nunc.'
);

// Insert some dummy data.
if ($test->select($row_1)) {
    echo "Row 1 exists\n";
} else {
    $test->insert(array($row_1));
}

//array_push($data, array("date" => "1393042827",
//    "title" => "Fusce at lectus at velit.",
//    "post" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sem lectus, fermentum id ligula quis, vestibulum molestie neque. Vestibulum eget tellus dolor. In in risus vel nisi ultricies fringilla ut nec risus. Vivamus velit lectus, tincidunt in erat sed, tempus viverra arcu. Nullam quis arcu augue. Donec lorem dolor, luctus et interdum rutrum, semper quis arcu. Sed aliquam aliquet arcu. Phasellus vehicula nibh sit amet nibh scelerisque imperdiet. Maecenas dictum felis nisl, sed mollis nulla mattis et. Nulla suscipit aliquam bibendum. Mauris quis egestas lectus. Cras vel ligula vel magna condimentum malesuada nec nec nunc."));
//array_push($data, array("date" => "1393042827",
//    "title" => "Sed gravida tincidunt ipsum ac.",
//    "post" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vestibulum, arcu a blandit iaculis, neque erat accumsan magna, ut vulputate risus ante quis magna. Nullam non fringilla massa, id eleifend nibh. Sed gravida tincidunt est vel aliquet. Nulla consectetur dapibus libero sit amet molestie. Cras accumsan ultrices erat, ac mattis tortor euismod a. Curabitur sollicitudin enim rutrum orci malesuada, ac fringilla enim fermentum. Etiam in ipsum et sem fermentum fringilla nec eget nunc."));
//array_push($data, array("date" => "1393042827",
//    "title" => "Fusce at pretium lorem. Curabitur.",
//    "post" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vitae enim purus. Suspendisse eget feugiat ante. Suspendisse non semper enim, sed sodales magna. Praesent mollis placerat odio, sit amet aliquam odio ullamcorper at. Fusce consectetur sit amet lorem sed semper. Quisque nec leo pellentesque, laoreet neque feugiat, commodo risus. Etiam sit amet velit vitae neque ultrices hendrerit in vitae nisl. Morbi lectus ante, ullamcorper id magna a, pellentesque venenatis nisl. Nunc mattis, lacus a auctor auctor, felis lacus scelerisque dui, et varius neque enim id odio. Proin porttitor ante quam, quis consectetur sapien pharetra sed."));
//array_push($data, array("date" => "1393042827",
//    "title" => "Sed vehicula nisl vel condimentum.",
//    "post" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas orci justo, faucibus ac vulputate non, auctor at urna. In nisl nisl, sagittis ut turpis quis, sollicitudin ullamcorper sem. Duis in pellentesque ante. Morbi rhoncus turpis dui, non pharetra nunc rutrum id. Integer facilisis interdum lacinia. Proin condimentum neque nibh, nec suscipit massa tincidunt in. Vestibulum sollicitudin eros dignissim malesuada blandit. Nulla at sapien eget erat bibendum accumsan. Vivamus libero orci, sagittis non magna sed, venenatis auctor nunc. Proin sed augue lectus. Integer sit amet orci convallis, auctor tortor et, tincidunt ipsum. Proin risus ipsum, rutrum nec mi ac, consequat feugiat felis. In vitae magna vel ipsum sodales ultricies ac sit amet elit. Maecenas eu neque sit amet lorem aliquet rutrum. Vivamus non neque hendrerit urna sollicitudin euismod a a leo. Nam faucibus arcu in odio tincidunt tristique."));
//array_push($data, array("date" => "1393042827",
//    "title" => "Interdum et malesuada fames ac.",
//    "post" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin feugiat varius libero, vel fringilla tortor placerat sit amet. Vestibulum varius dictum nibh, et mattis massa dapibus auctor. Duis consectetur eleifend sem, faucibus suscipit lacus ultricies nec. Quisque tincidunt, nisl at ullamcorper euismod, lorem risus adipiscing lacus, venenatis commodo quam quam in lectus. Donec vitae feugiat massa. Morbi vehicula tortor ac dui vestibulum, vitae suscipit justo laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum dapibus ante eget erat tempor, et tempor mauris imperdiet. Sed gravida nisl quis vestibulum dignissim. Proin mattis tempor felis ut euismod. Curabitur sit amet iaculis justo. Quisque in ornare leo. Integer elementum dapibus risus."));
//array_push($data, array("date" => "1393042827",
//    "title" => "Cras id ante porta, interdum.",
//    "post" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at purus vitae turpis pulvinar ornare. Nulla facilisi. Phasellus ac magna placerat, hendrerit tellus vel, rhoncus urna. Morbi elementum lectus lacus, eu tempor nulla vehicula quis. Vestibulum eget euismod magna, a adipiscing dui. Praesent placerat suscipit est, a cursus orci faucibus id. Mauris tortor leo, commodo et libero eget, lacinia faucibus nunc. Curabitur non est vestibulum, sodales purus ac, ultrices tellus."));


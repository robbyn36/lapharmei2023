<?php
include "data_mentah.php";

// Task 1: Detect the date format
preg_match('/\d{2}\/\d{2}\/\d{2}/', $text, $matches);
$date_format = 'd/m/y'; // Assuming the date format is always dd/mm/yy
if (!empty($matches)) {
    $date_format = 'm/d/y'; // Change the date format if necessary
}

// Task 2: Split the text by the date
$messages = preg_split('/\d{2}\/\d{2}\/\d{2} \d{2}\.\d{2} - /', $text, -1, PREG_SPLIT_NO_EMPTY);

// Task 3: Remove new lines from the text
$messages = str_replace("\n", ' ', $messages);

// Task 4: Show only the text that has ": GIAT"
$filtered_messages = array_filter($messages, function ($message) {
    return strpos($message, ': GIAT') !== false;
});

// Task 5: Split the text by ": GIAT"
$result = [];
foreach ($filtered_messages as $message) {
    $split_message = explode(': GIAT', $message);
    $result[] = trim($split_message[1]); // Extract the text after ": GIAT"
}

// Output the result
foreach ($result as $item) {
    echo 'GIAT ' . $item . ";<br>";
}
?>

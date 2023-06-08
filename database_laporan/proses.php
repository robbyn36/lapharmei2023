<!DOCTYPE html>
<html>
<head>
    <title>GIAT Form</title>
</head>
<body>
    <h2>GIAT Form</h2>
    <form method="post" action="">
        <textarea name="text" rows="5" cols="40" placeholder="Enter the text here"></textarea>
        <br>
        <input type="submit" value="Process">
    </form>
    <br>

    <?php<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'];

    $lines = explode("\n", $text);
    $giatArray = [];

    foreach ($lines as $line) {
        if (strpos($line, ": GIAT") !== false) {
            $parts = explode(": ", $line, 2);
            $date = $parts[0];
            $dateTime = DateTime::createFromFormat('d/m/y H.i', $date);

            if ($dateTime !== false) {
                $date = $dateTime->format('Y-m-d');
                $giatText = $parts[1];

                $words = explode(" ", $giatText);
                $jenis = $words[0] . " " . $words[1];

                $giatArray[] = [
                    "date" => $date,
                    "text" => $giatText,
                    "jenis" => $jenis
                ];
            } else {
                echo "Invalid date format: $date";
            }
        }
    }

    // Display the resulting array
    echo "<h3>Result:</h3>";
    if (!empty($giatArray)) {
        echo "<pre>";
        print_r($giatArray);
        echo "</pre>";
    } else {
        echo "No GIAT entries found.";
    }
}
?>

    ?>
</body>
</html>

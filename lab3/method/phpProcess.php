<?php
    $desiredDate = isset($_POST['date']) ? ($_POST['date']) : 0;

    if (($desiredDate <= 0) || (strlen($desiredDate) != 10)){
        echo "<p>Please enter a valid date.</p>";
    } else {
        echo "<h2>Your Date:</h2>";
        echo getNextDeliveryDate($desiredDate);
        ;
    }

    function getNextDeliveryDate($desiredDate)
    {
        $holidays = file('holidays.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        //foreach ($holidays as $holiday) {
        //    echo $holiday . "\n";
        //}

        $desiredDate = DateTime::createFromFormat('d.m.Y', $desiredDate);
        $today = new DateTime();
        $deliveryDate = clone $desiredDate;
        $deliveryDate->setTime(12, 0, 0);
        if($desiredDate->format('Y') < $today->format('Y')) {return ("<p>Please enter a valid date.</p>");}
        if($desiredDate->format('m') > 12) {return ("<p>Please enter a valid date.</p>");}
        if ($today < $deliveryDate) {
            $deliveryDate = $deliveryDate->modify('+1 day');
        } else {
            $deliveryDate = $deliveryDate->modify('+2 day');
        }
        while (in_array($deliveryDate->format('m-d-Y'), $holidays) || $deliveryDate->format('N') >= 6) {
            $deliveryDate = $deliveryDate->modify('+1 day');
        }
        return $deliveryDate->format('d F Y');
    }

    //$desiredDate = '22.03.2023';
//echo getNextDeliveryDate($desiredDate);
    ?>
<?php
$data = array(
    array(
        array(
            array(
                array("apelsin", 10, 20),
                array("тюльпаны", "sus", 25),
                array("орхидеи", 180, 7)
            ),
            array(
                array("apelsin", "apelsin", "apelsin"),
                array("apelsin", "apelsin", "apelsin"),
                array("bakhlazhan", 110, 3)
            )
        ),
        array(
            array(
                array("samie", 10.9999, 15),
                array("luchie", 6.11111, "samie"),
                array("орхидеи", 18.21312, 7)
            ),
            array(
                array("unas", 20.123123, 5),
                array("vsegda", 3.999, 5),
                array("vmagazine", 11.2, "mandarin")
            )
        )
    )
);

function removeDuplicates($data) {
    $result = array_map("unserialize", array_unique(array_map("serialize", $data)));

    foreach ($result as $key => $value) {
        // if (is_array($value)) {
        //     $result[$key] = removeDuplicates($value);
        // }
        $result[$key] = removeDuplicates($value);
    }
    return $result;
}

print_r(removeDuplicates($data));
?>
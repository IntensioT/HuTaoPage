<?php

require_once 'OrderTableBuilder.php';

function check_post_parameters(){
    return isset($_POST['pizzaType']) and
        isset($_POST['pizzaSize']) and
        isset($_POST['email']) and
        isset($_POST['name']);
}

function getOrderPrice($prices, $pizza_size, $pizza_type, $add_ingredients){
    $price = $prices[$pizza_type][$pizza_size];

    foreach($add_ingredients as $add_ingredient){
        if(isset($_POST[$add_ingredient]) and $_POST[$add_ingredient] === $add_ingredient){
            $price += $prices[$add_ingredient];
        }
    }

    return $price;
}

function get_mail_content($pizza_type, $pizza_size, $order_table, $order_price, $name){
    $mail_content = file_get_contents('mail.html');
    
    $mail_content = str_replace('{PIZZA_TYPE}', $pizza_type, $mail_content);
    $mail_content = str_replace('{PIZZA_SIZE}', $pizza_size, $mail_content);
    $mail_content = str_replace('{ORDER_TABLE}', $order_table, $mail_content);
    $mail_content = str_replace('{ORDER_PRICE}', $order_price, $mail_content);
    $mail_content = str_replace('{NAME}', $name, $mail_content);

    return $mail_content;
}

function sendOrderInfo($to, $mail_content){
    $headers  = 'From: ' . 'sussusov45@mail.ru' . "\r\n" .
                'MIME-Version: 1.0' . "\r\n" .
                'Content-type: text/html; charset=utf-8';

    return mail($to, "Your order", $mail_content, $headers);
}

function makeOrder(){
    if(!check_post_parameters()){
        return false;
    }
    
    $add_ingredients = ['tomato', 'cheese', 'cucumber'];
    $pizza_type = $_POST['pizzaType'];
    $pizza_size = $_POST['pizzaSize'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $prices = [
        'pepperoni' => [
            'small'=> 2,
            'standart'=> 5,
            'big' => 7
        ],
        'margherita' => [
            'small' => 2,
            'standart' => 4,
            'big' => 6
        ],
        'california' => [
            'small' => 10,
            'standart' => 15,
            'big' => 20
        ],

        'tomato' => 1,
        'cheese' => 2,
        'cucumber' => 3
    ];

    $orderTableBuilder = new OrderTableBuilder();
    $orderTableBuilder->addRow($pizza_type . ', ' . $pizza_size, $prices[$pizza_type][$pizza_size]);
    $orderTableBuilder->addAdditionalIngredients($add_ingredients, $prices);

    $order_table = $orderTableBuilder->getTable();
    $order_price = getOrderPrice($prices, $pizza_size, $pizza_type, $add_ingredients);

    $mail_content = get_mail_content($pizza_type, $pizza_size, $order_table, $order_price, $name);
    return sendOrderInfo($email, $mail_content);
}

function test(){
    // echo <<<END
    // <!DOCTYPE html>
    // <html>
    //     <head>
    //         <meta charset="utf-8">
    //         <title>Test</title>
    //     </head>
    //     <body>  
    // END;

    $_POST['pizzaType'] = 'california';
    $_POST['pizzaSize'] = 'standart';
    
    $_POST['tomato'] = 'tomato';
    $_POST['cheese'] = 'cheese';
    $_POST['cucumber'] = 'cucumber';

    $_POST['name'] = 'Sus';
    $_POST['email'] = 'sussusov45@mail.ru';

    // echo makeOrder();

    // echo <<<END
    //     </body>
    // </html>
    // END;

    var_dump(makeOrder());
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='style.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tinos:wght@400;700&display=swap" rel="stylesheet">
    <title>Сайт</title>
</head>
<body>

<div class='header-main'>
    <div class='container'>

        <?php include '/var/www/html/Web/header.php'; ?>

        <div class='header-down'>

            <div class='header-title'>
                Приветсвую вас на

                <div class='header-subtitle'>
                    персональном сайте
                </div>

                <div class='header-suptitle'>
                     С ИДИОТСКИМ НАЗВАНИЕМ 
                </div>

                <div class='header-bth'>
                    <a href='#galeryId' class='header-button'>ОТКРЫТЬ ГАЛЕРЕЮ</a>
                </div>

            </div>
        </div>
    </div>

</div>


<div class='cards'>

    <div class='container'>

       <div class='cards-holder'>

            <div class='card'>

                <div class='card-image'>
                    <img class='card-img' width="150" height="150" src='assets/card.png'>
                </div>

                <div class='card-title'>
                    Загадочная  <span>Личность</span>
                </div>

                <div class='card-desc'>
                    Лучшая <br> <br><br><br><br><br>
                </div>

            </div>

            <div class='card'>

                <div class='card-image'>
                    <img class='card-img' width="150" height="150" src='assets/card.png'>
                </div>

                <div class='card-title'>
                    Лучшие  <span>Анимации</span>
                </div>

                <div class='card-desc'>
                    Просто лучшая <br> <br><br><br><br><br>

                </div>

            </div>

            <div class='card'>

                <div class='card-image'>
                    <img class='card-img' width="150" height="150" src='assets/card.png'>
                </div>

                <div class='card-title'>
                   Идеальная  <span>Хозяюшка</span>
                </div>

                <div class='card-desc'>
                    Самая лучшая <br> <br><br><br><br><br>
                </div>

            </div>
        </div>
    </div>

</div>

<div class='history'>

    <div class='container'>

        <div class='history-holder'>
            <div class='history-info'>
                <div class='history-title'>
                    Её <span>История</span>
                </div>

                <div class='history-desc'>
                    Ху Тао — хозяйка ритуального бюро «Ваншэн» в семьдесят седьмом поколении. Важная фигура в похоронном деле Ли Юэ.Изо всех сил она устраивает лучшие похороны для людей и оберегает границу между жизнью и смертью.А ещё она чудесный стихоплёт, чьи «шедевры» из уст в уста бродят по Ли Юэ.
                </div>

            </div>

            <div class='history-images'>
                <img class='imgages-1' width="300" height="370" src="assets/1.jpg" alt="">
                <img class='imgages-2' width="300" height="420" src="assets/2.png" alt="">
        </div>
        </div>

    </div>

</div>

<div class='black-block'>

    <div class='container'>

        <div class='block-holder'>
            <div class='left'>
                <div class='left-title'>
                    Кто же может быть <br> полезен для нее ?<br>
                </div>

            </div>

            <div class='right'>
                <div class='right-button'>
                    <a href="heroes.php" class='right-btn'>ПЕРСОНАЖИ</a>
                </div>
            </div>
        </div>

    </div>

</div>

<div class='galery' id="galeryId">

    <div class='container'>

        <div class='galery-title'>
            Галерея <span>Hu Tao</span>
        </div>


        <div class='galery-content'>

            <div class='galery-left'>

                <div class='galery-up'>
                    <img class='img-gal high' width="540" height="275" src="assets/gallery1.jpg">
                </div>

                <div class='galery-down'>
                    <img class='img-gal' width="255" height="275" src="assets/gallery2.jpg">
                    <img class='img-gal' width="255" height="275" src="assets/gallery3.jpg">
                </div>

            </div>

            <div class='galery-right'>

                 <div class='galery-up'>
                    <img class='img-gal' width="255" height="275" src="assets/gallery4.jpg">
                    <img class='img-gal' width="255" height="275" src="assets/gallery5.jpg">
                </div>

                <div class='galery-down'>
                    <img class='img-gal high' width="540" height="275" src="assets/gallery6.jpg">
                </div>

            </div>

        </div>


    </div>

</div>

<?php include '/var/www/html/Web/footer.php'; ?>



<script src='app.js'></script>

</body>
</html>

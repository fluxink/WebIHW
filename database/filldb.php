<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($conn, 'utf8');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL DEFAULT 'user',
        `first_name` varchar(255),
        `last_name` varchar(255),
        `address` varchar(255),
        `city` varchar(255),
        `zip` varchar(255),
        `phone` varchar(255),
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

        CREATE TABLE IF NOT EXISTS `categories` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

        CREATE TABLE IF NOT EXISTS `items` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `price` decimal(10,2) NOT NULL,
        `category_id` int(11) NOT NULL,
        `image` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

        INSERT INTO `users` (`email`, `password`, `role`) VALUES
        ('admin@gmail.com', '$2y$10\$whViDQ/7ueISw5YLvgqbP.dFWsghApmH2CTwokCp182UrTtAdwbBm', 'admin') ON DUPLICATE KEY UPDATE password=password;
        ";

if (mysqli_multi_query($conn, $sql)) {
    echo "All tables successfully created <br>";
} else {
    echo "Error creating tables: " . mysqli_error($conn) . "<br>";
}

$sql = "INSERT INTO `categories` (`name`) VALUES
    ('Спальня'),
    ('Вітальня'),
    ('Кухня'),
    ('Ванна кімната'),
    ('Дитяча кімната'),
    ('Офіс'),
    ('Інше');";

// Free up any pending result sets
while (mysqli_more_results($conn)) {
    mysqli_next_result($conn);
}

if (mysqli_query($conn, $sql)) {
    echo "Table categories filled successfully <br>";
} else {
    echo "Error filling table: " . mysqli_error($conn) . "<br>";
}

$sql = "INSERT INTO `items` (`name`, `description`, `price`, `category_id`, `image`) VALUES
    ('Диван \"Барселона\"', 'Модерністський дизайн зі шкіряними подушками', 1500.00, 2, '/assets/images/sofa2.png'),
    ('Крісло \"Егг\"', 'Поєднання комфорту та стилю з натуральними матеріалами', 800.00, 2, '/assets/images/крісло1.png'),
    ('Стіл \"Арко\"', 'Мінімалістичний дизайн з міцною дерев\'яною стільницею', 500.00, 2, '/assets/images/комп-стіл1.png'),
    ('Комод \"Бруклін\"', 'Виконаний зі скандинавським мінімалістичним стилем', 700.00, 1, '/assets/images/комод3.png'),
    ('Ліжко \"Бельведер\"', 'Елегантне ліжко з м\'якими подушками та дерев\'яними деталями', 1200.00, 1, '/assets/images/ліжко1.png'),
    ('Книжкова шафа \"Метрополіс\"', 'Сучасний стиль з міцними дерев\'яними полицями', 900.00, 2, '/assets/images/стелаж.png'),
    ('Стілець \"Діамант\"', 'Унікальний дизайн стільця з акриловими деталями', 200.00, 6, '/assets/images/офіснекрісло5.png'),
    ('Кухонний стіл \"Тоскана\"', 'Класичний стиль з міцними дерев\'яними ніжками', 800.00, 3, '/assets/images/кухонна стільниця1.png'),
    ('Коврик \"Венеція\"', 'Високоякісний коврик з ручним виготовленням', 300.00, 2, '/assets/images/rug.png'),
    ('Стійка для телевізора \"Беста\"', 'Сучасний дизайн зі скляними дверима та дерев\'яними полицями', 600.00, 2, '/assets/images/tvbench.png'),
    ('Комп\'ютерний стіл \"Еволюція\"', 'Модерністський дизайн з міцною стільницею', 400.00, 6, '/assets/images/computerdesk.png'),
    ('Крісло \"Пірс\"', 'Класичний дизайн з м\'якими подушками', 700.00, 2, '/assets/images/крісло2.png'),
    ('Стіл \"Версаль\"', 'Елегантний стиль', 550.00, 3, '/assets/images/обідній-стіл3.png'),
    ('Комод \"Тімберленд\"', 'Стильний дизайн з міцними дерев\'яними деталями та багато місця для зберігання', 750.00, 1, '/assets/images/комод4.png'),
    ('Крісло \"Повага\"', 'Класичний дизайн', 6000.00, 6, '/assets/images/офіснекрісло2.png'),
    ('Книжкова полиця \"Класик\"', 'Сучасний дизайн', 3850.00, 6, '/assets/images/стелаж2.png'),
    ('Кухонна тумба \"Орландо\"', 'Сучасний стиль', 950.00, 3, '/assets/images/кухонна стільниця2.png'),
    ('Софа', 'Теплий обійм дивану', 4300.00, 2, '/assets/images/sofa.png'),
    ('Диван', 'Модерністська мрія', 7100.00, 2, '/assets/images/диван1.png'),
    ('Диван', 'Зручність і краса', 6500.00, 2, '/assets/images/диван2.png'),
    ('Диван', 'Елегантний диван у теплих тонах', 5500.00, 2, '/assets/images/диван3.png'),
    ('Диван', 'М\'яка гойдалка для душі', 6000.00, 2, '/assets/images/диван4.png'),
    ('Дитяче ліжко', 'Мрії найменших', 1500.00, 5, '/assets/images/дитяче-ліжко.png'),
    ('Дитяче ліжко', 'Казковий світ для малюка', 1200.00, 5, '/assets/images/дитяче-ліжко1.png'),
    ('Дитяче ліжко', 'Затишок для сну', 1000.00, 5, '/assets/images/дитяче-ліжко2.png'),
    ('Комод', 'Графічний мінімалізм', 800.00, 1, '/assets/images/комод1.png'),
    ('Комод', 'Елегантний комод', 900.00, 1, '/assets/images/комод2.png'),
    ('Крісло', 'Комфорт у кожну мить', 3700.00, 2, '/assets/images/крісло1.png'),
    ('Крісло', 'Сучасний стиль у кріслі', 4300.00, 1, '/assets/images/крісло3.png'),
    ('Крісло', 'Абстрактна форма у кріслі', 4000.00, 2, '/assets/images/крісло4.png'),
    ('Крісло', 'Тепла овальна обіймка', 4500.00, 1, '/assets/images/крісло5.png'),
    ('Кухонна стільниця', 'Дизайн в кожній кулінарній миті', 1000.00, 3, '/assets/images/кухонна стільниця3.png'),
    ('Кухонний кран та мийка', 'Функціональність в стильному дизайні', 500.00, 3, '/assets/images/кухонний кран та мийка1.png'),
    ('Кухонний кран та мийка', 'Гладенька поверхня та мінімалістичний дизайн', 600.00, 3, '/assets/images/кухонний кран та мийка2.png'),
    ('Кухонний кран', 'Форма в гармонії з функціональністю', 800.00, 3, '/assets/images/кухонний кран та мийка3.png'),
    ('Кухонний кран та мийка', 'Мінімалістичний та стильний комплект', 1800.00, 3, '/assets/images/кухонний кран та мийка4.png'),
    ('Лампа', 'Стильне освітлення у теплих тонах', 450.00, 7, '/assets/images/лампа1.png'),
    ('Лампа', 'Елегантна форма та м\'який світлообіг', 550.00, 7, '/assets/images/лампа2.png'),
    ('Лампа', 'Сучасний дизайн у деталях', 430.00, 7, '/assets/images/лампа3.png'),
    ('Лампа', 'Функціональна лампа з теплим світлом', 410.00, 7, '/assets/images/лампа4.png'),
    ('Ліжко', 'Комфорт та дизайн у ліжку', 9000.00, 1, '/assets/images/ліжко2.png'),
    ('Ліжко', 'М\'яке ліжко для ночівлі у стилі', 9000.00, 1, '/assets/images/ліжко3.png'),
    ('Ліжко', 'Мінімалістичний дизайн та м\'які форми', 9000.00, 1, '/assets/images/ліжко4.png'),
    ('Обідній стіл', 'Дизайн в кожній страві', 5000.00, 3, '/assets/images/обідній-стіл2.png'),
    ('Обідній стіл', 'Сучасний дизайн у кожній деталі', 4000.00, 3, '/assets/images/обідній-стлі1.png'),
    ('Офісне крісло', 'Комфорт у кожній робочій миті', 3000.00, 6, '/assets/images/офіснекрісло1.png'),
    ('Офісне крісло', 'Сучасний дизайн у кожній деталі', 3500.00, 6, '/assets/images/офіснекрісло3.png'),
    ('Офісне крісло', 'Комфорт та функціональність', 4000.00, 6, '/assets/images/офіснекрісло4.png'),
    ('Офісний стіл', 'Сучасний дизайн у кожній деталі', 5000.00, 6, '/assets/images/офіснийстіл1.png'),
    ('Стелаж', 'Функціональність та дизайн', 2000.00, 6, '/assets/images/стелаж.png'),
    ('Стелаж', 'Сучасний дизайн у кожній деталі', 2500.00, 6, '/assets/images/стелаж3.png'),
    ('Стелаж', 'Мінімалістичний дизайн у кожній деталі', 3000.00, 2, '/assets/images/стелаж4.png'),
    ('Стелаж', 'Функціональність та дизайн', 3500.00, 2, '/assets/images/стелаж5.png'),
    ('Шафа', 'Сучасний дизайн у кожній деталі', 5000.00, 1, '/assets/images/шафа1.png'),
    ('Шафа', 'Функціональність та дизайн', 6000.00, 1, '/assets/images/шафа2.png');"
;

if (mysqli_query($conn, $sql)) {
    echo "Table itmes filled successfully <br>";
} else {
    echo "Error filling table: " . mysqli_error($conn) . "<br>";
}
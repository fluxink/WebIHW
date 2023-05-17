<?php

// Database connection
define('DB_HOST', isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'db');
define('DB_USER', isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : 'root');
define('DB_PASS', isset($_ENV['DB_PASS']) ? $_ENV['DB_PASS'] : 'root');
define('DB_NAME', isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : 'database');

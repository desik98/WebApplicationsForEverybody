<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=autos', 'jaiwanth', 'jaiwanth_1');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<?php

define('ROOT', dirname(__FILE__));

require ROOT . '/phpmailer/Mailer.php';
require ROOT . '/db/db.php';

$db = $db->getConnection();

$sql = "SELECT u.id, u.email, up.sub_category, p.id post_id, p.created_at, p.post_title FROM users u LEFT JOIN user_preferences up ON u.id = up.user_id LEFT JOIN posts p ON up.sub_category = p.post_category WHERE p.created_at BETWEEN :date_min AND :date_max";

$result = $db->prepare($sql);

$date = date('Y-m-d', time() - 60 * 60 * 24);

$dateMin = "$date 00:00:00";
$dateMax = "$date 23:59:59";

$result->bindParam(':date_min', $dateMin, PDO::PARAM_STR);
$result->bindParam(':date_max', $dateMax, PDO::PARAM_STR);
$result->execute();

$users = $result->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    //Mailer::sendSpam($user['email'], $user['post_id'], $user['post_title']);
}

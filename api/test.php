<?php
error_reporting(E_ALL);
include ('../admin/application/Mailer.class.php');
$subject = "Skill Champs-New ";
$message = "test";
$emailfrom = "admin@skillchamps.in";
$fromname = "Skill Champs";
$to = "siddharthitpro@gmail.com,admin@skillchamps.in";
$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
$mailer = new Mailer;
$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");
?>
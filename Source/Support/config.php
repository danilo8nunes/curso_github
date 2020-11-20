<?php

/**
 * DATABASE
 */
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "contact");

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", __DIR__ . "/../../");
define("CONF_URL_HTML", "/www/php-orientado-a-objetos/final/");
define("CONF_URL_ADMIN", CONF_URL_BASE . "/admin");
define("CONF_URL_ERROR", CONF_URL_BASE . "/404");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * SESSION
 */
define("CONF_SES_PATH", __DIR__ . "/../../storage/sessions/");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * MESSAGE
 */
define("CONF_MESSAGE_CLASS", "alert");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_DANGER", "danger");

define("CONF_MESSAGE_TITLE_INFO", "Observe!");
define("CONF_MESSAGE_TITLE_SUCCESS", "Muito Bem!");
define("CONF_MESSAGE_TITLE_WARNING", "Atenção!");
define("CONF_MESSAGE_TITLE_DANGER", "Algo deu errado");


/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.sendgrid.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USERNAME", "apikey");
define("CONF_MAIL_PASS", "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");
define("CONF_MAIL_SENDER", ["name" => "Danilo", "address" => "danilo8nunes@gmail.com"]);
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../assets/views");
define("CONF_VIEW_EXT", "php");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "../storage/uploads");
define("CONF_UPLOAD_IMAGE_DIR", "image");
define("CONF_UPLOAD_FILE_DIR", "file");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

<?php
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

define('_PROJECT_ROOT_', dirname(__DIR__, 2));
require _PROJECT_ROOT_ . '/vendor/autoload.php';

//.env
$dotenv = Dotenv::createImmutable(_PROJECT_ROOT_);
$dotenv->load();
if(!isset($_ENV['PROJECT_NAME'])) die('ENV NÃO CARREGADO!');

//Todo : Guilherme Reis: Good luck, start here! | ¡Buena suerte, empieza aquí! | Bonne chance, commencez ici! | Viel Glück, fangen Sie hier an! | Buona fortuna, inizia da qui! | Boa sorte, comece por aqui! | Удачи, начните здесь! | 好運，從這裡開始！ | ここから始めて、幸運を! | 행운을 빕니다, 여기에서 시작하세요! | Lykke til, start her! | Onnea, aloita tästä! | Καλή τύχη, ξεκινήστε εδώ! | Veel succes, begin hier! | Held og lykke, start her! | Powodzenia, zaczynaj tutaj! | Bol şans, buradan başla! | Srećno, počnite ovdje! | Удачи, почніть тут! | الحظ السعيد، ابدأ من هنا!

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("HW ".$_ENV['PROJECT_NAME']);
    return $response;
});

$app->run();

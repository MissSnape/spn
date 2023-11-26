
<?
$token = '6079733606:AAEIj4P1QzFDDuc30DzshCSAQg2Wk95_pLM'; // Токен который мы получили при регистрации бота
$chat_id = '-600636604';

// Массив с данными полученными из формы обратной связи
$arr = [
	"Имя клиента: " => trim(strip_tags($_POST['user_name'])),
	"Телефон клиента: " => trim(strip_tags($_POST['user_phone'])),
	"Email клиента: " => trim(strip_tags($_POST['user_email'])),
];

// Создаем строку со всеми данными от клиента для передачи API Telegram
foreach ($arr as $key => $value) {
	$txt .= "<br>" . $key . "<br>" . $value . "%0A";
}

$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}";
$proxy = "67.154.111.452:3128";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

// url на который осуществляется отправка
// тестового запроса работает через https
// поэтому нужно добавить флаги для работы с ssl
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// Подключение к прокси серверу
curl_setopt($ch, CURLOPT_PROXY, $proxy);

// если требуется авторизация
// curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);

// отправка запроса
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
?>
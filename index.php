<?php 
header('Content-type: application/json');

require("php/rb-mysql.php");
R::setup('mysql:host=localhost;dbname=prodbd','php_server', 'php_server');
if (!R::testConnection()) {
		echo "Не удалось подключиться к БД";
		exit;
	}
else {
	echo "Подключение к БД успешно \n";
}

function dbcreatefield( $post ) {
    $book = R::dispense( "prod" );
    $book->product = $post["product"];
    $book->barcode = $post["barcode"];
    $book->releaseDate = $post["releaseDate"];
    $book->issued = $post["issued"];
    $book->person_id = $post["person"]["id"];
    $book->person_name = $post["person"]["name"];
    $book->person_phone = $post["person"]["info"]["mobile"];
    $book->person_passport = $post["person"]["info"]["passport"];
    $book->person_card = $post["person"]["info"]["card"];
    $book->person_email = $post["person"]["email"];
    $book->person_dateOfBirth = $post["person"]["dateOfBirth"];
    $book->person_registered = $post["person"]["registered"];
    
    $id = R::store( $book );
}
if ($_GET['work'] > 0)
if ( isset( $_POST ) ) {
    $json = file_get_contents('php://input');
    $msg = json_decode($json, true);
    require( "php/rb-mysql.php" );
    R::setup( 'mysql:host=localhost;dbname=Role-play', 'php', '157855' );
    if (!R::testConnection()) {
		echo "<br/>Не удалось подключиться к БД";
		exit;
	}
    $msg = json_decode($json, true);
    dbcreatefield( $msg );
}
if ($_GET['demo'] == 1) {
    $json = file_get_contents('./test.json', true);
    $msg = json_decode($json, true);
    echo var_dump($msg);
}
if ($_GET['demo'] == 3) {
    $json = file_get_contents('./test.json', true);
    $msg = json_decode($json, true);
    dbcreatefield( $msg );
}

if ($_GET['demo'] == 2) {
    $prod = R::load( 'prod', 1 );
    R::close();
    echo var_dump($prod);
    echo "\n \n";
    echo json_encode( $prod );
}
?>
<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    //session
    session_start();

    //require the autoload file
    require_once ('vendor/autoload.php');

    //create an instance of the base class
    $f3 = Base::instance();

    //set debug level
    //0 = no error reporting, 3 = report all errors
    $f3->set('DEBUG', 3);

    //Define a default route
    $f3->route('GET /', function() {
        echo "<h1>My Pets</h1>";
        echo "<a href='./order'>Order a Pet</a>";
    });

    $f3->route('GET /order', function() {
        $template = new Template();
        echo $template->render('views/form1.html');
    });

    $f3->route('POST /order2', function() {
        $_SESSION['animal'] = $_POST['animal'];

        $template = new Template();
        echo $template->render('views/form2.html');
    });

    $f3->route('POST /results', function($f3) {
        $_SESSION['color'] = $_POST['color'];

        $f3->set('animal', $_SESSION['animal']);
        $f3->set('color', $_SESSION['color']);

        $template = new Template();
        echo $template->render('views/results.html');
    });

    //Run Fat-Free
    $f3->run();
?>
<?php
    session_start();

    if (!isset($_SESSION['user_logged_in'])){
        header('Location: login');
        exit();
    }

    require '../components/header.php';
    require '../components/db.php';
    include '../components/navbar.php';
?>

 <div class="container w-75 my-5">
            <div class="card my-3">
                <div class="card-body">
                <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                </div>
            </div>
        </div>
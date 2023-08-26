<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_SESSION['isLogedIn'])) {
    $cred = $_SESSION['isLogedIn'];
  } else {
    echo 'failed';
  }
}


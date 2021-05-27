<?php
session_start();

session_destroy();
header("Location: ejercicio3.php");

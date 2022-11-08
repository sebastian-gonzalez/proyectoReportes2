<?php

session_start();
session_destroy();
header("location: /Proyecto/login.php");

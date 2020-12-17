<?php

session_start();
session_destroy();
header("location: /Proyectico_v2/login.php");

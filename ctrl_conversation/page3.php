<?php
session_start();

echo 'Now is' . $_SESSION['session_var'] . '</br>';

session_destroy();

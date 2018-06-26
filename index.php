<?php
session_start();

include 'header.php';

include 'functions/router.php';
include 'functions/functions.php';

include 'Database.php';

route();

include 'footer.php';
<?php

function verifySlack()
{
    if (isset($_POST['challenge'])) {
        echo $_POST['challenge'];
        die();
    }
}

verifySlack();

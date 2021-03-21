<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Buy Your Way to a Better Education!</title>
    <link href="./webpage/buyagrade.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
    if($_SERVER["REQUEST_METHOD"] != 'POST'){
?>
    <h2>This page is rendering only <i>POST</i> methods </h2>
<?php } else if($_REQUEST['name'] == "" || $_REQUEST['section'] == "" || $_REQUEST['credit_card_number'] == "" || $_REQUEST['card_type'] == "") { ?>
        <h2> SORRY :( </h2>
        <h4>You didn't fill out the form completely! <a href="index.php">Try again?</a></h4>
<?php } else { ?>

        <?php
        $card_number = 0;
        for ($i = 0; $i < 16; $i++){
            if ($i % 4 == 0 && $i != 0){
                $card_number .= "-";
            }
            $card_number .= $_REQUEST['credit_card_number'][$i];
        }?>

<h1>Thanks, sucker!</h1>
<p>Your information has been recorded.</p>

<dl>
    <dt>NAME:</dt>
    <dd><?= $_REQUEST['name'] ?></dd>

    <dt>SECTION:</dt>
    <dd><?= $_REQUEST['section'] ?></dd>

    <dt>CREDIT CARD:</dt>
    <dd>
        <?= $card_number ?>
        (<?= $_REQUEST['card_type'] ?>)
    </dd>
</dl>
        <!-- Writing to the file -->
        <?php
        $file = "./suckers.txt";
        $sucker =   $_REQUEST['name'] . "; "
            . $_REQUEST['section'] . "; "
            . $card_number
            . " (" . $_REQUEST['card_type'] . ")\n";
        file_put_contents($file, $sucker, FILE_APPEND);
        ?>
        <!-- Reading the file -->
        <p>Here all the suckers who have submitted! Shame on you guys =)</p>
        <?php
        echo nl2br( file_get_contents($file) );
        ?>
<?php } ?>

</body>
</html>  
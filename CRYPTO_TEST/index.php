<?php
require_once 'cryptography.php';
?>

<!DOCTYPE html>
<html lang="fr-fr">
    <head>
        <meta charset="UTF-8">
        <title>Cryptographie appliquée</title>
        <style>
            * {
                font-family: Arial, sans-serif;
            }

            .binary {
                font-family: monospace;
            }

            p {
                word-wrap: break-word;
            }
        </style>
    </head>
    <body>
        <h1>Cryptographie appliquée</h1>

        <p>Travaux à partir de la conférence : <a href="https://www.youtube.com/watch?v=1bcbWu1F0Mg">Comment fonctionne la cryptographie ? - Julien Pauli - Forum PHP 2018</a></p>

        <?php
        $crypt = new cryptography();

        echo "<p>La chaîne de caractères cryptée en binaire vaut : <span class=\"binary\">" . $crypt->encrypt("Hello World !") . "</span></p>";

        echo "<p><small>Chaîne décryptée :</small> " . $crypt->decrypt() . "</p>";

        echo "<p>La clé de cryptage qui doit être unique et rester secrète vaut : <span class=\"binary\">" . $crypt->keyShow() . "</span></p>";
        ?>

        <hr>

        <?php
        echo "<p>La chaîne de caractères cryptée en binaire vaut : <span class=\"binary\">" . $crypt->encrypt("La quiche Lorraine est un grand classique de la cuisine française et fait partie de la grande famille des tartes salées. La version authentique est composée d'une pâte brisée, d’œufs, de crème et de lardons. Certains y ajoutent du jambon blanc et du fromage râpé. Si vous y ajoutez d'autres choses, comme des légumes, on parle de quiche ou de tarte salée mais plus de quiche lorraine. ") . "</span></p>";

        echo "<p><small>Chaîne décryptée :</small> " . $crypt->decrypt() . "</p>";

        echo "<p>La clé de cryptage qui doit être unique et rester secrète vaut : <span class=\"binary\">" . $crypt->keyShow() . "</span></p>";
        ?>
    </body>
</html>
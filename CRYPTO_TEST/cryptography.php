<?php

class cryptography
{
    private $str; // Chaîne de caractère à passer en paramètre
    private $key; // Clé binaire de cryptage
    private $enc; // Chaîne de caractère cryptée en binaire

    // Getter & setter
    private function getKey()
    {
        return $this->key;
    }

    private function getStr()
    {
        return $this->str;
    }

    public function setStr($str)
    {
        $this->str = $str;
    }

    public function getEnc()
    {
        return $this->enc;
    }

    public function setEnc($enc)
    {
        $this->enc = $enc;
    }

    // Générateur aléatoire de clé binaire
    // paramètre len = longueur de la clé
    private static function binKeyGen($len)
    {
        $key = "";

        for($i = 0; $i < $len; $i++)
        {
            $key .= rand(0, 1);
        }

        return $key;
    }

    // Conversion input de base en binaire
    // On complète chaque valeur binaire pour qu'elle mesure 8 caractères
    // car la valeur max (255 en ascii) mesure 8 bits (1 octet) en binaire.
    private function  toBinary($str)
    {
        $res = "";

        for($i = 0; $i < strlen($str); $i++)
        {
            $res .= str_pad((decbin(ord($str[$i]))), 8, "0", STR_PAD_LEFT);
        }

        return $res;
    }

    // Conversion de la chaîne binaire décryptée en caractères lisibles
    // On scinde la chaine tous les 8 caractères et on la convertit en tableau
    private function  toDecimal($str)
    {
        $res = "";

        $str = wordwrap($str, 8, " ", true);
        $str = explode(" ", $str);

        for($i = 0; $i < count($str); $i++)
        {
            $res .= chr(bindec($str[$i]));
        }

        return $res;
    }

    // Méthode d'encryptage
    public function encrypt($str)
    {
        $this->setStr($str);
        $str = $this->toBinary($this->getStr());
        $this->key = self::binKeyGen(1024); // On génère la clé binaire avec la longueur désirée
        $key = $this->getKey();
        $res = "";
        $keyIndex; // Variable de bouclage de la clé si celle-ci est plus courte que la chaîne de caractères à crypter (voir plus bas)
        $keyLen = strlen($key); // longueur de la clé binaire
        $strLen = strlen($str); // longueur de la chaîne de caractère binaire

        for($i = 0; $i < $strLen; $i++)
        {
            $keyIndex = $i % $keyLen;

            $res .= strval(intval($key[$keyIndex]) ^ intval($str[$i])); // Cryptage =  clé Xor chaîne de caractère en clair
        }

        $this->setEnc($res); // On set la chaîne binaire cryptée

        return $res;
    }

    // Méthode de décryptage
    public function decrypt()
    {
        $key = $this->getKey();
        $str = $this->getEnc();
        $res = "";
        $keyIndex;
        $keyLen = strlen($key);
        $strLen = strlen($str);

        for($i = 0; $i < $strLen; $i++)
        {
            $keyIndex = $i % $keyLen;

            $res .= strval(intval($key[$keyIndex]) ^ intval($str[$i])); // Décryptage =  clé Xor chaîne de caractère cryptée
        }

        $res = $this->toDecimal($res); // On convertit la chaîne décryptée en décimal

        return $res;
    }

    // Méthode de divulgation de la clé (pas bien !)
    public function keyShow()
    {
        if($this->getEnc() === null)
        {
            return "Aucune clé n'a été générée !";
        } else {
            return $this->getKey();
        }
    }
}





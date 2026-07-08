<?php

namespace App\Helpers;

class AffineHelper
{
    private static int $keyMul = 7;   
    private static int $keyAdd = 3;   
    private static int $keyMod = 256;
    private static int $keyXor = 42; 
    
    //Encryption
    public static function encrypt(string $plain): string
    {
        $cipher = '';
        for ($i = 0; $i < strlen($plain); $i++) {
            $c = (self::$keyMul * ord($plain[$i]) + self::$keyAdd) % self::$keyMod;
           
            $c = $c ^ self::$keyXor;
            $cipher .= chr($c);
        }
        return base64_encode($cipher);
    }

    //Decryption
    public static function decrypt(string $cipherB64): string
    {
        $cipher = base64_decode($cipherB64);
        $ori = '';

        for ($i = 0; $i < strlen($cipher); $i++) {
            $c = ord($cipher[$i]) ^ self::$keyXor;

            $m = $c - self::$keyAdd;
            while ($m < 0) {
                $m += self::$keyMod;
            }

            $inv = 0;
            $j   = 0;
            $r   = 0;
            while ($j <= 10 && $inv == 0) {
                $j++;
                $r    = $j * self::$keyMod + $m;
                $fKey = $r / self::$keyMul;
                if ($fKey == (int)$fKey) {
                    $inv = $j;
                }
            }

            $ori .= chr((int)($r / self::$keyMul));
        }

        return $ori;
    }
}
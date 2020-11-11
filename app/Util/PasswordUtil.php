<?php
declare(strict_types=1);

namespace App\Util;

class PasswordUtil
{
    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function encrypt(string $str)
    {
        return password_hash($str . $this->key, PASSWORD_BCRYPT);
    }

    public function verify(string $str, string $encryptStr): bool
    {
        return password_verify($str . $this->key, $encryptStr);
    }

}
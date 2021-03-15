<?php

namespace Component;


class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->start();
    }

    /**
     * @param $key
     * @param $value
     */
    public function setValue($key, $value)
    {
        if ($this->hasKey($key) && is_array($_SESSION[$key])) {
            //$_SESSION[$key][] = $value;
            array_push($_SESSION[$key], $value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getValue($key)
    {
        if ($this->hasKey($key)) {
            return $_SESSION[$key];
        }
        throw new SessionException("La clé n'existe pas", $key);
    }

    public function getAll()
    {
        return $_SESSION;
    }

    public function hasKey($key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param $key
     */
    public function removeValue($key)
    {
        if ($this->hasKey($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Démarre la session si elle n'est pas déjà démarrée
     */
    public function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Détruit la session si elle existe
     */
    public function destroy()
    {
        if (session_status() !== PHP_SESSION_NONE) {
            session_destroy();
        }
    }
}
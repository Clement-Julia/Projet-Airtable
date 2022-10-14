<?php

class AdminControleur {
    public function base_url($url = null)
    {
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            "/Projet/Airtable/".$url
          );
    }
}
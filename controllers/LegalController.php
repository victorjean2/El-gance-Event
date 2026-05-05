<?php

class LegalController
{
    public function mentions()
    {
        require_once '../views/legal/mentions.php';
    }

    public function privacy()
    {
        require_once '../views/legal/privacy.php';
    }

    public function cgu()
    {
        require_once '../views/legal/cgu.php';
    }
}
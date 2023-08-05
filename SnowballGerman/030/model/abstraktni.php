<?php


class abstraktni
{
    protected $db;

    public function __construct(trida $db)
    {
        $this->db = $db;
    }
}
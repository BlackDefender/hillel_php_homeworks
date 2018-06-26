<?php

class Repo
{
    protected static function connection()
    {
        return DB::getConnection();
    }
}
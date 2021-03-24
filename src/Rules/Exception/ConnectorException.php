<?php


namespace App\Rules\Exception;


class ConnectorException extends RuleException
{
    public static function illegalDoors() : self
    {
        return new self('This connector can\'t be accessed in this tile context');
    }
}
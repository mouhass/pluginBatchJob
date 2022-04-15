<?php

namespace App\Message;

class LogCommand
{
    private $nameCommand;
    public function __construct(string $nameCommand)
    {
        $this->nameCommand = $nameCommand;
    }

    /**
     * @return string
     */
    public function getNameCommand(): string
    {
        return $this->nameCommand;
    }



}

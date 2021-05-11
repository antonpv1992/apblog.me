<?php


namespace tools\core\base;


abstract class Mapper
{
    /** @var .data store */
    protected $storage;

    /**
     * Mapper constructor.
     * @param $storage
     */
    public function __construct($storage)
    {
        $this->storage = $storage;
    }
}
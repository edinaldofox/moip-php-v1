<?php

namespace Moip\Response;

/**
 * Class MoipResponse
 * @package Moip\Response
 */
class MoipResponse implements MoipResponseInterface
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var string | array
     */
    protected $body;

    /**
     * MoipResponse constructor.
     *
     * @param mixed $body
     */
    public function __construct($code, $body)
    {
        $this->code = $code;
        $this->body = $body;
    }


    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}

<?php

namespace Moip\Request;

use Moip\HttpMethod;
use Moip\MoipEndpoint;

/**
 * Class MoipTokenCreateRequest
 * @package Moip\Request
 */
class MoipTokenCreateRequest implements MoipRequestInterface
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var
     */
    private $data;

    /**
     * MoipCreateTokenRequest constructor.
     *
     * @param array|object|string $data
     */
    public function __construct($data)
    {
        $this->method = HttpMethod::HTTP_METHOD_POST;
        $this->endpoint = MoipEndpoint::ENDPOINT_SEND_INSTRUCTION;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array|object|string $data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }
}

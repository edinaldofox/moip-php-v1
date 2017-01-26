<?php

namespace Moip\Request;

/**
 * Interface MoipRequestInterface
 * @package Moip\Request
 */
interface MoipRequestInterface
{
    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return string
     */
    public function getEndpoint();

    /**
     * @return array|object|string $data
     */
    public function getData();
}

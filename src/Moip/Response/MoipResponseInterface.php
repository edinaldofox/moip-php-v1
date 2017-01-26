<?php

namespace Moip\Response;

/**
 * Interface MoipResponseInterface
 * @package Moip\Response
 */
interface MoipResponseInterface
{
    /**
     * @return int
     */
    public function getCode();

    /**
     * @return mixed
     */
    public function getBody();
}

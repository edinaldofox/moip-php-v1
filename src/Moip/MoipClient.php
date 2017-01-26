<?php

namespace Moip;

use Curl\Curl;
use Moip\Request\MoipRequestInterface;
use Moip\Response\MoipResponse;
use Moip\Response\MoipResponseInterface;
use SimpleXMLElement;

/**
 * Class MoipClient
 * @package Moip
 */
class MoipClient
{
    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var string
     */
    private $env;

    /**
     * MoipClient constructor.
     *
     * @param string $env
     * @param $token
     * @param $key
     */
    public function __construct($env, $token, $key)
    {
        $this->env = $env;
        $this->curl = new Curl();
        $this->curl->setBasicAuthentication($token, $key);
        $this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $this->curl->setOpt(CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param MoipRequestInterface $request
     *
     * @return MoipResponseInterface
     */
    public function send(MoipRequestInterface $request)
    {
        $endpoint = sprintf('%s%s', $this->env, $request->getEndpoint());

        call_user_func_array(
            [$this->curl, $request->getMethod()],
            [
                $endpoint,
                $request->getData()
            ]
        );

        if ($this->curl->error) {
            if (500 === $this->curl->error_code) {
                return new MoipResponse(500, 'Falha interna no serviço');
            }

            if (401 === $this->curl->error_code) {
                return new MoipResponse(401, 'Falha na autenticação');
            }
        }

        $response = new SimpleXmlElement($this->curl->response);

        if ('Falha' === (string) $response->Resposta->Status) {
            $error = $response->Resposta->Erro[0];
            return new MoipResponse(400, sprintf('%s - %s', (string) $error->attributes(), (string) $error));
        }

        return new MoipResponse(201, $response);
    }
}

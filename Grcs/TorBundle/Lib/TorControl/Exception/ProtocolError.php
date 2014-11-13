<?php
/*
 * This file is part of the Grcs package.
 *
 * (c) Alexander Gorelov <grac.ga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grcs\TorBundle\Lib\TorControl\Exception;

/**
 * Class ProtocolError
 *
 * @package Grcs\TorBundle\Lib\TorControl\Exception
 */
class ProtocolError extends \UnexpectedValueException
{
    /**
     * Response
     *
     * @var string
     */
    protected $response;

    /**
     * Gets the response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the response
     *
     * @param string $response
     * @return string
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}

<?php
/*
 * This file is part of the Grcs package.
 *
 * (c) Alexander Gorelov <grac.ga@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grcs\TorBundle\Lib;

use Grcs\TorBundle\Lib\TorControl\TorControl;
use Grcs\TorBundle\Lib\TorControl\Exception\IOError;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Provider
 *
 * @package Grcs\TorBundle\Lib
 */
class Provider extends ContainerAware
{
    /**
     * Time limit of get new proxy
     */
    const TIME_LIMIT = 15;

    /**
     * @var TorControl
     */
    protected $torControl = null;

    /**
     * @var int
     */
    protected $lastChangeTime = 0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->torControl = new TorControl();
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $configs = $this->container->get('service_container')->getParameter('grcs.tor_config');
        $this->torControl->setOptions($configs);
    }

    /**
     * Get new ip address from tor network
     *
     * @return bool
     *
     * @throws IOError
     * @throws \Exception
     */
    public function getNewIpAddress()
    {
        if ($this->lastChangeTime !== 0 && time() - $this->lastChangeTime < self::TIME_LIMIT) {
            return false;
        }

        $this->lastChangeTime = time();
        // Renew identity
        $this->torControl->connect();
        $this->torControl->authenticate();
        $this->torControl->executeCommand('SIGNAL NEWNYM');

        return true;
    }

    /**
     * @return string
     */
    public function getTorHostname()
    {
        return $this->torControl->getOption('hostname');
    }

    /**
     * @return int
     */
    public function getTorPort()
    {
        return $this->torControl->getOption('port');
    }
}
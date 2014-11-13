GrcsTorBundle
=============

License:

    see LICENSE

Installation
============

1) Add TorBundle to your vendor/ dir

Through composer:

    "require": {
        ...
        "grcs/tor-bundle": "dev-master"
        ...
    }

2) Add TorBundle to your application kernel

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new Grcs\TorBundle\GrcsTorBundle(),
            // ...
        );
    }

4) Install TOR https://www.torproject.org/docs/tor-doc-unix.html.en

5) Configure TOR

    // add to /patch/to/etc/tor/torrc
    
    ControlPort 9051
    
6) Run TOR

7) Use

    $tor = $this->get('grcs.tor');
    $tor->getNewIpAddress();
    
    Curl:
    $options = array(
        CURLOPT_URL            => 'http://google.com',
        CURLOPT_HEADER         => false,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_PROXY          => $tor->getTorHostname() . ':' . $tor->getTorPort(),
        CURLOPT_PROXYTYPE      => CURLPROXY_SOCKS5,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
    );
    $ch = \curl_init();
    \curl_setopt_array($ch, $options);
    $result = \curl_exec($ch);

<?php

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? $_ENV['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? $_ENV['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);


/**
 * Homework №2
 */

abstract class Param {

    public $Pnom;
    public $Unom;
    public $CosI;
    public $Inom;

};

interface circuitBreaker {

    public function Inom();

    public function InomQA();

    public function QAnominal();

    public function cable();

};

class rozrah extends Param implements circuitBreaker {

    public function __construct ($Pnom, $Unom, $CosI) {
        $this -> Pnom = $Pnom;
        $this -> Unom = $Unom;
        $this -> CosI = $CosI;
    }

    /**
     * we calculate the rated current of the electrical installation
     */
    public function Inom () {
        echo $this -> Inom = ($this -> Pnom) / (1.732 * ($this -> Unom) * ($this -> CosI));
    }

    /**
     * We calculate the rated current of the machine, necessary to protect the cable of a certain section
     */
    public function InomQA() {

    }

    /**
     * Сircuit breaker selection according to the trip current
     */
    public function QAnominal() {

    }

    /**
     * Cable selection according to circuit breaker current
     */
    public function cable() {

    }

};

$otvet = new rozrah(10, 0.38, 0.92);



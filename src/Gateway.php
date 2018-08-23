<?php

namespace Omnipay\Exact;

use Omnipay\Common\AbstractGateway;

/**
 * Exact Gateway
 * @link https://support.e-xact.com/hc/en-us/categories/114093975194-E-xact-x
 */

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Exact';
    }

    public function getDefaultParameters()
    {
        return [
            'productionEndPoint' => '',
            'sandboxEndPoint' => '',
            'gatewayId' => '',
            'password' => '',
        ];
    }

    public function getSandboxEndPoint()
    {
        return $this->getParameter('sandboxEndPoint');
    }

    public function setSandboxEndPoint($value)
    {
        return $this->setParameter('sandboxEndPoint', $value);
    }

    public function getProductionEndPoint()
    {
        return $this->getParameter('productionEndPoint');
    }

    public function setProductionEndPoint($value)
    {
        return $this->setParameter('productionEndPoint', $value);
    }

    public function getGatewayId()
    {
        return $this->getParameter('gatewayId');
    }

    public function setGatewayId($value)
    {
        return $this->setParameter('gatewayId', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Exact\Message\CreateCardRequest', $parameters);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Exact\Message\AuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Exact\Message\CaptureRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Exact\Message\PurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Exact\Message\RefundRequest', $parameters);
    }
}


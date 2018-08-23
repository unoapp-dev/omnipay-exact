<?php

namespace Omnipay\Exact\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [];

        $this->getCard()->validate();

        if($this->getCard()) {

            $data = [
                'gateway_id' => $this->getGatewayId(),
                'password' => $this->getPassword(),
                'transaction_type' => '40',
                'cc_number' => $this->getCard()->getNumber(),
                'cc_expiry' => $this->getCard()->getExpiryDate('my'),
                'cardholder_name' =>  $this->getCard()->getName(),
            ];
        }

        return json_encode($data);
    }
}

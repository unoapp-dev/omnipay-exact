<?php

namespace Omnipay\Exact\Message;

class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [];

        $this->validate('amount');

        if ($this->getCardReference()) {

            try {
                $cardReference = json_decode($this->getCardReference());
                $data = [
                    'gateway_id' => $this->getGatewayId(),
                    'password' => $this->getPassword(),
                    'transaction_type' => '31',
                    'amount' => $this->getAmount(),
                    'transaction_tag' => $cardReference->transaction_tag,
                    'authorization_num' => $cardReference->authorization_num,
                    'reference_no' => $this->getOrderNumber(),
                ];
            }
            catch (\Exception $e) {
                throw new InvalidRequestException('Invalid payment profile');
            }
        }

        return json_encode($data);
    }
}

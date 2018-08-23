<?php

namespace Omnipay\Exact\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RefundRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('amount', 'transactionReference');

        try {
            $transactionReference = json_decode($this->getTransactionReference());
            $data = [
                'gateway_id' => $this->getGatewayId(),
                'password' => $this->getPassword(),
                'transaction_type' => '34',
                'amount' => $this->getAmount(),
                'transaction_tag' => $transactionReference->transaction_tag,
                'authorization_num' => $transactionReference->authorization_num,
                'reference_no' => $transactionReference->reference_no,
            ];
        }
        catch (\Exception $e) {
            throw new InvalidRequestException('Invalid payment profile');
        }

        return json_encode($data);
    }
}

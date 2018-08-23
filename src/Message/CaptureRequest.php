<?php

namespace Omnipay\Exact\Message;

class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [];

        if ($this->getTransactionReference()) {

            try {
                $cardReference = json_decode($this->getTransactionReference());
                $data = [
                    'gateway_id' => $this->getGatewayId(),
                    'password' => $this->getPassword(),
                    'transaction_type' => '32',
                    'amount' => $cardReference->amount,
                    'transaction_tag' => $cardReference->transaction_tag,
                    'authorization_num' => $cardReference->authorization_num,
                    'reference_no' => $cardReference->reference_no,
                ];
            }
            catch (\Exception $e) {
                throw new InvalidRequestException('Invalid payment profile');
            }
        }

        return json_encode($data);
    }
}

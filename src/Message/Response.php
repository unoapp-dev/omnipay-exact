<?php

namespace Omnipay\Exact\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->data && $this->data['error_number'] == 0 &&
            $this->data['transaction_error'] == 0;
    }

    public function getCardReference()
    {
        $response = null;

        if (isset($this->data['authorization_num']) && isset($this->data['transaction_tag'])) {
            $response = [
                'authorization_num' => $this->data['authorization_num'],
                'transaction_tag' => $this->data['transaction_tag']
            ];
            $response = json_encode($response);
        }

        return  $response;
    }

    public function getAuthorizationNum()
    {
        if (isset($this->data['authorization_num'])){
            return $this->data['authorization_num'];
        }
    }
    public function getTransactionTag()
    {
        if (isset($this->data['transaction_tag'])){
            return $this->data['transaction_tag'];
        }
    }

    public function getCode()
    {
        if ($this->data['error_number'] != 0) {
            return $this->data['error_number'];
        } elseif ($this->data['transaction_error'] != 0) {
            return $this->data['exact_resp_code'];
        } else {
            return $this->data['bank_resp_code'];
        }
    }

    public function getAuthCode()
    {
        return null;
    }

    public function getMessage()
    {
        if ($this->data['error_number'] != 0) {
            return $this->data['error_description'];
        } elseif ($this->data['transaction_error'] != 0) {
            return $this->data['exact_message'];
        } else {
            return $this->data['bank_message'];
        }
    }

    public function getOrderNumber()
    {
        return null;
    }

    public function getData()
    {
        return json_encode($this->data);
    }
}


<?php

namespace Coreproc\Enom;

use Exception;

class Domain
{

    /**
     * @var Enom
     */
    private $enom;

    private $client;

    public function __construct(Enom $enom)
    {
        $this->enom = $enom;
        $this->client = $enom->getClient();
    }

    public function check($sld, $tld)
    {
        try {
            return $this->enom->call('check', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getNameSpinner($sld, $tld, array $options = [])
    {
        try {
            return $this->enom->call('NameSpinner', [
                'sld'        => $sld,
                'tld'        => $tld,
                'UseHyphens' => (isset($options['useHyphens'])) ? $options['useHyphens'] : true,
                'UseNumbers' => (isset($options['useNumbers'])) ? $options['useNumbers'] : true,
                'MaxResults' => (isset($options['maxResults'])) ? $options['maxResults'] : 10,
            ])->namespin;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getExtendedAttributes($tld)
    {
        try {
            return $this->enom->call('GetExtAttributes', [
                'tld' => $tld,
            ])->Attributes;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function purchase($sld, $tld, array $extendedAttributes = [])
    {
        $params = [
            'sld' => $sld,
            'tld' => $tld,
        ];

        if (count($extendedAttributes)) {
            $params = array_merge($params, $extendedAttributes);
        }

        try {
            return $this->enom->call('Purchase', $params);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getStatus($sld, $tld, $orderId)
    {
        try {
            return $this->enom->call('GetDomainStatus', [
                'sld'       => $sld,
                'tld'       => $tld,
                'orderid'   => $orderId,
                'ordertype' => 'purchase',
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getList()
    {
        try {
            return $this->enom->call('GetDomains');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getExpired()
    {
        try {
            return $this->enom->call('GetExpiredDomains');
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getInfo($sld, $tld)
    {
        try {
            return $this->enom->call('GetDomainInfo', [
                'sld' => $sld,
                'tld' => $tld
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setContactInformation($sld, $tld, array $contactInfo = [])
    {
        $params = [
            'sld' => $sld,
            'tld' => $tld,
        ];

        $params = array_merge($params, $contactInfo);

        try {
            return $this->enom->call('Contacts', $params);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getContactInformation($sld, $tld)
    {
        try {
            return $this->enom->call('GetContacts', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getWhoIsContactInformation($sld, $tld)
    {
        try {
            return $this->enom->call('GetWhoIsContact', [
                'sld' => $sld,
                'tld' => $tld,
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}

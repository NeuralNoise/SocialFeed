<?php

/*
 * This file is part of the Social Feed Util.
 *
 * (c) LaNetscouade <contact@lanetscouade.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lns\SocialFeed\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use Lns\SocialFeed\Exception\RequestException;

/**
 * FacebookApiClient.
 */
class FacebookApiClient extends AbstractClient implements ClientInterface
{
    private $client;
    private $clientKey;
    private $clientSecret;

    /**
     * __construct.
     *
     * @param $clientKey
     * @param $clientSecret
     */
    public function __construct($clientKey, $clientSecret)
    {
        $this->clientKey = $clientKey;
        $this->clientSecret = $clientSecret;
    }

    /**
     * get.
     *
     * @param $path
     * @param array $options
     */
    public function get($path, array $options = array())
    {
        $client = $this->createGuzzleClient($this->clientKey, $this->clientSecret);

        $options = $this->applyDefaultClientQuery($client, $options);

        try {
            return $response = json_decode($client->get('/v2.3'.$path, $options)->getBody(), true);
        } catch (GuzzleRequestException $e) {
            $message = $e->getMessage();

            if ($e->hasResponse()) {
                $responseData = json_decode($e->getResponse()->getBody(), true);
                $message = $responseData['error']['code'].' - '.$responseData['error']['message'];
            }

            throw new RequestException($message);
        }
    }

    /**
     * createGuzzleClient.
     *
     * @param $clientKey
     * @param $clientSecret
     */
    protected function createGuzzleClient($clientKey, $clientSecret)
    {
        $client = new Client(array(
            'base_uri' => 'https://graph.facebook.com',
            'query' => array(
                'access_token' => $clientKey.'|'.$clientSecret,
            ),
        ));

        return $client;
    }
}

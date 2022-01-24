<?php

namespace Prepr\OpsGenie;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


/**
 *
 */
class OpsGenie
{
    /**
     * @return incident
     */
    public function incident()
    {
        return new incident(null, $this);
    }

    public function heartbeat($name)
    {
        try {
            $client = new Client();
            $client->request('GET', 'https://api.opsgenie.com/v2/heartbeats/' . $name . '/ping', [
                'headers' => [
                    'Authorization' => 'GenieKey ' . config('opsgenie.key'),
                ],
            ]);
        } catch (GuzzleException $e) {
        }
    }

    /**
     * @return alert
     */
    public function alert()
    {
        return new alert(null, $this);
    }
}

/**
 *
 */
class incident
{
    /**
     * @var array
     */
    private $object = [
        'priority' => 'P3',
    ];

    /**
     * @var
     */
    private $parent;

    /**
     * @param $data
     * @param $parent
     */
    function __construct($data, $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param int $priority Priority of incident, 1 = Critical, 2 = High, 3 = Moderate, 4 = Low, 5 = Informational.
     * @return $this
     */
    private function priority(int $priority)
    {
        $this->object['priority'] = 'P' . $priority;

        return $this;
    }

    /**
     * @return $this
     */
    public function critical()
    {
        $this->priority(1);

        return $this;
    }

    /**
     * @return $this
     */
    public function high()
    {
        $this->priority(2);

        return $this;
    }

    /**
     * @return $this
     */
    public function moderate()
    {
        $this->priority(3);

        return $this;
    }

    /**
     * @return $this
     */
    public function low()
    {
        $this->priority(4);

        return $this;
    }

    /**
     * @return $this
     */
    public function informational()
    {
        $this->priority(5);

        return $this;
    }

    /**
     * @return $this
     */
    public function P1()
    {
        $this->priority(1);

        return $this;
    }

    /**
     * @return $this
     */
    public function P2()
    {
        $this->priority(2);

        return $this;
    }

    /**
     * @return $this
     */
    public function P3()
    {
        $this->priority(3);

        return $this;
    }

    /**
     * @return $this
     */
    public function P4()
    {
        $this->priority(4);

        return $this;
    }

    /**
     * @return $this
     */
    public function P5()
    {
        $this->priority(5);

        return $this;
    }

    /**
     * @param string $message Title of the incident.
     * @return $this
     */
    public function message(string $message)
    {
        $this->object['message'] = (config('opsgenie.prefix') ? '[' . config('opsgenie.prefix') . '] ' : '') . $message;

        return $this;
    }

    /**
     * @param string $description Description body of the incident.
     * @return $this
     */
    public function description(string $description)
    {
        $this->object['description'] = $description;

        return $this;
    }


    /**
     * @param array $details Extra properties of the incident. (Key-Value list)
     * @return $this
     */
    public function details(array $details = [])
    {
        $this->object['details'] = $details;

        return $this;
    }

    /**
     * @param array $tags Tags of the incident. (Simple list)
     * @return $this
     */
    public function tags(array $tags = [])
    {
        $this->object['tags'] = $tags;

        return $this;
    }

    /**
     *
     */
    public function send()
    {
        try {
            $client = new Client();

            $data = array_merge($this->object, [
                'impactedServices' => [
                    config('opsgenie.service'),
                ],
            ]);

            $client->request('POST', 'https://api.opsgenie.com/v1/incidents/create', [
                'headers' => [
                    'Authorization' => 'GenieKey ' . config('opsgenie.key'),
                ],
                'json' => $data,
            ]);
        } catch (GuzzleException $e) {
        }
    }
}

/**
 *
 */
class alert
{
    /**
     * @var array
     */
    private $object = [
        'priority' => 'P3',
    ];

    /**
     * @var
     */
    private $parent;

    /**
     * @param $data
     * @param $parent
     */
    function __construct($data, $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param int $priority Priority of alert, 1 = Critical, 2 = High, 3 = Moderate, 4 = Low, 5 = Informational.
     * @return $this
     */
    private function priority(int $priority)
    {
        $this->object['priority'] = 'P' . $priority;

        return $this;
    }

    /**
     * @return $this
     */
    public function critical()
    {
        $this->priority(1);

        return $this;
    }

    /**
     * @return $this
     */
    public function high()
    {
        $this->priority(2);

        return $this;
    }

    /**
     * @return $this
     */
    public function moderate()
    {
        $this->priority(3);

        return $this;
    }

    /**
     * @return $this
     */
    public function low()
    {
        $this->priority(4);

        return $this;
    }

    /**
     * @return $this
     */
    public function informational()
    {
        $this->priority(5);

        return $this;
    }

    /**
     * @return $this
     */
    public function P1()
    {
        $this->priority(1);

        return $this;
    }

    /**
     * @return $this
     */
    public function P2()
    {
        $this->priority(2);

        return $this;
    }

    /**
     * @return $this
     */
    public function P3()
    {
        $this->priority(3);

        return $this;
    }

    /**
     * @return $this
     */
    public function P4()
    {
        $this->priority(4);

        return $this;
    }

    /**
     * @return $this
     */
    public function P5()
    {
        $this->priority(5);

        return $this;
    }

    /**
     * @param string $message Title of the alert.
     * @return $this
     */
    public function message(string $message)
    {
        $this->object['message'] = (config('opsgenie.prefix') ? '[' . config('opsgenie.prefix') . '] ' : '') . $message;

        return $this;
    }

    /**
     * @param string $description Description body of the alert.
     * @return $this
     */
    public function description(string $description)
    {
        $this->object['description'] = $description;

        return $this;
    }


    /**
     * @param array $details Extra properties of the alert. (Key-Value list)
     * @return $this
     */
    public function details(array $details = [])
    {
        $this->object['details'] = $details;

        return $this;
    }

    /**
     * @param array $tags Tags of the alert. (Simple list)
     * @return $this
     */
    public function tags(array $tags = [])
    {
        $this->object['tags'] = $tags;

        return $this;
    }

    /**
     * @param string $entity Entity of the alert.
     * @return $this
     */
    public function entity(string $entity)
    {
        $this->object['entity'] = $entity;

        return $this;
    }

    /**
     * @param string $alias Alias of the alert.
     * @return $this
     */
    public function alias(string $alias)
    {
        $this->object['alias'] = $alias;

        return $this;
    }

    /**
     *
     */
    public function send()
    {
        try {
            $client = new Client();

            $data = array_merge($this->object, [
                'impactedServices' => [
                    config('opsgenie.service'),
                ],
            ]);

            $response = $client->request('POST', 'https://api.opsgenie.com/v2/alerts', [
                'headers' => [
                    'Authorization' => 'GenieKey ' . config('opsgenie.key'),
                ],
                'json' => $data,
            ]);

            $parsedResponse = json_decode($response->getBody()->getContents(), true);

            return new AlertResponse($parsedResponse, $this);
        } catch (GuzzleException $e) {
        }
    }
}

class AlertResponse
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var
     */
    private $parent;

    function __construct($data, $parent)
    {
        $this->data = $data;
        $this->parent = $parent;
    }

    private function getAlertId()
    {
        if (array_key_exists('alertId', $this->data)) {
            return $this->data['alertId'];
        } else {
            try {
                $client = new Client();

                $response = $client->request('GET', 'https://api.opsgenie.com/v2/alerts/requests/' . $this->data['requestId'], [
                    'headers' => [
                        'Authorization' => 'GenieKey ' . config('opsgenie.key'),
                    ],
                ]);

                $response = json_decode($response->getBody()->getContents(), true);

                return $this->data['alertId'] = $response['data']['alertId'];
            } catch (GuzzleException $e) {
            } catch (Exception $e) {
            }
        }
    }

    public function attachFile($pathToFile = '')
    {
        if (!empty($pathToFile) && file_exists($pathToFile)) {
            if ($this->getAlertId()) {
                try {
                    $client = new Client();

                    $response = $client->request('POST', 'https://api.opsgenie.com/v2/alerts/' . $this->data['alertId'] . '/attachments', [
                        'headers' => [
                            'Authorization' => 'GenieKey ' . config('opsgenie.key'),
                        ],
                        'multipart' => [
                            [
                                'name' => 'file',
                                'contents' => fopen($pathToFile, 'r'),
                            ],
                        ],
                    ]);
                } catch (GuzzleException $e) {
                }

            }
        }

        return $this;
    }

    public function attachBlob($blob, $name = 'file')
    {
        if (!empty($blob)) {
            if ($this->getAlertId()) {
                try {
                    $client = new Client();

                    $response = $client->request('POST', 'https://api.opsgenie.com/v2/alerts/' . $this->data['alertId'] . '/attachments', [
                        'headers' => [
                            'Authorization' => 'GenieKey ' . config('opsgenie.key'),
                        ],
                        'multipart' => [
                            [
                                'name' => 'file',
                                'contents' => $blob,
                                'filename' => $name,
                            ],
                        ],
                    ]);
                } catch (GuzzleException $e) {
                }

            }
        }

        return $this;
    }

}

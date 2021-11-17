<?php

namespace DavydeVries\OpsGenie;

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
        $incident = new incident(null, $this);
        return $incident;
    }

    public function heartbeat($name)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $client->request('GET', 'https://api.opsgenie.com/v2/heartbeats/' . $name . '/ping', [
                'headers' => [
                    'Authorization' => 'GenieKey ' . config('opsgenie.key'),
                ]
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        }
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
        $this->object['message'] = $message;

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
            $client = new \GuzzleHttp\Client();

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
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        }
    }
}

<?php

if (! function_exists('opsgenie')) {
    /**
     * @param int $priority Incident priority. (1=Critical, 2=High, 3=Moderate, 4=Low, 5=Informational)
     * @param string|null $message (optional)
     * @param string|null $description (optional)
     * @param array $details (optional)
     * @param array $tags (optional)
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function opsgenie(int $priority, string $message = null, string $description = null, array $details = [], array $tags = []) {
        $client = new \GuzzleHttp\Client();

        $client->request('POST', 'https://api.opsgenie.com/v1/incidents/create', [
            'headers' => [
                'Authorization' => 'GenieKey ' . config('opsgenie.key')
            ],
            'json' => [
                'priority' => 'P' . $priority,
                'message' => $message,
                'description' => $description,
                'details' => $details,
                'tags' => $tags,
                'impactedServices' => [
                    config('opsgenie.service')
                ]
            ]
        ]);
    }
}

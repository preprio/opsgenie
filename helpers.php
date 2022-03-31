<?php

if (! function_exists('Ops')) {
    /**
     * @return \Prepr\OpsGenie\OpsGenie
     */
    function Ops()
    {
        if (config('opsgenie.key')) {
            return new Prepr\OpsGenie\OpsGenie();
        }
    }
}

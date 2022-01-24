<?php

if (! function_exists('Ops')) {
    /**
     * @return \Prepr\OpsGenie\OpsGenie
     */
    function Ops() {
        return new Prepr\OpsGenie\OpsGenie();
    }
}

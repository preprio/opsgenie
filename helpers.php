<?php

if (! function_exists('Ops')) {
    /**
     * @return \DavydeVries\OpsGenie\OpsGenie
     */
    function Ops() {
        return new DavydeVries\OpsGenie\OpsGenie();
    }
}

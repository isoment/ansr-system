<?php

/**
 *  @return string logged in users region
 */
function users_region()
{
    return auth()->user()->userable->region->region_name;
}
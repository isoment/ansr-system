<?php

/**
 *  Get the logged in users region
 *  @return string 
 */
function users_region()
{
    return auth()->user()->userable->region->region_name;
}
<?php

namespace Tests;

use App\Models\Lease;
use App\Models\Property;
use App\Models\Region;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}

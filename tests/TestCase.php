<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\WithApi;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithApi;
}

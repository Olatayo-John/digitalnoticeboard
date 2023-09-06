<?php

namespace Tests;

use Database\Seeders\DatabaseSeederTest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $seed = true;
    protected $seeder = DatabaseSeederTest::class;
}

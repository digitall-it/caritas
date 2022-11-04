<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
//    use DatabaseMigrations;
//    use RefreshDatabase;

//    public function test_calculate_inventory_created() {
//        $this->assertTrue(false);
//    }
//
//    public function test_calculate_inventory_updated_from_new_transaction() {
//        $this->assertTrue(false);
//    }
//
//    public function test_calculate_inventory_updated_from_updated_transaction() {
//        $this->assertTrue(false);
//    }

}

<?php

namespace Tests\Unit\PromoCode\Service;

use App\Ticket\Modules\PromoCode\Service\SaveService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class SaveServiceTest extends TestCase
{
    /** @var SaveService */
    private $saveService;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        //dd($this->saveService);
        $this->assertTrue(true);
    }

    /**
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->saveService = $this->app->make(SaveService::class);
    }
}

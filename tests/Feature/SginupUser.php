<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class SginupUser extends TestCase
{
    /**
     * 画面表示のテストケース
     *
     * @return void
     */
    public function testShowCase1()
    {
        $response = $this->get('/eims/start');
        $response->assertStatus(200);
    }

    /**
     * ユーザ登録のテストケース
     *
     * @return void
     */
    public function testSignupSucceed()
    {
        $this->assertTrue(true);
    }

}

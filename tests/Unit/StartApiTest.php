<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * StartControllerのAPIをテストする
 */
class StartApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 登録に成功するケース
     *
     * @return void
     */
    public function testentrySucceed1()
    {
        $param = [
            'email' => 'test@test.com',
            'password' => 'testpassword',
            'passwordcheck' => 'testpassword',
        ];

        $response = $this->postJson('/eims/start/entry', $param);
        $response
            ->assertStatus(200)
            ->assertCookieNotExpired('sign');

    }

    /**
     * 入力エラーのケース　全項目未入力
     *
     * @return void
     */
    public function testErrorCase1()
    {
        $param = [
            'email' => '',
            'password' => '',
            'passwordcheck' => '',
        ];

        $response = $this->postJson('/eims/start/entry', $param);
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => '入力項目は全て入力してください。',
                'params' => ['email', 'password', 'passwordcheck'],
            ]);

        // sample {message: "入力項目は全て入力してください。", params: ["email", "password", "passwordcheck"]}
    }

    /**
     * 入力エラーのケース　メールアドレス未入力
     *
     * @return void
     */
    public function testErrorCase2()
    {
        $param = [
            'email' => '',
            'password' => 'testpassword',
            'passwordcheck' => 'testpassword',
        ];

        $response = $this->postJson('/eims/start/entry', $param);
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => '入力項目は全て入力してください。',
                'params' => ['email'],
            ]);
    }

    /**
     * 入力エラーのケース　パスワード未入力
     *
     * @return void
     */
    public function testErrorCase3()
    {
        $param = [
            'email' => 'test@test.com',
            'password' => '',
            'passwordcheck' => 'testpassword',
        ];

        $response = $this->postJson('/eims/start/entry', $param);
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => '入力項目は全て入力してください。',
                'params' => ['password'],
            ]);
    }

    /**
     * 入力エラーのケース　パスワード(確認)未入力
     *
     * @return void
     */
    public function testErrorCase4()
    {
        $param = [
            'email' => 'test@test.com',
            'password' => 'testpassword',
            'passwordcheck' => '',
        ];

        $response = $this->postJson('/eims/start/entry', $param);
        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => '入力項目は全て入力してください。',
                'params' => ['passwordcheck'],
            ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\User;

class TaskTest2 extends TestCase
{
    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    /**
     * 各テストメソッドの実行前に呼ばれる
     */
    public function setUp(): void
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成する
        $this->seed('UsersTableSeeder');
        $this->seed('FoldersTableSeeder');
        $this->seed('TasksTableSeeder');
    }
    /**
     * status_should_be_within_defined_numbers
     * @test
     */
    public function status_should_be_within_defined_numbers()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/folders/1/tasks/1/edit', [
            'title' => 'Sample task',
            'due_date' => Carbon::today()->format('Y/m/d'),
            'status' => 999,
        ]);

        $response->assertSessionHasErrors([
            'status' => 'Specify one of "unprocessed, in progress, done" for the status',
        ]);
    }
}

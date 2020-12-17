<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class TaskTest extends TestCase
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
        $this->seed('FoldersTableSeeder');
    }
    /**
     * Due date should be date
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123, //error
        ]);

        $response->assertSessionHasErrors([
            'due_date' => 'Enter the date in the Deadline',
        ]);
    }
    /**
     * Due date should not be past
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('folders/1/tasks/create', [
            'title' => 'Sample Task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), //error
        ]);

        $response->assertSessionHasErrors([
            'due_date' => 'Enter a date after today in the Deadline'
        ]);
    }
}

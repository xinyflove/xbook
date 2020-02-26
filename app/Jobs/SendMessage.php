<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $__notice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Notice $notice)
    {
        // 定义任务step1
        $this->__notice = $notice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // // 定义任务step2 通知每个用户系统消息
        $users = \App\Models\User::all();
        foreach ($users as $user)
        {
            $user->addNotice($this->__notice);
        }
    }
}

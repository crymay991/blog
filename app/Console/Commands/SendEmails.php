<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email {user} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a email to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 获取参数
//        $userId = $this->argument('user');
//        dd($userId);

        // 获取选项
        $option =$this->options('queue');
        dd($option);

        return 0;
    }
}

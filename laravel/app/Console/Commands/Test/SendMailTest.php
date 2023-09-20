<?php

namespace App\Console\Commands\Test;

use App\Mail\Test\SendMailTest as TestSendMailTest;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;

class SendMailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail to test cronjob';

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
    public function handle(Mailer $mailer)
    {
        $mailer->to('meiyerjaimes@gmail.com')->send(
            new TestSendMailTest
        );

        return 0;
    }
}

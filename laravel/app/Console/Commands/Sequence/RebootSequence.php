<?php

namespace App\Console\Commands\Sequence;

use App\Models\Tool\Sequence;
use Illuminate\Console\Command;

class RebootSequence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sequences:reboot
        {--t|type=0 : Tipo de sequencia a reiniciar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reiniciar secuencia para Correlativos';

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
        $type = $this->option('type');
        Sequence::rebootSequence($type);
        return 0;
    }
}

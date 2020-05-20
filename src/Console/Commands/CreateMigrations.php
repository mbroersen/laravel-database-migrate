<?php
namespace Mbroersen\LaravelDatabaseMigrate\Console\Commands;

use Illuminate\Console\Command;
use Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Creator;

class CreateMigrations extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new migrations from the database';


    /**
    * Execute the console command.
    *
    * @return mixed
    * @throws \Exception
    */
    public function handle()
    {
        (new Creator())->start();
    }

}

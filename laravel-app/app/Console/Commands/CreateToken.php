<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class CreateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:create {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new token';

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
        $user = User::find($this->argument('user'));
        if (!$user) {
            $this->error('User is not exist!');
            return 1;
        }
        $token = $user->createToken(Uuid::uuid4());
        $this->line($token->plainTextToken);
        return 0;
    }
}

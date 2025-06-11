<?php

namespace App\Console\Commands;

use App\Services\API\v1\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class UserGenerator extends Command
{

    public function __construct(protected UserService $userService)
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user {email} {name} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate test user';

    /**
     * Execute the console command.
     */
    public function handle()
    {

         $user = [
            'email' => $this->argument('email'),
            'name' => $this->argument('name'),
            'password' => $this->argument('password'),
        ];

        $validator = Validator::make($user, [
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->error('❌ Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->line("- $error");
            }
            return Command::FAILURE;
        }

        try {
            $this->userService->create($user);
            $this->info('✅ User created successfully.');
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('❌ Failed to create user: ' . $e->getMessage());
            return Command::FAILURE;
        }


    }
}

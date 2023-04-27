<?php

namespace App\Console\Commands;

use App\Api\Facades\Api;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

// This class defines a console command for syncing users from an API
class ApiSyncUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:api-sync-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync users from an API';

    /**
     * The main method that executes the command.
     *
     * @return bool
     */
    public function handle(): void {
        // Retrieve users from the API
        $users = Api::getUsers();

        // Check if the API returned an error
        if ($users['status'] === 'error') {
            $this->error($users['message']);
            return;
        }

        // Check if the data key exists
        if(!isset($users['message']['data']) || !count($users['message']['data'])) {
            $this->error('No users received');
            return;
        }

        // Display success message if data is received
        $this->info('Response successfully received, reading data now.');

        $response = $this->updateOrCreateUsers($users['message']['data']);

        if ($response === true) {
            $this->info('User data successfully synced.');
        } else {
            $this->error($response);
        }
    }

    public function updateOrCreateUsers($users): bool {

        // Set up validation rules for the user data
        $validatedUsers = Validator::make($users, [
            '*.first_name' => 'required|max:255',
            '*.last_name' => 'required|max:255',
            '*.email' => 'required|email|max:255',
            '*.avatar' => 'required|url|max:255'
        ], [
        ], [
            '*.first_name' => 'First Name on Row #:position',
            '*.last_name' => 'Last Name on Row #:position',
            '*.email' => 'Email on Row #:position',
            '*.avatar' => 'Avatar on Row #:position',
        ]);

        // Check if the validation fails
        if ($validatedUsers->stopOnFirstFailure()->fails()) {
            return $validatedUsers->errors()->first();
        }

        // Iterate over the validated user data
        foreach ($validatedUsers->validated() as $user) {
            // Update or create the user in the database
            User::updateOrCreate([
                'email' => $user['email']
            ], [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'avatar' => $user['avatar']
            ]);
        }

        return true;
    }

}

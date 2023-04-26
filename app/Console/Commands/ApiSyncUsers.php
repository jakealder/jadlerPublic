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
     * @throws ValidationException
     */
    public function handle(): bool {
        // Retrieve users from the API
        $users = Api::getUsers();

        // Check if the API returned an error
        if ($users['status'] === 'error') {
            $this->error($users['message']);
            return false;
        }

        // Check if the data key exists
        if(!isset($users['message']['data'])) {
            $this->error('No users received');
            return false;
        }

        // Check if the data array is empty
        if (!count($users['message']['data'])) {
            $this->error('No users received');
            return false;
        }

        // Display success message if data is received
        $this->info('Response successfully received, reading data now.');

        // Set up validation rules for the user data
        $validator = Validator::make($users['message']['data'], [
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
        if ($validator->stopOnFirstFailure()->fails()) {
            $this->error($validator->errors()->first());
            return false;
        }

        // Iterate over the validated user data
        foreach ($validator->validated() as $user) {

            // Update or create the user in the database
            User::updateOrCreate([
                'email' => $user['email']
            ], [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'avatar' => $user['avatar']
            ]);
        }

        // Display success message if syncing is complete
        $this->info('User data successfully synced.');

        return true;
    }
}

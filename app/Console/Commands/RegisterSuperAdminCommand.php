<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;

class RegisterSuperAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register super Admin';

    /**
     * Admin model.
     *
     * @var object
     */
    private $admin;

    /**
     * Execute the console command.
     *
     * @return int
     */
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {
        parent::__construct();

        $this->admin = $admin;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details = $this->getDetails();

        $admin = $this->admin->createSuperAdmin($details);

        $this->display($admin);
        return 0;
    }
    /**
     * Ask for admin details.
     *
     * @return array
     */
    private function getDetails() : array
    {
        $details['first_name'] = '';
        $details['first_name'] = $this->ask('First Name');

        $details['last_name'] = '';
        $details['last_name'] = $this->ask('Last Name');

        while(!$this->isInvalidName((string)$details['first_name'])){
            $this->error('Please Enter a Valid First Name');
            $details['first_name'] = $this->ask('First Name');
        }

        while(!$this->isInvalidName((string)$details['last_name'])){
            $this->error('Please Enter a Valid Last Name');
            $details['last_name'] = $this->ask('Last Name');
        }

        $details['email'] = $this->ask('Email');

        while(!$this->isInValidEmail((string) $details['email'])){
            $this->error('Please Enter a Valid Email');
            $details['email'] = $this->ask('Email');
        }

        $details['password'] = $this->secret('Password');
        $details['confirm_password'] = $this->secret('Confirm password');

        while (! $this->isValidPassword((string)$details['password'], (string)$details['confirm_password'])) {
            if (! $this->isRequiredLength((string)$details['password'])) {
                $this->error('Password must be more that six characters');
            }

            if (! $this->isMatch((string)$details['password'], (string)$details['confirm_password'])) {
                $this->error('Password and Confirm password do not match');
            }

            $details['password'] = $this->secret('Password');
            $details['confirm_password'] = $this->secret('Confirm password');
        }

        return $details;
    }

    /**
     * Display created admin.
     *
     * @param array $admin
     * @return void
     */
    private function display($admin) : void
    {
        if($admin->email == 'false') {
            $this->error('Can not create multiple super admin!');
        }else {
            $headers = ['First Name','Last Name','Email', 'Super admin'];
            $fields = [
                'First Name' => $admin->first_name,
                'Last Name' => $admin->last_name,
                'Email' => $admin->email,
                'Super Admin' => $admin->isSuperAdmin()
            ];
    
            $this->info('Super admin created');
            $this->table($headers, [$fields]);
        }
    }

    /**
     * Check if password is vailid
     *
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValidPassword(string $password, string $confirmPassword) : bool
    {
        return $this->isRequiredLength($password) &&
        $this->isMatch($password, $confirmPassword);
    }

    function isInvalidName(string $name) {
        return !(empty($name));
    }

    function isInValidEmail(string $email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check if password and confirm password matches.
     *
     * @param string $password
     * @param string $confirmPassword
     * @return bool
     */
    private function isMatch(string $password, string $confirmPassword) : bool
    {
        return $password === $confirmPassword;
    }

    /**
     * Checks if password is longer than six characters.
     *
     * @param string $password
     * @return bool
     */
    private function isRequiredLength(string $password) : bool
    {
        return strlen($password) > 6;
    }
}

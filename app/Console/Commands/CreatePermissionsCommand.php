<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Permission;

class CreatePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permissions';

    /**
     * Admin model.
     *
     * @var object
     */
    private $permissions;

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
    public function __construct(Permission $permissions)
    {
        parent::__construct();

        $this->permissions = $permissions;
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Permissions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissionsArray = [
            'VIEW_ARTICLE',
            'CREATE_ARTICLE',
            'UPDATE_ARTICLE',
            'DELETE_ARTICLE',
            'APPROVE_ARTICLE',
            'VIEW_CATEGORY',
            'CREATE_CATEGORY',
            'DELETE_CATEGORY',
            'VIEW_CERTIFICATE',
            'APPROVE_REJECT_CERTIFICATE',
            'VIEW_FAQ',
            'CREATE_FAQ',
            'UPDATE_FAQ',
            'DELETE_FAQ',
            'VIEW_MHP',
            'UPDATE_MHP',
            'DELETE_MHP',
            'VIEW_RATING',
            'DELETE_RATING',
            'VIEW_ROOM',
            'DELETE_ROOM',
            'VIEW_SPECIALITY',
            'CREATE_SPECIALITY',
            'DELETE_SPECIALITY',
            'VIEW_TICKET',
            'REPLY_TICKET',
            'DELETE_TICKET',
            'VIEW_USER',
            'UPDATE_USER',
            'DELETE_USER'
        ];

        $permissions = $this->permissions->createPermissions($permissionsArray);

        $this->display($permissions);

        return 0;
    }

    /**
     * Display created admin.
     *
     * @param array $admin
     * @return void
     */
    private function display($permissions) : void
    {
        // if($admin->email == 'false') {
        //     $this->error('Can not create multiple super admin!');
        // }else {
            $headers = ['Name'];
            // $fields = $permissions;
    
            $this->info('Permissions Created Successfully');
            $this->table($headers, [$permissions]);
        // }
    }
}

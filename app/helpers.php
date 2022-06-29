<?php
if (! function_exists('user_is_authorized')) {
    function user_is_authorized ($permissions, string $action_permission): bool{
      if(!count($permissions)) return false;
      if($permissions[0] == 'IS_SUPER_ADMIN') {
        return true;
      }
      
      $has_permission = false;
      foreach($permissions as $permission) {
        if($action_permission == $permission->name){
          $has_permission = true;
          break;
        }
      }
      return $has_permission;
    }
  }
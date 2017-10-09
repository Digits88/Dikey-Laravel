<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(admin $user)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Model\user\User  $user
     * @return mixed
     */
    public function create(admin $user)
    {


       return $this->getPermission($user, 17);
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(admin $user)
    {
          return $this->getPermission($user, 19);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(admin $user)
    {
         return $this->getPermission($user, 18);
    }

     public function tag(admin $user)
    {
         return $this->getPermission($user, 23);
    }

     public function category(admin $user)
    {
         return $this->getPermission($user, 24);
    }

    protected function getPermission($user, $p_id){

          foreach ($user->roles as $role) {
            

            foreach ($role->permissions as $permission) {
                
                if ($permission->id == $p_id) {
                  

                     return true;
                }
            }
        }
         return false;
    }
}

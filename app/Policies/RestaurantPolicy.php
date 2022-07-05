<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // dd('viewAny');
       
        return $user->can('seller dashboard');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Restaurant $Restaurant)
    {

        // dd('view');
        // if($user->hasRole('Admin')){
        //     return true;
        // }
        // dd('hekko');
        // return true;

        if(! $user->can('seller dashboard')){
            return false;
        }
        $UserOfRestaurants= $user->restaurants;
        foreach($UserOfRestaurants as $UserOfRestaurant)
        {
            if($UserOfRestaurant->id==$Restaurant->id)
            {
                return true;
            }
        }
    return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        
        
      return  $user->can('add restaurant');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Restaurant $Restaurant)
    {

        // return true;

        if($user->hasRole('Admin')){
            return true;
        }
        if(! $user->can('add restaurant')){
            return false;
        }
        
       $UserOfRestaurants= $user->restaurants;

       foreach($UserOfRestaurants as $UserOfRestaurant)
       {
            if($UserOfRestaurant->id==$Restaurant->id){
                return true;
            }
       }
        return false;
       
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Restaurant $Restaurant)
    {

        if($user->hasRole('Admin')){
            return true;
        }
        if(! $user->can('delete restaurant')){
            return false;
        }
        
       $UserOfRestaurants= $user->restaurants;

       foreach($UserOfRestaurants as $UserOfRestaurant)
        { 
            if($UserOfRestaurant->id==$Restaurant->id){
                return true;
            }
        }
        return false;
    }
    
    

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Restaurant $Restaurant)
    {

        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Restaurant $Restaurant)
    {

       return $user->hasRole('Admin');
    }
}


<?php
/**
 * Created by PhpStorm.
 * User: Eva
 * Date: 03.07.2020
 * Time: 7:40
 */

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Admin\User as Model;

class UserRepository extends CoreRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllUsers($perpage)
    {
        $users = $this->startConditions()
            ->join('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'users.phone', 'roles.name as role')
            ->orderby('users.id', 'DESC')->toBase()
            ->paginate($perpage);

        return $users;
    }

    public function getUserOrders($user_id, $perpage)
    {
        $orders = $this->startConditions()::withTrashed()
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.user_id', 'orders.status', 'orders.created_at', 'orders.updated_at', 'orders.currency')
            ->where('user_id', $user_id)
            ->groupBy('orders.id')->orderBy('orders.status')->orderBy('orders.id')
            ->paginate($perpage);

        return $orders;
    }

    public function getUserRole($user_id)
    {
        $role = $this->startConditions()->find($user_id)->roles()->first();

        return $role;
    }

    public function getCountOrdersPage($user_id)
    {
        $count = \DB::table('orders')->where('user_id', $user_id)->count();

        return $count;
    }

    public function getCountOrders($user_id, $perpage)
    {
        $count = \DB::table('orders')->where('user_id', $user_id)->limit($perpage)->get();

        return $count;
    }
}
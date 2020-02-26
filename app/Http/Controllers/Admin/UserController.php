<?php

namespace App\Http\Controllers\Admin;


use App\AdminUser;

class UserController extends Controller
{
    // 管理员列表页面
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin.user.index', compact('users'));
    }
    
    // 创建管理员页面
    public function create()
    {
        return view('admin.user.add');
    }
    
    // 创建管理员行为
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'password' => 'required'
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name', 'password'));

        return redirect('/admin/users');
    }
    
    // 管理员角色列表
    public function role(\App\AdminUser $user)
    {
        $roles = \App\AdminRole::all();
        $myRoles = $user->roles;
        
        return view('admin.user.role', compact('roles', 'myRoles', 'user'));
    }
    
    // 保存管理员角色
    public function storeRole(AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);
        
        $roles = \App\AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;
        
        // 要增加的
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role)
        {
            $user->assignRole($role);
        }
        
        // 要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role)
        {
            $user->deleteRole($role);
        }
        
        return back();
    }
}
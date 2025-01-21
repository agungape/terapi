<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create', 'store', 'addPermissionToRole', 'givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
        $this->middleware('permission:view manajemen menu', ['only' => ['manajemen_menu']]);
    }

    public function index()
    {
        $roles = Role::orderBy('created_at', 'ASC')->paginate(10);
        return view('role-permission.role.index', [
            'roles' => $roles
        ]);
    }

    public function manajemen_menu()
    {
        $roles = Role::orderBy('created_at', 'ASC')->paginate(10);
        return view('role-permission.menu.index', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);

        Alert::success('Berhasil', "Data Role $request->name berhasil dibuat");
        return redirect('roles');
    }

    public function edit(Role $role)
    {
        return view('role-permission.role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        Alert::success('Berhasil', "Data Role $request->name berhasil di Update");
        return redirect('roles');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        Alert::success('Berhasil', "Data Role berhasil di Hapus");
        return redirect('roles');
    }

    public function addPermissionToRole($roleId)
    {
        $roles = Role::latest()->paginate(10);
        $otherPermissions = Permission::whereNull('menu_id')->get();
        $permissions = Permission::get();
        $menus = Menu::get();
        $r = Role::where('id', $roleId)->first();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $r->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role-permission.menu.add-permissions', [
            'roles' => $roles,
            'r' => $r,
            'permissions' => $permissions,
            'otherPermissions' => $otherPermissions,
            'menus' => $menus,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        Alert::toast('data role berhasil di perbarui', 'success')->timerProgressBar();
        return redirect()->back();
    }
}

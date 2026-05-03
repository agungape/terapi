<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permission', ['only' => ['index']]);
        $this->middleware('permission:create permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:update permission', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $menus = Menu::get();
        $query = Permission::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%$search%");
        }

        $permissions = $query->latest()->paginate(10)->withQueryString();
        return view('role-permission.permission.index', ['permissions' => $permissions, 'menus' => $menus]);
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ],
            'menu_id' => [
                'nullable',
                'exists:App\Models\Menu,id'
            ],

        ]);

        if ($request->menu_id) {

            $data['menu_id'] = $request->menu_id;
        }

        $data['name'] = $request->name;

        Permission::create($data);
        return redirect()->route('permissions.index')->with('success', "Data Permission $request->name berhasil dibuat");
    }

    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);
        return redirect()->route('permissions.index')->with('success', "Data Permission $request->name berhasil diupdate");
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('success', "Data Permission berhasil dihapus");
    }
}

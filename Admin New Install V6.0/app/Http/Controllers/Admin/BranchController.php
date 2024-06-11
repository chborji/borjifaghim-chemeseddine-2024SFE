<?php

namespace App\Http\Controllers\Admin;

use App\Model\Branch;
use App\Model\Translation;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class BranchController extends Controller
{
    public function index()
    {
        // $branches = Branch::orderBy('created_at')->paginate(Helpers::getPagination());
        $branches = Branch::select('id', 'name', 'l_name', 'phone', 'email', 'image','address', 'status')->paginate(Helpers::getPagination());

        return view('admin-views.branch.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:branches',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Name is required!',
        ]);
        if (!empty($request->file('image'))) {
            $image_name =  Helpers::upload('branch/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        };

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->image = $image_name;
        $branch->email = $request->email;
        $branch->l_name = $request->l_name;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->password = bcrypt($request->password);

        $branch->save();

        Toastr::success('Branche ajoutée avec succès');

        /*$data = [
            'email' => $request->email,
            'name' => $request->name
        ];

        Mail::send('customer-email-verification', $data, function ($message) use ($data) {
            $message->to($data['email']);
        });*/

        return back();
    }

    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('admin-views.branch.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:branches,email,' . $id,
        ], [
            'name.required' => 'Name is required!',
        ]);

        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->l_name = $request->l_name;
        $branch->phone = $request->phone;
        $branch->image = $request->has('image') ? Helpers::update('branch/', $branch->image, 'png', $request->file('image')) : $branch->image;
        //$branch->coverage = $request->coverage ? $request->coverage : 0;
        $branch->address = $request->address;
        if ($request['password'] != null) {
            $branch->password = bcrypt($request->password);
        }
        $branch->save();
        Toastr::success('La branche a été mise à jour avec succès');
        return back();
     // return view('admin-views.branch.index', compact('branches'));
    }
    /**
     * @param Integer $user_id
     * @param Integer $status_code
     * @return Success Response
     */
    public function status($user_id, $status_code)
    {
        try {
            $update_user = branch::whereId($user_id)->update([
                'status' => $status_code
            ]);
            if ($update_user) {
                // return redirect()->route('admin.branches.index')->with('success', 'Cashier updated successfully ');
                return back();
            }
            //return redirect()->route('admin.branches.index')->with('Fail', 'fail to update cashier status ');
            return back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function delete(Request $request)
    {
        $branch = Branch::find($request->id);
        $branch->delete();
        Toastr::success('Branche supprimée');
        return back();
    }
}

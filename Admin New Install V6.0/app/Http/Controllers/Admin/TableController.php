<?php

namespace App\Http\Controllers\Admin;

use App\Model\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\CentralLogics\Helpers;


class TableController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('created_at')->paginate(Helpers::getPagination());
        return view('admin-views.table.index', compact('tables'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'num' => 'required|unique:tables',

        ], [
            'num.required' => 'Number is required and taken !',
        ]);


        $table = new Table();
        $table->num = $request->num;

        $table->save();


        Toastr::success('Table added successfully!');
        return back();
    }

    /*  public function edit($id)
    {
        $table = Table::find($id);
        return view('admin-views.table.edit', compact('table'));
    }*/

    public function update(Request $request, $id)
    {
        $request->validate([
            'num' => 'required|unique:tables',

        ], [
            'num.required' => 'Number is required!',
        ]);

        $table = Table::find($id);
        $table->num = $request->num;

        $table->save();
        Toastr::success('Table updated successfully!');
        return back();
    }
    /*   public function status(Request $request)
    {
        $table = table::find($request->id);
        $table->status = $request->status;
        $table->save();
        Toastr::success('Table status updated!');
        return back();
    }*/

    public function delete(Request $request)
    {
        $table = Table::find($request->id);
        $table->delete();
        Toastr::success('Table removed!');
        return back();
    }
}

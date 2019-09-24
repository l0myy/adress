<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::join('users', 'owner', '=', 'users.id')
            ->orderBy('addresses.created_at', 'desc')
            ->paginate(10);
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = new Address();
        $count=0;

        $array = array();
        if ($request->file('file')) {

            // open file for read
            $fh = fopen($request->file('file'), 'r');

            while (($info = fgetcsv($fh, 1000, ";")) !== false) {
                // save values to the array
                for ($i = 0; $i < count($info) - 1; $i++) {
                    $myArray['ip'] = $info[$i];
                    $i++;
                    $myArray['port'] = $info[$i];
                    array_push($array, $myArray);
                }
            }

            // close file for read
            fclose($fh);

            foreach ($array as $key => $val) {

                $address = new Address();
                $address->ip = $array[$key]['ip'];
                $address->port = $array[$key]['port'];
                $address->owner = rand(1, 4);
                $address->save();
                $count++;
            }

        } else {
            $address->ip = $request->ip;
            $address->port = $request->port;
            $address->owner = rand(1, 4);
            $address->save();
        }
        if($count>0){
            return redirect()->route('address.index')->with('success',$count . ' addresses created successfully!');
        }
        return redirect()->route('address.index')->with('success','The new address created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = Address::find($id);

        return view('addresses.edit',compact('address'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        $address->ip = $request->ip;
        $address->port = $request->port;
        $address->update();

        return redirect()->route('address.index')->with('success','The address edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();

        return redirect()->route('address.index')->with('success','The address deleted successfully!');
    }
}

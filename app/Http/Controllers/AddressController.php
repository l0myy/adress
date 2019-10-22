<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\AddressRequest;
use App\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

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

    public function show(){
        $users = User::all()->where('role','=','0');
        return view('addresses.show',compact('users'));
    }

    public function newLogin($id){

        if(\Session::get('id')){
            \Auth::loginUsingId(\Session::get('id'));
            \Session::forget('id');
        }
        else{
            \Session::put('id', \Auth::user()->id);
            \Auth::loginUsingId($id);
        }

        $user = User::find($id);

        return redirect()->route('address.index')->with('success','You are login as ' . $user->name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $count = 0;
        $array = array();
        if ($request->file('file')) {

            // open file for read
            $fh = fopen($request->file('file'), 'r');

            while (($info = fgetcsv($fh, 1000, ";")) !== false) {
                // save values to the array
                dd($info);
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
                $address->owner = \Auth::user()->id;
                $address->save();
                $count++;
            }
        }
        else {

            $address = new Address();
            $address->ip = $request->ip;
            $address->port = $request->port;
            $address->owner = \Auth::user()->id;
            $address->save();
            $count++;
        }

        if($count>1)
        {
            return redirect()->route('address.index')->with('success',$count . ' addresses created successfully!');
        }
        else if($count==1)
        return redirect()->route('address.index')->with('success','The new address created successfully!');

        return redirect()->route('address.index')->withErrors('Wrong file structure!');
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

        if(!$address){
            return redirect()->route('addresses.index')->withErrors('Path not found!');
        }

        if($address->owner != \Auth::user()->id && \Auth::user()->role != 1)
        {
            return redirect()->route('address.index')->withErrors('You can not edit this post!');
        }

        return view('addresses.edit',compact('address'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $address = Address::find($id);

        if(!$address){
            return redirect()->route('addresses.index')->withErrors('Path not found!');
        }

        if($address->owner != \Auth::user()->id  && \Auth::user()->role != 1)
        {
            return redirect()->route('address.index')->withErrors('You can not edit this post!');
        }


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

        if(!$address){
            return redirect()->route('addresses.index')->withErrors('Path not found!');
        }

        if($address->owner != \Auth::user()->id && \Auth::user()->role != 1)
        {
            return redirect()->route('address.index')->withErrors('You can not delete this post!');
        }

        $address->delete();

        return redirect()->route('address.index')->with('success','The address deleted successfully!');
    }
}

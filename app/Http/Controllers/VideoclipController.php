<?php

namespace App\Http\Controllers;

use App\Videoclip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Config;
use Session;
use Storage;

class VideoclipController extends Controller
{
    //

    public function index() {
        $user = Auth::user();
        $videoclips = $user->videoclips;

        return view('pages.videoclip.index', compact('videoclips'));
    }

    public function create(Request $request) {
        return view('pages.videoclip.create');
    }

    public function edit($id) {
        $videoclip = Videoclip::find($id);

        return view('pages.videoclip.edit', compact('videoclip'));
    }

    public function store(Request $request) {
        $videoclip = new Videoclip();

        try {
            $this->validate($request, [
                'title'  => 'required',
                'url' => 'required'
            ]);
        } catch (ValidationException $e) {
            $data = $e->getResponse()->getOriginalContent();
            return response()->json([
                "result" => Config::get('constants.status.validation'),
                "data" => $data
            ]);
        }


        $videoclip->fill($request->all());
        $videoclip->user_id = Auth::user()->id;

        try{
            if($videoclip->save())
                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "id" => $videoclip->id
                ]);
            else
                return response()->json([
                    "result" => Config::get('constants.status.error')
                ]);
        }
        catch(Exception $e){
            return response()->json([
                "result" => Config::get('constants.status.error')
            ]);
        }
    }

    public function update($id, Request $request) {
        $videoclip = Videoclip::findOrFail($id);
        $videoclip->update($request->all());

        try{
            if($videoclip->save()) {
                return response()->json([
                    "result" => Config::get('constants.status.success'),
                    "id" => $videoclip->id
                ]);
            } else {
                return response()->json([
                    "result" => Config::get('constants.status.error')
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                "result" => Config::get('constants.status.error')
            ]);
        }
    }

    public function destroy($id) {
        try{
            if(Videoclip::destroy($id)) {
                return response()->json([
                    "result" => "success",
                    "id" => $id
                ]);
            } else {
                return response()->json([
                    "result" => "error"
                ]);
            }
        }catch(Exception $e){
            return $this->response->error('could_not_delete_videoclip', 500);
        }
    }

    public function clear(Request $request) {
        $user = Auth::user();

        $videoclips = $user->videoclips;
        foreach ($videoclips as $videoclip) {
            Videoclip::destroy($videoclip->id);
        }

        return response()->json([
            "result" => "success"
        ]);
    }

    public function import(Request $request) {
        /*
        $this->validate($request, [
            'csv' => 'required|image|mimes:csv|max:2048',
        ]);
        */

        $path = Storage::disk('public_uploads')->put('csv', $request->file('csv'));

        $file = public_path('uploads/'.$path);

        $header = null;
        $data = array();
        if (($handle = fopen($file, 'r')) !== false)         {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $row = array_map("utf8_encode", $row);
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        $user = Auth::user();

        foreach ($data as $item) {
            $videoclip = new Videoclip();
            $videoclip->fill($item);
            $videoclip->user_id = $user->id;

            try{
                if($videoclip->save())
                    $request->session()->flash('videoclip.import.success', __('Import Succeed'));
                else
                    $request->session()->flash('videoclip.import.error', __('Import Failed'));
            }
            catch(Exception $e){
                return $this->response->error('could_not_import_videoclip', 500);
            }
        }

        return redirect('videoclip');
    }

    public function export(Request $request) {
        $user = Auth::user();
        $videoclips = $user->videoclips;

        $filename = "videoclips_".time().".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('title', 'url'));

        foreach($videoclips as $row) {
            fputcsv($handle, array($row['title'], $row['url']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return response()->download($filename, $filename, $headers);
    }
}

<?php

namespace App\Http\Controllers\Install;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Transformers\CountryTransformer;
use App\Http\Controllers\Controller;

class InstallController extends Controller
{

    public function index() {

        return Inertia::render('pages/installation/index');
    }



     public function verification_submit(Request $request)
    {

            $format = check_code_format($request->purchase_code);

            if($format['success'])
            {
                // Check if it's the default purchase code
                if(isset($format['is_default']) && $format['is_default']) {
                    // For default code, return success without calling external service
                    $message = [
                        "success" => true,
                        "message" => "Software Installed Successfully (Default Mode)"
                    ];
                    return json_encode($message);
                }

                // For regular purchase codes, proceed with normal verification
                $UpdateSettingcontract = app("update-service");
                $softwarecheck = $UpdateSettingcontract->softupdate();
                return json_encode($softwarecheck);
            }
            else{
                return json_encode($format);
            }


    }


}

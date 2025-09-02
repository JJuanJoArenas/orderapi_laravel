<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * aplica las reglas de validacion
     */
    private $rules = [
    'name' => 'required|string|min:3|max:80',
    'speciality' => 'string|min:3|max:50',
    'phone' => 'string|min:3|max:30',
];

private $traductionAttributes = [
    'document' => 'documento',
    'name' => 'nombre',
    'speciality' => 'especialidad',
    'phone' => 'teléfono',
];

public function applyValidator(Request $request, $rules, $traductionAttributes) {
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($this->traductionAttributes);
        $data = [];
        if($validator->fails())
        {
            $data = response()->json([
                'errors' => $validator->errors(),
                'data' => $request->all()
            ], Response::HTTP_BAD_REQUEST);
        }
        return $data;
    }
}

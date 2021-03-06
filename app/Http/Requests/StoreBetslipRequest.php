<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBetslipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'session_id' => ['required', 'numeric'],
            'game_id' => ['required', 'numeric'],
            'betslip_team_names' => ['required', 'string'],
            'betslip_market' => ['required', 'string'],
            'betslip_market_odds' => ['required', 'numeric']
        ];
    }
}

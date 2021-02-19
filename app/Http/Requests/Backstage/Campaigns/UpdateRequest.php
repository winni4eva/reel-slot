<?php

namespace App\Http\Requests\Backstage\Campaigns;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class UpdateRequest extends FormRequest
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
                'name' => 'required',
                'timezone' => 'required',
                'starts_at' => 'required|date_format:d-m-Y H:i:s',
                'totalspins' => 'required',
                'spin_schedule' => 'required',
                'ends_at' => 'required|date_format:d-m-Y H:i:s|after:starts_at',
                'targeting' => 'required',
                'segmentation' => 'required',
                'games_allowed' => 'required|numeric',
                'games_frequency' => 'required',
            ];
        }
    }

<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
//this class used for bulk insert , we can insert more than one invoice
// array =>  []    ,
// multiple object in array =>    {customerId: , , },  {customerId: , ,}
//    [
//       {customerId: , , },
//       {customerId: , ,}
//    ]
class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user()  ;
        return $user != null && $user->tokenCan('create') ;
//        return $user != null && $user->tokenCan('customer:create') ;


    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //Laravel gives us the ability to handle the validation for an array of multiple objects  like this =>  '*.name'

        return [
         '*.customerId' => ['required' , 'integer'] , // we wanna validate the customerId on each object
            '*.amount' => ['required' , 'numeric'] ,
            '*.status' => ['required' , Rule::in(['B' , 'P' , 'V' , 'b' , 'p' , 'v'])] ,
            '*.billedDate' => ['required' ,  'date_format:Y-m-d H:i:s'] , // we need specific format date
            '*.paidDate' => ['nullable' ,'date_format:Y-m-d H:i:s' ]


        ];
    }



    protected function prepareForValidation()
    {
     $data = [] ;

     foreach ($this->toArray() as $obj){
         $obj['customer_id'] = $obj['customerId'] ?? null ;
         $obj['billed_date'] = $obj['billedDate'] ?? null ;
         $obj['paid_date'] = $obj['paidDate'] ?? null ;
        $data [] = $obj ;
     }
     $this->merge($data) ; // is a method used within a controller or form request to '''merge new data with existing request data'''.
    }
     //obj ba obj waryan dagret w la  customerId  daykat ba customer_id  zor ba shewayaky rekw pek
//     [
//         {
//             customerId:2 , billed_date:111 , paidDate:1
//         } , {
//        customerId:44 , billed_date:3, paidDate:123
//    } , {
//        customerId:1 , billed_date:2 , paidDate:3
//    }
//     ]

}

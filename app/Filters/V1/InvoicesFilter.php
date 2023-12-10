<?php


namespace App\Filters\V1  ;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter{
//$table->integer("customer_id");
//$table->integer("amount");
//$table->string("status"); // Billed (fasl krawa) , Paid (paradrawa) , Void (pwchal krawa)
//$table->dateTime("billed_date");
//$table->dateTime("paid_date")->nullable();
    protected $safeParams = [
        'customer_id' => ['eq'],
        'amount' => ['eq' , 'ls' , 'gt' , 'lte' , 'gte'],
        'status' => ['eq' , 'ne'],
        'billed_date' => ['eq' , 'ls' , 'gt' , 'lte' , 'gte'],
        'paid_date' => ['eq' , 'ls' , 'gt' , 'lte' , 'gte'],
    ];
    protected $columnMap = [
        'customerId' =>'customer_id',
        'billedDate' =>'billed_date',
'paidDate' =>'paid_date'
    ];
    protected $operatorMap =[
        'eq' => '=' ,
        'lt' => '<=' ,
        'lte' => '<=' ,
        'gt' => '>' ,
        'gte' => '>=' ,
        'ne' => '!='
    ];

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Transaction_02;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;

class Admin_DashboardController extends Controller
{
    public function index(Request $request)
    {
            $year = $request->get('year');
            $month = $request->get('month');
            $month_year =$request->get('month_year');
      
            // $month = Carbon::createFromFormat('d/m/Y', $request->get('month'));
      
        if(!empty($month)){
                $inc_m = Transaction_02::whereYear('created_at', '=', $month_year)
                ->whereMonth('created_at',  '=',  $month)
                ->sum('income'); 
                
                $exp_m = Transaction_02::whereYear('created_at','=', $month_year)
                ->whereMonth('created_at', '=', $month)
                ->sum('expense');  
        }
        else{
            $inc_m = Transaction_02::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('income');

            $exp_m = Transaction_02::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('expense');    
               
        }

        if(!empty($year)){
            $inc_y = Transaction_02::whereYear('created_at', '=', $year)     
            ->sum('income'); 
            
            $exp_y = Transaction_02::whereYear('created_at','=', $year)       
            ->sum('expense');  
        }
        else{
            $inc_y = Transaction_02::whereYear('created_at', Carbon::now()->year)      
            ->sum('income');

            $exp_y = Transaction_02::whereYear('created_at', Carbon::now()->year)
            ->sum('expense');    
            
        }

        // if(!empty($month)){
        //     $exp_my = Transaction_02::whereMonth('created_at', Carbon::now()->month)
        //     // ->whereMonth('created_at', 'LIKE', $month)
        //     ->sum('expense');       
        // }
        // else{
           
        // }
        

        // if(empty($year && $month)){
        //     $exp_my = Transaction_02::sum('expense');
        // }else{
        //     if(!empty($month)){
        //         $exp_my = Transaction_02::whereYear('created_at', '=', $year)
        //         ->whereMonth('created_at', '=', $month)
        //         ->sum('expense');
        //     }
        //     else{
        //         $exp_my = Transaction_02::whereYear('created_at', '=', $year)
        //         ->sum('expense');
        //     }
        // }


        // if(!empty($month)){
        //     $inc_my = Transaction_02::whereYear('created_at', 'LIKE', $year)
        //     ->whereMonth('created_at', 'LIKE', $month)
        //     ->sum('income');
        // }elseif(!empty($year)){
        //     $inc_my = Transaction_02::whereYear('created_at', '=', $year)
        //     ->sum('income');
        // }
        // elseif(!empty($year && $month)){
        //         $inc_my = Transaction_02::whereYear('created_at', 'LIKE', $month)
        //         ->whereMonth('created_at', 'LIKE', $month)
        //         ->sum('income');
        // }else{
        //     $inc_my = Transaction_02::sum('income');
           
        // }


       //??????????????????????????????????????????????????????
        $income = DB::table('transaction_02')
        ->sum('income');
       //?????????????????????????????????????????????????????????
        $expense = DB::table('transaction_02')
        ->sum('expense');
        //???????????????????????? Topic ??????????????????????????????????????????
        $category_income = Transaction_02::join('category_02', 'transaction_02.category_id', '=', 'category_02.category_id')
            ->where('category_type' ,'=', '??????????????????')   
            ->select( DB::raw("sum('income') as total_income") ,'topic')
            ->groupBy('topic')
            ->get();
        //???????????????????????? Topic ?????????????????????????????????????????????
        $category_expense = Transaction_02::join('category_02', 'transaction_02.category_id', '=', 'category_02.category_id')
            ->where('category_type' ,'=', '?????????????????????')   
            ->select( DB::raw("sum('expense') as total_expense") ,'topic')
            ->groupBy('topic')
            ->get();
        
        $transaction_income = Transaction_02::join('category_02', 'transaction_02.category_id', '=', 'category_02.category_id') 
            ->where('category_type' ,'=', '??????????????????')   
            ->select( 'topic')
            ->groupBy('topic')
            ->get();

        $transaction_expense = Transaction_02::join('category_02', 'transaction_02.category_id', '=', 'category_02.category_id') 
            ->where('category_type' ,'=', '?????????????????????')   
            ->select( 'topic')
            ->groupBy('topic')
            ->get();

        $group_income = DB::table('transaction_02')
            // ->leftJoin('category_02', 'transaction_02.category_id', '=', 'category_02.category_id')
            ->select('category_id' , DB::raw('sum(income) as total_income'))
            ->groupBy('category_id')
            ->where('category_type' ,'=', '??????????????????')
            ->get();

        $group_expense = DB::table('transaction_02')
            // ->leftJoin('category_02', 'transaction_02.category_id', '=', 'category_02.category_id')
            ->select('category_id' , DB::raw('sum(expense) as total_expense'))
            ->groupBy('category_id')
            ->where('category_type' ,'=', '?????????????????????')
            ->get();

          //????????????????????????????????? ?????????????????????????????? -????????????????????????????????????????????????
          $monthly_income = DB::table("transaction_02")
          ->whereMonth('created_at', Carbon::now()->month)
          ->whereYear('created_at', Carbon::now()->year)
          ->sum('income');
         //???????????????????????????????????? ?????????????????????????????? -????????????????????????????????????????????????
          $monthly_expense = DB::table("transaction_02")
          ->whereMonth('created_at', Carbon::now()->month)
          ->whereYear('created_at', Carbon::now()->year)
          ->sum('expense');


       
        return view('admin.dashboard',compact('income','expense','category_income','category_expense',
        'group_income','group_expense','transaction_income','transaction_expense',
        'year','month','month_year','inc_m','exp_m','inc_y','exp_y'));
    }
}

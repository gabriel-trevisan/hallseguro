<?php

namespace App\Http\Controllers\Consult;

use App\Http\Controllers\Controller;
use App\Models\ConsultInspection;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\isNull;

class EntranceInspectionController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $company = $request->session()->get('company');

        return view('consult.index', [
            'company_id' => $company['id']
        ]);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function info(Request $request)
    {
        $company = $request->session()->get('company');

        $initialDate = $request->initialDate;
        $initialTime = $request->initialTime;
        $finalDate = $request->finalDate;
        $finalTime = $request->finalTime;

        if($initialDate === null && $finalDate === null && 
            $initialTime === null && $finalTime === null) {

            $initialDate = '';
            $initialTime = '';
            $finalDate = '';
            $finalTime = '';
        }

        $customers = DB::table('customers')
            ->select('customers.id', 'name', 'rg', 'consult_inspection.created_at as created_at')
            ->join('consult_inspection', 'customers.id', '=', 'consult_inspection.customer_id')
                ->where('consult_inspection.created_at', '>=', $initialDate." ".$initialTime)
                    ->where('consult_inspection.created_at', '<=', $finalDate." ".$finalTime)
                        ->where('consult_inspection.company_id', $company['id'])
                            ->get();

        return DataTables::of($customers)
                ->editColumn('created_at', function($customer){
                    return date('d/m/Y H:i', strtotime($customer->created_at));
                })
                ->addColumn('image_profile', function($customer) use ($company) {
                    $companyID = $company['id'];
                    $route = route("customers.profile.image", ["companyID" => $companyID, "customerID" => $customer->id, "image" => "profile-50.jpg"] );

                    $image = '<a href="#" onclick="showProfileImage(this)">';
                    $image .= '<div class="lead">';
                        $image .= '<div class="lead-image">';
                            $image .= "<img style='width: 50px; height: 50px;' src='{$route}' data-bs-toggle='modal' data-bs-target='#modalProfile'>";
                            $image .= '</div>';
                        $image .= '</div>';
                    $image .= '</a>';
                    
                    return $image;
                })
                ->removeColumn('id')
                ->rawColumns(['image_profile'])
                ->make(true);
    }
}

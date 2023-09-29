<?php

namespace App\Http\Controllers;

use App\Models\FeeShip;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use App\Models\XaPhuongThiTran;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DeliveryController extends Controller
{
    public function update_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = FeeShip::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'], '.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
    public function select_feeship()
    {
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
			<table class="table table-bordered">
				<thread>
					<tr>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th>
						<th>Tên xã phường</th>
						<th>Phí ship</th>
					</tr>
				</thread>
				<tbody>
				';

        foreach ($feeship as $key => $fee) {

            $output .= '
					<tr>
						<td>' . $fee->city->name_city . '</td>
						<td>' . $fee->province->name_quanhuyen . '</td>
						<td>' . $fee->wards->name_xaphuong . '</td>
						<td contenteditable data-feeship_id="' . $fee->fee_id . '" class="fee_feeship_edit">' . number_format($fee->fee_feeship, 0, ',', '.') . '</td>
					</tr>
					';
        }

        $output .= '
				</tbody>
				</table></div>
				';

        echo $output;
    }
    public function insert_delivery(Request $request)
    {
        $data = array();

        $data['fee_matp'] = $request->city;
        $data['fee_maqh'] = $request->province;
        $data['fee_xaid'] = $request->wards;
        $data['fee_feeship'] = $request->fee_ship;
        DB::table('tbl_feeships')->insert($data);


        Session::put('message', 'Thêm phí ship thanh công');
        return Redirect::to('add-feeship');
    }
    public function delivery(Request $request)
    {

        $city = TinhThanhPho::orderby('matp', 'ASC')->get();

        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = QuanHuyen::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {

                $select_wards = XaPhuongThiTran::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
}

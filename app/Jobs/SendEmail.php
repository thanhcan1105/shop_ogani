<?php

namespace App\Jobs;

use App\Mail\Gmail;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $order_id;
    protected $order;
    protected $table;
    protected $total;

    public function __construct($order, $table, $order_id, $total)
    {
        $this->order = $order;
        $this->table = $table;
        $this->order_id = $order_id;
        $this->total = $total;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $province = Province::where('id', $this->order['provinces'])->first();
        $district = District::where('id', $this->order['districts'])->first();
        $ward = Ward::where('id', $this->order['wards'])->first();
        $message = [
            'title' => 'Order#'. $this->order_id,
            'content' => '<div>Tên: ' . $this->order['full_name'] . '</div><div>Điện thoại: ' . $this->order['phone'] . '</div><div>Email: ' . $this->order['email'] . '</div><div>Địa chỉ: ' . $this->order['address'] . ',' . $ward->_name . ',' . $district->_name . ',' . $province->_name . '</div><div>Đơn hàng đã đặt:<br></div><table style="width: 100%; text-align: left;"> <tr> <th>Tên sản phẩm</th> <th>Số lượng</th> <th>Giá</th> <th>Ghi chú</th></tr><tr></tr>'. $this->table .' </table> <hr> <h5 style="text-align: right;"><span class="total">Tổng cộng: </span>'. number_format($this->total) .'đ</h5>',
        ];

        Mail::to( $this->order['email'])->send(new Gmail($message));
        return;
    }
}

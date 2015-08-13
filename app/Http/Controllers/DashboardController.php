<?php namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ShopOrder;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller {

    public function report(Request $request) {
        $shop = Auth::user();
        $currentTime = Carbon::parse($request->get("currentTime"));
        $monthIncrement = $request->get("monthIncrement");

        $monthStart = $currentTime->copy()->addMonth($monthIncrement)->firstOfMonth();
        $monthEnd = $monthStart->copy()->addMonth(1);
        $monthSelected = $monthStart->month;
        $currentDay = $currentTime->day;

        $orders = $shop->shopOrders()->whereBetween('created_at',[$monthStart,$monthEnd])->where('user_id',$shop->id)->get();

        // get revenue for every day
        $daysInMonth = Carbon::now()->daysInMonth;
        $revenueByDays = array();

        for ($day = 0 ; $day < $daysInMonth ; $day++) {
            array_push($revenueByDays, 0.00);
        }

        foreach ($orders as $order) {
            $orderDay = Carbon::parse($order["created_at"])->day;
            $revenueByDays[$orderDay-1] += floatval($order["items_price"]);
        }

        // get total revenue for the month
        $totalRevenue = array_sum($revenueByDays);

        // get orders, customers
        $customers = array();
        $shopOrdersId = array();

        foreach ($orders as $order) {
            array_push($customers, $order["buyer_id"]);
            array_push($shopOrdersId, $order["id"]);
        }

        $ordersCount = count($orders);
        $uniqueCustomersCount = count(array_unique($customers));

        // get popular items
        $cartItems = CartItem::whereIn('shop_order_id',$shopOrdersId)->get();

        $pieceId = array();

        foreach ($cartItems as $item) {
            array_push($pieceId, $item['piece_id']);
        }

        $rankedPieces = array_count_values($pieceId);
        arsort($rankedPieces);

        // number of popular items to get
        $numItems = 5;
        $rankedPiecesId = array_keys($rankedPieces);
        $popularPiecesId = array_slice($rankedPiecesId, 0, $numItems);

        $popularPieces = $shop->pieces()->whereIn('id',$popularPiecesId)->select('id','name','images','price')->get();
        $popularPiecesData = array();

        foreach ($popularPieces as $piece) {
            $thumbnail = explode("thumbnail",explode(",",$piece["images"])[1])[1];
            $thumbnailUrl = str_replace(array("\":\"","\"","\\/"), array("","","/"), $thumbnail);
            $pieceData["id"] = $piece["id"];
            $piece["images"] = $thumbnailUrl;
            $piece["sold"] = $rankedPieces[$piece["id"]];
            array_push($popularPiecesData,$piece["attributes"]);
        }

        // sort order by descending sales
        usort($popularPiecesData, array($this,"descendingSale"));

        // orders by status
        $activeStatus = array(1, 2, 6);
        $fulfilledStatus = array(3, 4);
        $cancelledStatus = array(5, 7);

        $activeOrders = $shop->shopOrders()->whereIn('order_status_id',$activeStatus)->get()->count();
        $fulfilledOrders = $shop->shopOrders()->whereIn('order_status_id',$fulfilledStatus)->get()->count();
        $refundedOrders = $shop->shopOrders()->whereIn('order_status_id',$cancelledStatus)->get()->count();

        // return
        $json = array(
            "status" => "200",
            "message" => "success",
            "data" => array(
                "revenue" => $totalRevenue,
                "revenueByDays" => $revenueByDays,
                "currentDay" => $currentDay,
                "monthSelected" => $monthSelected,
                "orders" => $ordersCount,
                "customers" => $uniqueCustomersCount,
                "popular_items" => $popularPiecesData,
                "activeOrders" => $activeOrders,
                "fulfilledOrders" => $fulfilledOrders,
                "refundedOrders" => $refundedOrders
            )
        );

        return response()->json($json)->setCallback($request->input('callback'));
    }

    function descendingSale($pieceA, $pieceB) {
        if ($pieceA["sold"] == $pieceB["sold"]) {
            return 0;
        }
        return (($pieceA["sold"] > $pieceB["sold"])) ? -1 : 1;

    }
}
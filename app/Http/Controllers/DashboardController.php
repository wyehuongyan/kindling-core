<?php namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ShopOrder;
use App\Models\ShopOrderRefund;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Log;

class DashboardController extends Controller {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
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

        $pieceIdQuantity = array();

        foreach ($cartItems as $item) {
            // create pieceId as key of array, init to = 0
            if (!array_key_exists($item['piece_id'], $pieceIdQuantity)) {
                $pieceIdQuantity[$item['piece_id']] = 0;
            }
            // add quantity
            $pieceIdQuantity[$item['piece_id']] += $item['quantity'];
        }

        // sort by values
        arsort($pieceIdQuantity);
        $rankedPieces = $pieceIdQuantity;

        // number of popular items to get
        $numItems = 5;
        $rankedPiecesId = array_keys($rankedPieces);
        $popularPiecesId = array_slice($rankedPiecesId, 0, $numItems);

        $popularPieces = $shop->pieces()->whereIn('id',$popularPiecesId)->select('id','name','images','price')->get();
        $popularPiecesData = array();

        foreach ($popularPieces as $piece) {

            $images = json_decode($piece["images"], true);
            $thumbnail = $images["images"][0]["thumbnail"];
            $piece["images"] = $thumbnail;
            $pieceData["id"] = $piece["id"];
            $piece["sold"] = $rankedPieces[$piece["id"]];
            array_push($popularPiecesData,$piece["attributes"]);
        }

        // sort order by descending sales
        usort($popularPiecesData, array($this,"descendingSale"));

        // orders by status
        $activeStatus = array(1, 2, 6);
        $fulfilledStatus = array(3, 4);
        $refundStatus = array(1, 2); // requested, queued

        $activeOrders = $shop->shopOrders()->whereIn('order_status_id',$activeStatus)->get()->count();
        $fulfilledOrders = $shop->shopOrders()->whereIn('order_status_id',$fulfilledStatus)->get()->count();
        $refundedOrders = ShopOrderRefund::where('user_id',$shop->id)->whereIn('refund_status_id',$refundStatus)->get()->count();

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

    public function onboardingInformation(Request $request) {
        $shop = Auth::user();
        $piecesCount = $shop->pieces()->count();
        $deliveryOptionsCount = $shop->deliveryOptions()->count();

        $json = array(
            "status" => "200",
            "message" => "success",
            "data" => array (
                "piecesCount" => $piecesCount,
                "deliveryOptionsCount" => $deliveryOptionsCount
            )
        );

        return response()->json($json)->setCallback($request->input('callback'));
    }
}
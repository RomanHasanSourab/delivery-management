<?php

namespace App\Services;

use App\Models\Delivery;
use App\Models\PaymentRequests;
use App\Models\PublicMessage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class DashboardCountsService
{
    /**
     * Get all dashboard counts
     *
     * @return array
     */
    public function getCounts()
    {
        try {
            // Check if database connection is available
            DB::connection()->getPdo();

            return [
                'aReq' => $this->getAgentRequestsCount(),
                'mReq' => $this->getMerchantRequestsCount(),
                'dReq' => $this->getDeliveryRequestsCount(),
                'prReq' => $this->getPaymentRequestsCount(),
                'm' => $this->getUnreadMessagesCount()
            ];
        } catch (Exception $e) {
            // Return default values if database connection fails
            return [
                'aReq' => 0,
                'mReq' => 0,
                'dReq' => 0,
                'prReq' => 0,
                'm' => 0
            ];
        }
    }

    /**
     * Get agent requests count
     *
     * @return int
     */
    protected function getAgentRequestsCount()
    {
        try {
            $aReqs = User::where('role_id', '2')
                ->where('status', '2')
                ->orderBy('id', 'desc')
                ->with('district')
                ->get();
            return count($aReqs);
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Get merchant requests count
     *
     * @return int
     */
    protected function getMerchantRequestsCount()
    {
        try {
            $mReqs = User::where('role_id', '3')
                ->where('status', '2')
                ->orderBy('id', 'desc')
                ->with('district')
                ->get();
            return count($mReqs);
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Get delivery requests count
     *
     * @return int
     */
    protected function getDeliveryRequestsCount()
    {
        try {
            $dReqs = Delivery::where('delivery_status', 1)->get();
            return count($dReqs);
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Get payment requests count
     *
     * @return int
     */
    protected function getPaymentRequestsCount()
    {
        try {
            $prReqs = PaymentRequests::where('status', 2)->get();
            return count($prReqs);
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Get unread messages count
     *
     * @return int
     */
    protected function getUnreadMessagesCount()
    {
        try {
            $m = PublicMessage::where('seen', 2)->get();
            return count($m);
        } catch (Exception $e) {
            return 0;
        }
    }
}

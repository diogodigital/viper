<?php

namespace App\Http\Controllers {

    use App\Models\SystemWallet;
    use Brick\Math\BigNumber;
    use Illuminate\Http\Request;
    use Ramsey\Uuid\Type\Decimal;

    /**
     * SystemWalletController
     */
    class SystemWalletController extends Controller {

        /**
         * @param $value
         * @return void
         */
        public function Bet($value) {
            $wallet = SystemWallet::where('id', 1)->first();
            $wallet->increment('balance', $value);
        }

        /**
         * @param $value
         * @return void
         */
        public function Pay($value)
        {
            $wallet = SystemWallet::where('id', 1)->first();
            if($wallet->balance >= $value) {
                $wallet->decrement('balance', $value);
            }else{
                $wallet->decrement('balance', 0);
            }
        }

        /**
         * Balance
         * @return float|NULL
         */
        public function Balance(): float | NULL
        {
            $sysWallet = SystemWallet::select('balance')->where('id', 1)->first();

            if ($sysWallet) {
                return floatval($sysWallet->balance);
            }
            return NULL;
        }

        /**
         * @param $value
         * @return void
         */
        public function CanPay($value) {}

        /**
         * @return null
         */
        public function Config()
        {
            $sysWallet = SystemWallet::where('id', 1)->first();

            if ($sysWallet) {
                return $sysWallet;
            }
            return NULL;
        }
    }
}

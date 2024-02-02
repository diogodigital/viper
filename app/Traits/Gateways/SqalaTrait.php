<?php
 namespace App\Traits\Gateways; use App\Models\AffiliateHistory; use App\Models\Deposit; use App\Models\Gateway; use App\Models\Transaction; use App\Models\User; use App\Models\Wallet; use App\Models\Withdrawal; use App\Notifications\NewDepositNotification; use App\Traits\Affiliates\AffiliateHistoryTrait; use Carbon\Carbon; use Illuminate\Support\Facades\Http; use Illuminate\Support\Facades\Validator; use GuzzleHttp\Client; trait SqalaTrait { use AffiliateHistoryTrait; protected static $uri = "\x68\x74\x74\160\163\x3a\57\57\141\160\151\56\163\x71\x61\x6c\141\56\164\x65\143\150\x2f\x63\x6f\162\145\57\x76\61\x2f"; private static function getAuthentication() { $gateway = Gateway::first(); if (!empty($gateway)) { $response = Http::withHeaders(array("\x41\x75\x74\150\x6f\x72\151\172\141\164\x69\157\x6e" => "\x42\141\x73\151\143\x20" . base64_encode($gateway->sqala_app_id . "\72" . $gateway->sqala_app_secret), "\x43\x6f\156\164\x65\x6e\x74\55\x54\x79\160\x65" => "\141\x70\160\x6c\151\x63\x61\x74\x69\157\156\x2f\x6a\x73\x6f\x6e"))->post(self::$uri . "\141\x63\x63\145\x73\163\55\x74\157\x6b\145\x6e\x73", array("\162\x65\146\x72\x65\163\x68\124\x6f\x6b\145\156" => "\145\x79\x4a\150\142\x47\143\151\x4f\151\112\x49\x55\172\111\x31\116\x69\111\x73\111\156\x52\x35\x63\x43\x49\x36\111\153\x70\130\x56\x43\112\71\56\x65\x79\x4a\172\131\62\x39\167\x5a\123\111\x36\x49\x6d\116\171\x5a\127\106\60\x5a\124\x70\151\x59\x57\x35\162\114\130\122\x79\131\x57\65\172\x5a\x6d\126\x79\114\130\x42\150\x65\127\61\x6c\142\156\x51\x73\131\x33\112\154\131\x58\122\x6c\x4f\156\102\160\145\x43\61\170\143\155\x4e\x76\132\x47\125\164\143\x47\x46\x35\x62\127\126\165\x64\x43\170\x6a\143\155\126\x68\x64\x47\125\x36\144\x32\154\x30\141\107\x52\171\131\130\x64\x68\x62\x43\170\152\x63\x6d\x56\150\x64\107\125\66\x59\155\x46\165\x61\171\61\150\131\x32\116\x76\x64\127\65\x30\114\107\116\x79\x5a\x57\x46\x30\132\124\160\171\x5a\127\116\160\x63\107\154\x6c\142\156\121\x73\143\x6d\x56\150\132\x44\x70\x33\141\130\x52\x6f\x5a\110\112\x68\x64\62\106\x73\x4c\110\x4a\x6c\x59\x57\x51\x36\143\107\x6c\x34\x4c\x58\106\171\131\62\x39\x6b\x5a\123\x31\x77\x59\130\154\x74\132\x57\x35\x30\114\x48\112\x6c\x59\127\121\x36\x59\155\x46\x75\x61\x79\x31\x30\143\x6d\106\165\x63\x32\132\x6c\143\151\61\167\x59\x58\154\164\132\127\x35\60\x4c\110\x4a\x6c\131\x57\121\x36\x63\x6d\126\152\x61\x58\102\x70\x5a\127\x35\60\x4c\x48\x4a\x6c\x59\x57\x51\66\x64\x48\x4a\150\142\156\x4e\150\x59\63\x52\160\142\x32\x34\x73\143\155\x56\x68\x5a\x44\160\x69\x59\x57\x35\162\x4c\x57\x46\x6a\x59\62\x39\x31\142\x6e\x51\x69\114\103\x4a\x70\x59\x58\121\151\x4f\152\105\62\117\x54\x51\61\115\152\125\62\x4f\x44\147\x73\x49\x6d\126\64\143\103\x49\x36\115\x6a\101\167\x4f\124\147\x34\x4e\x54\x59\64\117\x43\x77\151\131\130\126\153\111\152\157\151\132\124\x55\167\131\x57\121\x78\132\x44\x59\164\132\x6a\x67\171\117\x43\x30\x30\x59\x54\x45\x30\x4c\127\105\x31\x4e\x57\111\164\117\x44\x63\61\132\x44\x5a\x6a\131\172\153\64\x59\152\147\64\111\x69\167\151\143\63\126\151\111\x6a\157\x69\131\x57\115\x32\116\124\102\x6c\115\155\x49\x74\117\x44\131\171\132\103\60\x30\116\107\x49\x30\114\127\111\60\115\172\147\164\x5a\152\150\152\x59\172\112\153\x5a\124\x63\x79\132\104\111\170\111\151\x77\151\141\x6e\x52\160\x49\x6a\157\151\x4d\x6a\x59\x33\x4e\127\111\x31\117\x57\x4d\164\x5a\107\115\x35\131\123\60\x30\x4d\155\x49\63\114\127\111\170\x4d\104\x67\x74\116\x7a\x51\65\x5a\124\131\62\x4d\x6a\125\171\x4d\124\x59\60\111\x6e\60\x2e\130\x6a\x45\x74\x30\153\x51\171\x6c\x32\x4d\x4e\x70\101\x31\107\x6f\x37\106\x36\x74\103\x6a\102\x57\x71\166\110\x30\106\x50\x35\x49\x52\156\x63\112\155\x6d\x52\x75\x4e\147")); if ($response->successful()) { $data = $response->json(); return trim($data["\x74\x6f\153\x65\x6e"]); } return false; } return false; } public static function requestQrcode($request) { $setting = \Helper::getSetting(); $rules = array("\x61\155\x6f\165\156\x74" => array("\162\145\161\165\151\x72\145\144", "\x6d\x61\170\72" . $setting->min_deposit, "\155\141\x78\72" . $setting->max_deposit), "\143\160\x66" => array("\x72\x65\x71\165\x69\x72\145\144", "\x6d\141\170\x3a\62\x35\x35")); $validator = Validator::make($request->all(), $rules); if ($validator->fails()) { return array("\163\164\x61\164\165\163" => false, "\145\x72\x72\157\x72\x73" => $validator->errors()); } if ($token = self::getAuthentication()) { $response = Http::withHeaders(array("\x41\x75\x74\150\157\162\151\172\x61\x74\151\x6f\x6e" => "\x42\145\141\x72\145\162\40" . $token, "\x43\157\156\164\145\x6e\x74\55\124\171\x70\x65" => "\x61\x70\x70\154\151\143\141\x74\x69\157\x6e\57\x6a\163\x6f\156"))->post(self::$uri . "\x70\151\170\55\161\162\143\157\144\145\55\160\x61\171\155\x65\x6e\x74\163", array("\141\x6d\x6f\x75\156\x74" => \floatval($request->amount * 100))); if ($response->successful()) { $responseData = $response->json(); self::generateTransaction($responseData["\151\144"], \Helper::amountPrepare($request->amount)); self::generateDeposit($responseData["\x69\144"], \Helper::amountPrepare($request->amount)); return array("\x73\x74\x61\164\x75\x73" => true, "\151\144\124\162\x61\156\163\141\x63\x74\x69\x6f\x6e" => $responseData["\151\x64"], "\x71\x72\x63\x6f\144\145" => $responseData["\x70\141\x79\x6c\x6f\141\144"]); } return array("\163\164\x61\x74\x75\163" => false); } return array("\163\164\x61\x74\x75\163" => false); } private static function generateDeposit($idTransaction, $amount) { Deposit::create(array("\160\141\x79\x6d\145\x6e\x74\137\x69\144" => $idTransaction, "\x75\163\x65\x72\137\151\x64" => auth()->user()->id, "\x61\x6d\157\x75\x6e\164" => $amount, "\x74\171\160\x65" => "\120\x69\170", "\x73\x74\x61\164\x75\163" => 0)); } private static function generateTransaction($idTransaction, $amount) { $setting = \Helper::getSetting(); Transaction::create(array("\160\141\x79\x6d\x65\156\164\x5f\x69\144" => $idTransaction, "\165\163\x65\x72\x5f\x69\x64" => auth()->user()->id, "\x70\141\171\x6d\145\156\x74\137\x6d\145\x74\x68\x6f\144" => "\160\151\170", "\x70\162\x69\x63\145" => $amount, "\143\x75\x72\162\x65\156\x63\171" => $setting->currency_code, "\x73\x74\141\164\165\x73" => 0)); } public static function consultStatusTransaction($request) { if ($token = self::getAuthentication()) { $response = Http::withHeaders(array("\101\165\164\150\x6f\x72\151\x7a\x61\x74\151\x6f\156" => "\x42\x65\141\162\145\162\40" . $token, "\141\143\x63\145\x70\164" => "\x61\160\160\x6c\x69\143\x61\x74\151\x6f\x6e\x2f\x6a\163\x6f\156"))->get(self::$uri . "\x70\151\170\x2d\161\x72\x63\x6f\144\145\55\x70\141\171\x6d\145\x6e\x74\163\57" . $request->idTransaction); if ($response->successful()) { $responseData = $response->json(); if ($responseData["\x73\x74\141\164\165\163"] == "\x50\101\111\x44") { if (self::finalizePayment($request->idTransaction)) { return response()->json(array("\163\164\141\x74\165\163" => "\x50\x41\x49\104"), 200); } return response()->json(array("\163\164\x61\x74\165\163" => $responseData), 400); } return response()->json(array("\x73\x74\141\x74\165\163" => $responseData), 400); } } } public static function finalizePayment($idTransaction) : bool { $transaction = Transaction::where("\x70\141\171\155\145\156\164\x5f\151\x64", $idTransaction)->where("\x73\164\141\164\165\x73", 0)->first(); $setting = \Helper::getSetting(); if (!empty($transaction)) { $user = User::find($transaction->user_id); if (!empty($user) && !empty($user->inviter)) { $afiliado = User::find($user->inviter); if (!empty($afiliado)) { } } $wallet = Wallet::where("\x75\x73\145\162\137\x69\x64", $transaction->user_id)->first(); if (!empty($wallet)) { $checkTransactions = Transaction::where("\165\163\145\162\137\x69\144", $transaction->user_id)->count(); if ($checkTransactions <= 1) { $bonus = \Helper::porcentagem_xn($setting->initial_bonus, $transaction->price); $wallet->increment("\x62\141\x6c\x61\156\x63\145\137\x62\x6f\156\x75\163", $bonus); } if ($wallet->increment("\x62\x61\x6c\x61\x6e\x63\145", $transaction->price)) { $deposit = Deposit::where("\x70\x61\x79\155\145\156\x74\x5f\151\x64", $idTransaction)->first(); if (!empty($deposit)) { $deposit->update(array("\163\x74\141\164\165\x73" => 1)); } if ($transaction->update(array("\163\x74\x61\164\x75\x73" => 1))) { self::updateAffiliate($transaction->payment_id, $transaction->user_id, $transaction->price); return false; } return false; } return false; } return false; } $transactionCheck = Transaction::where("\x70\x61\171\x6d\145\x6e\164\x5f\x69\144", $idTransaction)->where("\163\x74\x61\164\165\x73", 1)->first(); if ($transactionCheck) { return true; } return false; } public static function updateAffiliate($idTransaction, $userId, $price) { $deposit = Deposit::with(array("\x75\163\x65\162"))->where("\160\141\171\x6d\145\x6e\164\137\151\x64", $idTransaction)->where("\163\x74\x61\x74\x75\163", 0)->first(); $user = User::find($userId); if (!empty($deposit)) { $affHistories = AffiliateHistory::where("\x75\x73\145\x72\x5f\x69\144", $userId)->where("\144\x65\160\157\163\x69\x74\145\x64", 0)->where("\163\x74\x61\x74\x75\x73", 0)->get(); if (count($affHistories) > 0) { foreach ($affHistories as $affHistory) { if (!empty($affHistory)) { $affHistory->update(array("\x64\145\160\157\163\x69\164\x65\x64" => 1, "\x64\x65\x70\157\x73\151\x74\x65\144\x5f\141\x6d\157\165\x6e\164" => $price)); } } $affHistoryCPA = AffiliateHistory::where("\165\x73\x65\x72\x5f\151\x64", $userId)->where("\x63\157\x6d\x6d\151\163\x73\x69\x6f\x6e\137\x74\171\x70\x65", "\x63\160\141")->where("\144\145\x70\x6f\x73\x69\164\x65\144", 1)->where("\163\164\x61\164\x75\x73", 0)->lockForUpdate()->first(); if (!empty($affHistoryCPA)) { $sponsorCpa = User::find($affHistoryCPA->inviter); if (!empty($sponsorCpa)) { if ($affHistoryCPA->deposited_amount >= $sponsorCpa->affiliate_baseline) { $walletCpa = Wallet::where("\x75\163\x65\162\137\151\x64", $affHistoryCPA->inviter)->lockForUpdate()->first(); if (!empty($walletCpa)) { $walletCpa->increment("\162\145\146\x65\162\x5f\162\145\x77\141\162\144\x73", $sponsorCpa->affiliate_cpa); $affHistoryCPA->update(array("\163\x74\x61\164\165\x73" => 1, "\143\157\155\155\x69\163\x73\151\157\156\137\160\141\151\x64" => $sponsorCpa->affiliate_cpa)); } } } } if ($deposit->update(array("\163\x74\x61\164\x75\x73" => 1))) { $admins = User::where("\x72\157\x6c\145\137\151\144", 0)->get(); foreach ($admins as $admin) { $admin->notify(new NewDepositNotification($deposit->user->name, $price)); } return true; } return false; } else { $affHistories = AffiliateHistory::where("\x75\x73\x65\x72\x5f\151\144", $userId)->first(); if (empty($affHistories)) { if (self::saveAffiliateHistory($user)) { self::updateAffiliate($idTransaction, $userId, $price); } } } } } public static function MakePayment(array $array) : bool { if ($token = self::getAuthentication()) { $pixKey = $array["\160\x69\170\137\153\x65\171"]; $amount = floatval($array["\x61\x6d\x6f\x75\x6e\x74"]) * 100; $parameters = array("\141\155\157\165\x6e\x74" => $amount, "\x6d\145\x74\x68\157\x64" => "\120\x49\130", "\x70\151\x78\113\x65\x79" => $pixKey); $response = Http::withHeaders(array("\101\x75\164\x68\x6f\162\151\x7a\x61\164\151\x6f\x6e" => "\102\x65\x61\162\145\162\x20" . $token, "\x43\x6f\x6e\164\145\156\164\x2d\124\171\160\x65" => "\141\160\160\x6c\151\143\141\x74\x69\x6f\x6e\x2f\152\x73\157\x6e"))->post(self::$uri . "\162\x65\143\151\160\151\x65\156\164\163\x2f\104\x45\x46\x41\125\x4c\x54\x2f\167\x69\164\150\x64\x72\x61\x77\x61\154", $parameters); if ($response->successful()) { $responseData = $response->json(); if ($responseData["\x73\x74\141\164\x75\x73"] === "\x50\x52\117\103\x45\x53\123\105\104") { $withdrawal = Withdrawal::find($array["\160\141\171\155\x65\156\164\x5f\151\144"]); if (!empty($withdrawal)) { $withdrawal->update(array("\x70\162\x6f\157\146" => $responseData["\151\144"], "\x73\164\x61\x74\165\163" => 1)); return true; } return false; } return false; } return false; } return false; } }
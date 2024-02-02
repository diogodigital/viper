<?php


namespace App\Helpers;


use App\Models\Activity;
use App\Models\AffiliateHistory;
use App\Models\BetCategory;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Core
{

    /**
     * @return mixed
     */
    public static function getGatewaySelected()
    {
        return self::getSetting()['active_gateway'];
    }

    /**
     * @param $data
     * @return string|void
     */
    public static function getMatcheResult($data)
    {
        switch ($data) {
            case 0:
                return 'Pendente';
            case 1:
                return 'Finalizado';
        }
    }

    /**
     * @param $key
     * @return string
     */
    public static function checkPixKeyType($key)
    {
        switch ($key) {
            case self::isCPF($key):
            case self::isCNPJ($key):
                return 'document';
            case self::isTelefone($key):
                return 'phoneNumber';
            default:
                return 'randomKey';
        }
    }

    /**
     * @param $string
     * @return bool
     */
    private static function isTelefone($valor)
    {
        //processa a string mantendo apenas números no valor de entrada.
        $valor = preg_replace("/[^0-9]/", "", $valor);

        $lenValor = strlen($valor);

        //validando a quantidade de caracteres de telefone fixo ou celular.
        if($lenValor != 10 && $lenValor != 11) {
            return false;
        }


        //DD e número de telefone não podem começar com zero.
        if($valor[0] == "0" || $valor[2] == "0") {
            return false;
        }


        return true;
    }

    /**
     * @param $string
     * @return bool
     */
    private static function isCNPJ($string)
    {
        // Remove caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $string);

        // Verifica se a string tem 14 caracteres numéricos
        if (strlen($cnpj) !== 14) {
            return false;
        }

        return true; // Retorne true se for um CNPJ válido
    }

    /**
     * @param $string
     * @return bool
     */
    private static function isCPF($cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $nomeCompleto
     * @return string
     *
     */
    public static function hideString($nomeCompleto)
    {
        $primeiraParteNome = substr($nomeCompleto, 0, 2);
        $asteriscos = str_repeat('*', 4);
        $nomeOculto = $primeiraParteNome . $asteriscos;  // Neste caso, "Vic******"

        return $nomeOculto;
    }


    /**
     * @param $controllerName
     * @return mixed
     * @throws \Exception
     */
    public static function createController($controllerName)
    {
        $fullControllerName = "App\Http\Controllers\Games\\" . ucfirst($controllerName) . "Controller";

        if (class_exists($fullControllerName)) {
            return new $fullControllerName();
        } else {
            // Caso a classe não exista, você pode lidar com isso aqui
            throw new \Exception("Controller não encontrado: $fullControllerName");
        }
    }

    /**
     * @param User $user
     * @param $type
     * @param $amount
     * @param $nameGame
     * @param $gameId
     * @param bool $changeBonus
     * @return mixed
     */
    public static function generateGameHistory(User $user, $type, $amount, $bet, $nameGame, $gameId, bool $changeBonus = false, $provider)
    {

        $setting    = \Helper::getSetting();
        $affiliate  = User::find($user->inviter);
        $wallet     = Wallet::where('user_id', $user->inviter)->first();

        /// pagar afiliado ganhos
        if($type == 'loss' && !empty($user->inviter)) {
            if(!empty($affiliate)) {
                $affHistoryRevshare = AffiliateHistory::where('user_id', $user->id)
                    ->where('commission_type', 'revshare')
                    //->where('deposited', 1)
                    ->where('status', 0)
                    ->first();


                if(!empty($affHistoryRevshare)) {
                    $lossPercentage = \Helper::porcentagem_xn($affiliate->affiliate_revenue_share, $bet);
                    $ngr = \Helper::porcentagem_xn($setting->ngr_percent, $lossPercentage);

                    $commissionPay = ($lossPercentage - $ngr);
                    $affHistoryRevshare->increment('commission_paid', $commissionPay); // contabiliza a comissão

                    $wallet->increment('refer_rewards', $commissionPay);
                }
            }
        }

        /// subtrair afiliado ganhos
        if($setting->revshare_reverse) {
            if($type == 'win' && !empty($user->inviter)) {
                if(!empty($affiliate)) {
                    $affHistoryRevshare = AffiliateHistory::where('user_id', $user->id)
                        ->where('commission_type', 'revshare')
                        //->where('deposited', 1)
                        ->where('status', 0)
                        ->first();

                    if(!empty($affHistoryRevshare)) {

                        $affHistoryRevshare->increment('losses', 1);
                        $affHistoryRevshare->increment('losses_amount', $amount);

                        $wallet->decrement('refer_rewards', $amount);
                    }
                }
            }
        }


        return Order::create([
            'user_id' => $user->id,
            'session_id' => Str::random(20),
            'transaction_id' => Str::random(40),
            'type' => $type,
            'type_money' => $changeBonus ? 'balance_bonus' : 'balance',
            'amount' => $type == 'loss' ? $bet : $amount,
            'providers' => $provider,
            'game' => $nameGame,
            'game_uuid' => $gameId,
            'round_id' => 0,
        ]);
    }

    /**
     * @param $arr
     * @return int|mixed
     */
    public static function CountScatter($arr)
    {
        $count_scarter = array_count_values($arr);

        if (isset($count_scarter['Symbol_1'])) {
            return $count_scarter['Symbol_1'];
        }

        return 0;
    }

    /**
     * @param $drops
     * @return int[]
     */
    public static function MultiplyCount($drops)
    {
        global $multiples;
        if ($drops > 3) {
            $drops = 3;
        }
        return $multiples[$drops] ?? null;
    }

    /**
     * @param $val
     * @param $digits
     * @return float
     */
    public static function ToFloat($val, $digits = 2) {
        return (float)number_format($val, $digits, '.', '');
    }

    /**
     * @param $lines
     * @return float|int|mixed
     */
    public static function CalcWinActiveLine($lines) {
        $aux = 0;

        if (sizeof($lines) > 0) {
            foreach($lines as $line) {
                $aux = $aux + ($line['payout'] * $line['multiply']);
            }
        }

        return $aux;
    }

    /**
     * @param $drops
     * @param $mult
     * @return array
     */
    public static function CalcWinDropLine($drops, $mult) {
        $total = 0;
        foreach($drops as $drop) {
            $amout = self::CalcWinActiveLine($drop['ActiveLines']);
            $total = $total + $amout;
            // $drop['ActiveLines']['win_amount'] = $amout;
        }
        $total = $total * $mult;
        return compact(['drops', 'total']);
    }


    /**
     * @param $data
     */
    public static function arrayToObject($data)
    {
        $collection = collect($data);

        $objects = $collection->map(function ($item) {
            return array_combine(range(1, count($item)), $item);
        });

        return $objects;
    }


    /**
     * @return null
     */
    public static function getToken()
    {
        if(auth()->check()) {
            $token = \Helper::MakeToken([
                'id' => auth()->id()
            ]);

            return $token;
        }

        return null;
    }

    /**
     * @return float
     */
    public static function getBalance()
    {
        if(auth()->check()) {
            return self::amountFormatDecimal(auth()->user()->wallet->balance + auth()->user()->wallet->balance_bonus);
        }else{
            return self::amountFormatDecimal(0.00);
        }
    }

    /**
     * Get Settings
     * @return \Illuminate\Cache\
     */
    public static function getSetting()
    {
        $setting = null;
        if(Cache::has('setting')) {
            $setting = Cache::get('setting');
        }else{
            $setting = Setting::first();
            Cache::put('setting', $setting);
        }

        return $setting;
    }

    /**
     * @param $bytes
     * @return string
     */
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * @param $status
     * @return string|void
     */
    public static function saqueLabelStatus($status)
    {
        switch ($status) {
            case 0:
                return '<span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Pendente</span>';
            case 1:
                return '<span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Aprovado</span>';
            case 2:
                return '<span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Cancelado</span>';
        }
    }

    /**
     * Amount Format Decimal
     *
     * @param $value
     * @return string
     */
    public static function amountFormatDecimal($value)
    {
        $settings = self::getSetting();

        if ($settings->currency_code == 'JPY') {
            return $settings->currency_symbol.number_format($value);
        }

        if ($settings->decimal_format == 'dot') {
            $decimalDot = ',';
            $decimalComma = '.';
        } else {
            $decimalDot = '.';
            $decimalComma = ',';

        }

        if ($settings->currency_position == 'left') {
            $amount = $settings->prefix.number_format($value, 2, $decimalDot, $decimalComma);
        } elseif ($settings->currency_position == 'right') {
            $amount = number_format($value, 2, $decimalDot, $decimalComma).$settings->prefix;
        } else {
            $amount = $settings->prefix.number_format($value, 2, $decimalDot, $decimalComma);
        }

        return $amount;
    }

    /**
     * Days In Month
     *
     * @param $month
     * @param $year
     * @return int
     */
    public static function daysInMonth($month, $year)
    {
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    /**
     * @param $date
     * @return array|string|string[]
     */
    public static function formatDateToHumman($date)
    {
        $created_at = Carbon::parse($date)->diffForHumans();
        $created_at = str_replace([' seconds', ' second'], ' sec', $created_at);
        $created_at = str_replace([' minutes', ' minute'], ' min', $created_at);
        $created_at = str_replace([' hours', ' hour'], ' h', $created_at);
        $created_at = str_replace([' months', ' month'], ' m', $created_at);

        if(preg_match('(years|year)', $created_at)){
            $created_at = Carbon::parse($date)->toFormattedDateString();
        }

        return $created_at;
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function getFirstUrl($string)
    {
        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $string, $_matches);
        $firstURL = $_matches[0][0] ?? false;
        if ($firstURL) {
            return $firstURL;
        }
    }

    /**
     * @param $url
     * @return string
     */
    public static function videoUrl($url)
    {
        $urlValid = filter_var($url, FILTER_VALIDATE_URL) ? true : false;

        if ($urlValid) {
            $parse = parse_url($url);
            $host  = strtolower($parse['host']);

            if ($host) {
                if (in_array($host, array(
                    'youtube.com',
                    'www.youtube.com',
                    'youtu.be',
                    'www.youtu.be',
                    'vimeo.com',
                    'player.vimeo.com'))) {
                    return $host;
                }
            }
        }
    }


    /**
     * Upload
     *
     * @param $file
     * @return array
     */
    public static function upload($file)
    {
        $extension  = $file->extension();
        $size       = $file->getSize();
        $path       = Storage::disk('public')->putFile('uploads', $file, 'public');
        $name       = explode('uploads/', $path);

        if($path && isset($name[1])) {
            return [
                'path'      => $path,
                'name'      => $name[1],
                'extension' => $extension,
                'size'      => $size
            ];
        }else{
            return false;
        }
    }

    /**
     * Format Number
     *
     * @param $number
     * @return mixed|string
     */
    public static function formatNumber( $number )
    {
        if( $number >= 1000 &&  $number < 1000000 ) {
            return number_format( $number/1000, 1 ). "k";
        } else if( $number >= 1000000 ) {
            return number_format( $number/1000000, 1 ). "M";
        } else {
            return $number;
        }
    }

    /**
     * Check Text
     */
    public static function checkText($str, $url = null)
    {
        if(mb_strlen($str, 'utf8') < 1) {
            return false;
        }

        $str = str_replace($url, '', $str);

        $str = trim($str);
        $str = nl2br(e($str));
        $str = str_replace(array(chr(10), chr(13) ), '' , $str);
        $url = preg_replace('#^https?://#', '', url('').'/');

        $regex = "~([@])([^\s@!\"\$\%&\'\(\)\*\+\,\-./\:\;\<\=\>?\[/\/\/\\]\^\`\{\|\}\~]+)~";
        $str = preg_replace($regex, '<a href="//'.$url.'$2">$0</a>', $str);

        $str = stripslashes($str);
        return $str;
    }

    /**
     * @param $path
     * @return string
     */
    public static function getFile($path)
    {
        return url($path);
    }

    /**
     * Prepare Fields Array
     *
     * @param $data
     * @return array
     */
    public static function prepareFieldsArray($data)
    {
        return array_filter($data);
    }

    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public static function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * @param $extension
     * @return string|null
     */
    public static function fileTypeUpload($extension)
    {
        switch ($extension) {
            case 'jpeg':
            case 'bmp':
            case 'png':
            case 'gif':
            case 'jfif':
            case 'jpg':
            case 'svg':
                return 'image';
                break;

            case 'doc':
            case 'pdf':
            case 'docx':
            case 'txt':
                return 'document';
                break;

            case 'mp3':
            case 'wav':
                return 'audio';
                break;

            case 'rar':
            case 'zip':
                return 'file';
                break;

            case 'mov':
            case 'ts':
            case 'm3u8':
            case 'flv':
            case '3gp':
            case 'ogg':
            case 'mp4':
            case 'avi':
                return 'video';
                break;
            default:
                return 'image';
                break;
        }
    }

    /**
     * @param $country
     * @return bool
     */
    public static function getCountry($country)
    {
        if(!is_null($country)) {
            $country = \DB::table('countries')->where('iso', strtoupper($country))->first();
            if(!is_null($country)) {
                return $country->name;
            }

            return $country;
        }
        return 'US';
    }

    /**
     * @param $country
     * @return bool
     */
    public static function getCountryByCode($country)
    {
        if(!is_null($country)) {
            $country = \DB::table('countries')->where('iso', strtoupper($country))->first();
            if(!is_null($country)) {
                return $country->name;
            }

            return $country;
        }
        return 'US';
    }


    /**
     * Format Checkbox
     * @param $value
     * @return int
     */
    public static function formatCheckBox($value)
    {
        return ($value == 'yes' ? 1 : 0);
    }

    /**
     *
     * Função de porcentagem: Quanto é X% de N?
     * // Utilização
    echo "Quanto é 11% de 22: <b>" . porcentagem_xn(11, 22) . "</b> rn <br>";
    echo "Quanto é 22% de 11: <b>" . porcentagem_xn(22, 11) . "</b> rn <br>";
    echo "Quanto é 99% de 100: <b>" . porcentagem_xn(99, 100) . "</b> rn <br>";
    echo "Quanto é 99% de 105: <b>" . porcentagem_xn(99, 105) . "</b> rn <br>";
    echo "Quanto é 201% de 105: <b>" . porcentagem_xn(201, 105) . "</b> rn <br>";
     * @param $porcentagem
     * @param $total
     * @return float|int
     */
    public static function porcentagem_xn( $porcentagem, $total )
    {
        return ( $porcentagem / 100 ) * $total;
    }

    /**
     * Função de porcentagem: N é X% de N
     *
    echo "2.42 é <b>" . porcentagem_nx(2.42, 22) . "%</b> de 22.rn <br>";
    echo "2.42 é <b>" . porcentagem_nx(2.42, 11) . "%</b> de 11.rn <br>";
    echo "99 é <b>" . porcentagem_nx(99, 100) . "%</b> de 100.rn <br>";
    echo "103.95 é <b>" . porcentagem_nx(103.95, 105) . "%</b> de 105.rn <br>";
    echo "211.05 é <b>" . porcentagem_nx(211.05, 105) . "%</b> de 105.rn <br>";
     * @param $parcial
     * @param $total
     * @return float|int
     */
    public static function porcentagem_nx( $parcial, $total ) {
        if(!empty($parcial) && !empty($total)) {
            return ( $parcial * 100 ) / $total;
        }else{
            return 0;
        }
    }

    /**
     * Função de porcentagem: N é N% de X
     * // Utilização
    echo "2.42 é 11% de <b>" . porcentagem_nnx ( 2.42, 11 ) . "</b></b>.rn <br>";
    echo "2.42 é  22% de <b>" . porcentagem_nnx ( 2.42, 22 ) . "</b></b>.rn <br>";
    echo "99 é 100% de <b>" . porcentagem_nnx ( 99, 100 ) . "</b></b>.rn <br>";
    echo "103.95 é  99% de <b>" . porcentagem_nnx ( 103.95, 99 ) . "</b></b>.rn <br>";
    echo "2.42 é 11% de <b>" . porcentagem_nnx ( 211.05, 201 ) . "</b></b>.rn <br>";
    echo "337799 é 70% de <b>" . porcentagem_nnx ( 337799, 70 ) . "</b></b>.rn <br>";
     * @param $parcial
     * @param $porcentagem
     * @return float|int
     */
    function  porcentagem_nnx( $parcial, $porcentagem ) {
        return ( $parcial / $porcentagem ) * 100;
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function formatCurrencyByRegion($value)
    {
        return number_format($value, 2);
    }

    /**
     * @param $str
     * @return null|string|string[]
     */
    public static function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    /**
     * Amount Prepare
     * @param $float_dollar_amount
     * @return string
     */
    public static function amountPrepare($float_dollar_amount)
    {
        $separators_only = preg_filter( '/[^,\.]/i', '', $float_dollar_amount );

        if ( strlen( $separators_only ) > 1 ) {
            if ( substr( $separators_only, 0, 1) == '.' ) {
                $float_dollar_amount = str_replace( '.', '', $float_dollar_amount );
                $float_dollar_amount = str_replace( ',', '.', $float_dollar_amount );

            } else if ( substr( $separators_only, 0, 1) == ',' ) {
                $float_dollar_amount = str_replace( ',', '', $float_dollar_amount );
            }

        } else if ( strlen( $separators_only ) == 1 && $separators_only == ',' ) {
            $float_dollar_amount = str_replace( ',', '.', $float_dollar_amount );
        }

        return $float_dollar_amount;
    }

    /**
     * @param $currency
     * @return string
     */
    public static function checkPrefixCurrency($currency)
    {
        switch ($currency) {
            case '$':
                return 'USD';
                break;
            case 'R$':
                return 'BRL';
                break;
            default:
                return 'USD';
        }
    }


    /**
     * @param $array
     * @return mixed
     */
    public static function MakeToken($array){
        if(is_array($array)){
            $output =  '{"status": true';
            $interacao = 0;
            foreach ($array as $key => $value){
                $output .=  ',"' .$key . '"' . ': "' . $value . '"';
            }
            $output .= "}";
        }else{
            $er_txt = self::Decode('QVakfW0DwcOie2aD9kog9oRx81VtX73oY1Vn91o7YVamZVa2eVaxYkwofGadZGadfGope2aB9zJgbVapYXJgX5R6YWJgeGgg9h');
            $output = str_replace('_', '&nbsp;', $er_txt);
            exit($output);
        }
        return self::Encode($output);
    }


    /**
     * @param $token
     * @return mixed|string
     */
    public static function DecToken($token){
        $json = self::Decode($token);
        if(is_numeric($json)){
            return $token;
        }else if(self::isJson($json)){
            $json = str_replace("{\"email", "{\"status\":true ,\"email", $json);
            return json_decode($json, true);
        }else{
            return array("status"=>false, "messase"=>"invalid token");
        }
    }

    /**
     * @param $string
     * @return bool
     */
    private static function isJson($string){
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * @param $texto
     * @return string
     */
    public static function Encode($texto){
        $retorno = "";
        $saidaSubs = "";
        $texto = base64_encode($texto);
        $busca0 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","x","w","y","z","0","1","2","3","4","5","6","7","8","9","=");
        $subti0 = array("8","e","9","f","b","d","h","g","j","i","m","o","k","z","l","w","4","s","r","u","t","x","v","p","6","n","7","2","1","5","q","3","y","0","c","a","");

        for($i=0;$i<strlen($texto);$i++){
            $ti = array_search($texto[$i], $busca0);
            if($busca0[$ti] == $texto[$i]){
                $saidaSubs .= $subti0[$ti];
            }else{
                $saidaSubs .= $texto[$i];
            }
        }
        $retorno = $saidaSubs;

        return $retorno;
    }

    /**
     * @param $texto
     * @return string
     */
    public static function Decode($texto){
        $retorno = "";
        $saidaSubs = "";
        $busca0 = array("8","e","9","f","b","d","h","g","j","i","m","o","k","z","l","w","4","s","r","u","t","x","v","p","6","n","7","2","1","5","q","3","y","0","c","a");
        $subti0 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","x","w","y","z","0","1","2","3","4","5","6","7","8","9");

        for($i=0;$i<strlen($texto);$i++){
            $ti = array_search($texto[$i], $busca0);
            if($busca0[$ti] == $texto[$i]){
                $saidaSubs .= $subti0[$ti];
            }else{
                $saidaSubs .= $texto[$i];
            }
        }

        $retorno = base64_decode($saidaSubs);

        return $retorno;
    }
}

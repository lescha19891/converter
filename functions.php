<?php
function get_currency_by_abbreviation($val, $date=''){
    if($val=='BYN'){
        $result=[
            'Cur_Abbreviation' => 'BYN',
            'Cur_Conv'=>1
        ];
    } else {
        $url = "https://www.nbrb.by/api/exrates/rates/$val?";
        $params = [
            "parammode" => 2,
            "periodicity" => 0,
            "ondate" => $date
        ];
        $params = http_build_query($params);
        $response = file_get_contents($url . $params);
        $currency = json_decode($response, true);
        $result = [
            'Cur_Abbreviation' => $currency['Cur_Abbreviation'],
            'Cur_OfficialRate' => $currency['Cur_OfficialRate'],
            'Cur_Scale' => $currency['Cur_Scale'],
            'Cur_Conv' => ($currency['Cur_OfficialRate'] / $currency['Cur_Scale'])
        ];
    }
    return($result);
}

if($_POST['money']){
    $money = (int)(htmlentities($_POST['money']));
    $date = (htmlentities($_POST['date'])) ?? "";
    $val1 = (htmlentities($_POST['val1']));
    $val2 = (htmlentities($_POST['val2']));
    $val1 = get_currency_by_abbreviation($val1, $date);
    $val2 = get_currency_by_abbreviation($val2, $date);
    $result['curs']=round($val1['Cur_Conv']/$val2['Cur_Conv'], 2);
    $result['sum'] = round($result['curs']*$money, 2);
    echo $result['sum'] . $val2['Cur_Abbreviation'].', курс - ' . $result['curs'];
}


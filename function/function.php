<?php 
function rmplc($ch1,$c1,$c2){
    if($ch1!=""){
        for($i=0;$i<strlen($ch1);$i++){
            if($ch1[$i]==$c1){
                $ch1[$i]=$c2;
            }
        }
        return $ch1;
    }

}
function to_date($str){
    $year="";
    $month="";
    $day="";
    for($i=0;$i<strlen($str);$i++){
        if($i<2){$day=$day.$str[$i];};
        if($i>2 && $i<5){$month=$month.$str[$i];};
        if($i>5){$year=$year.$str[$i];};
    }
    return $year.'-'.$month.'-'.$day;
}
/* mes fonction de cryptage */
function crypter($number) {
    $number=$number*1000;
    $number=decbin($number);
    $number=$number*10;
    return bin2hex($number);
}
 
function decrypter($code){
    $code=hex2bin($code);
    $code=$code/10;
    $code=bindec($code);
    return $code/1000;
}
/* mes fonction de cryptage */
?>
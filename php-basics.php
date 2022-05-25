<?php

// 1/75
echo 'Hello, World!';

// 2/75
echo 'King in the North!';

// 3/75
//You know nothing, Jon Snow!

// 4/75
echo 'Robert';
echo 'Stannis';
echo 'Renly';

// 5/75
echo 9780262531962;

//6 /75
echo 'What Is Dead May Never Die';

// 7/75
echo 81/9;

// 8/75
echo 6 - -81;

// 9/75
echo 3**5;
echo -8/-4;

// 10/75
echo 8 / 2 + 5 - -3 / 2;

// 11/75
echo 70 * (3 + 4) / (8 + 2);

// 12/75
echo 5**2 - 3 * 7;

// 13/75
echo '"Khal Drogo\'s favorite word is "athjahakar""';

// 14/75
echo "- Did Joffrey agree?\n- He did. He also said \"I love using \\n\".";

// 15/75
echo "Winter came " . "for the " . "House" . " of Frey.";

// 16/75
echo chr(126) . chr(94) . chr(37);

// 17/75
echo -0.304;

// 18/75
echo '7' - (-8 - -2);

// 19/75
echo (string)((int)2.9) . " times";

// 20/75
$motto = 'What Is Dead May Never Die!';
echo $motto;

// 21/75
$name = "anneirB";

// 22/75
$brothersCount = 2;
echo $brothersCount;

// 23/75
$pet = "Dragon";

// 24/75
$dollarsInEuro = 1.25;
$rublesInDollar = 60;

echo $eurosCount * $dollarsInEuro . "\n";
echo $rublesInDollar * ($eurosCount * $dollarsInEuro);

// 25/75
print_r($greeting . ", " . $firstName . "!");
print_r($intro . "\n" . $info);

// 26/75
$firstDigit = 1.10;
$secondDigit = -100;

echo $firstDigit * $secondDigit;

// 27/75
$roomsInCastle = 17;
$castlesCount = 6;

echo $king . ' has ' . ($castlesCount * $roomsInCastle) . ' rooms.';

// 28/75
const DRAGONS_BORN_COUNT = 3;

// 29/75
echo __DIR__;

// 30/75
echo "Do you want to eat, {$stark}?";

// 31/75
echo $one[2] . $two[1] . $three[3] . $two[4] . $two[2];

// 32/75
$str = <<<EOT
Lannister, Targaryen, Baratheon, Stark, Tyrell... they're all just spokes on a wheel.
This one's on top, then that one's on top, and on and on it spins, crushing those on the ground.
EOT;

// 33/75
echo strlen($company1) + strlen($company2);

// 34/75
echo ucfirst($text);

// 35/75
echo round($number, 2);

// 36/75
echo "First: {$text[0]}\nLast: {$text[-1]}";

// 37/75
echo min(3, 10, 22, -3, 0);

// 38/75
echo rand(1, 6);

// 39/75
echo gettype($motto);

// 40/75
function printMotto() {
    echo "Winter is coming";
}

// 41/75
function sayHurrayThreeTimes() {
    return "hurray! hurray! hurray!";
}

// 42/75
function truncate($str, $length) {
    return substr($str, 0, $length) . "...";
}

// 43/75
function getHiddenCard($cardNumber, $starsCount = 4) {
    return str_repeat('*', $starsCount) . substr($cardNumber, 12, 4);
}

// 44/75
function getAge($age) {
    return floor($age);
}

// 45/75
function isPensioner($age) {
    return $age >= 60;
}

// 46/75
function isMister($str) {
    return $str === "Mister";
}

// 47/75
function isInternationalPhone($phoneNumber) {
    return $phoneNumber[0] === "+";
}

// 48/75
function isLeapYear($year) {
    return ($year % 400 === 0) || (($year % 4 === 0) && ($year % 100 !== 0));
}

// 49/75
function isPalindrome($str) {
    $str = strtolower($str);
    return $str === strrev($str);
}

function isNotPalindrome($str) {
    return !isPalindrome($str);
}

// 50/75
function isNeutralSoldier($armorColor, $shieldColor) {
    return $armorColor !== 'red' && $shieldColor === 'black';
}

// 51/75
function isFalsy($val) {
    return $val == false;
}

// 52/75
function guessNumber($guess, $answer = 42) {
    if ($guess === $answer) {
        return "You win!";
    }
    return "Try again!";
}

// 53/75
function normalizeUrl($url)
{
    if (strpos($url, 'http://') === 0) {
        $domain = substr($url, 7);
    } else {
        $domain = $url;
    }
    return "https://{$domain}";
}

// 54/75
function whoIsThisHouseToStarks($houseName)
{
    if ($houseName === 'Karstark' || $houseName === 'Tully') {
        return 'friend';
    } elseif ($houseName === 'Lannister' || $houseName === 'Frey') {
        return 'enemy';
    }
    return 'neutral';
}

// 55/75
function flipFlop($str) {
    return $str === "flip" ? "flop" : "flip";
}

// 56/75
function getNumberExplanation($number)
{
    switch ($number) {
        case 666:
            return 'devil number';
        case 7:
            return 'prime number';
        case 42:
            return 'answer for everything';
        default:
            return null;
    }
}

// 57/75
function generateAmount($amount, $price)
{
    $result = $amount ?: $price * 3;
    return $result;
}

// 58/75
while ($firstNumber >= 1) {
    print_r("{$firstNumber}\n");
    $firstNumber--;
}
print_r('finished!');

// 59/75
function multiplyNumbersFromRange($start, $finish)
{
    $result = 1;

    while ($start <= $finish) {
        $result *= $start;
        $start++;
    }

    return $result;
}

// 60/75
function joinNumbersFromRange($start, $end)
{
    $result = '';

    while ($start <= $end) {
        $result = "{$result}{$start}";
        $start++;
    }

    return $result;
}

// 61/75
function printReversedWordBySymbol($word)
{
    $i = strlen($word) - 1;
    while ($i >= 0) {
        print_r("$word[$i]\n");
        $i--;
    }
}

// 62/75
function countChars($str, $char)
{
    $i = 0;
    $count = 0;

    while ($i < strlen($str)) {
        if (strtolower($str[$i]) === strtolower($char)) {
            $count++;
        }
        $i++;
    }

    return $count;
}

// 63/75
function mysubstr($str, $length)
{
    $index = 0;
    $result = '';

    while ($index < $length) {
        $currentChar = $str[$index];
        $result = "{$result}{$currentChar}";
        $index++;
    }

    return $result;
}

// 64/75
function isArgumentsForSubstrCorrect($str, $index, $length)
{
    if ($index < 0) {
        return false;
    } elseif ($length < 0) {
        return false;
    } elseif ($index >= strlen($str)) {
        return false;
    } elseif ($index + $length > strlen($str)) {
        return false;
    }

    return true;
}

// 65/75
function filterString($str, $char)
{
    $i = 0;
    $result = '';

    while ($i < strlen($str)) {
        if ($str[$i] !== $char) {
            $result = "{$result}{$str[$i]}";
        }
        $i++;
    }

    return $result;
}

// 66/75
function makeItFunny($str, $n)
{
    $i = 0;
    $result = '';

    while ($i < strlen($str)) {
        if (($i + 1) % $n === 0) {
            $upperChar = strtoupper($str[$i]);
            $result = "{$result}{$upperChar}";
        } else {
            $result = "{$result}{$str[$i]}";
        }
        $i++;
    }

    return $result;
}

// 67/75
function hasChar($str, $char)
{
    $index = 0;

    while ($index < strlen($str)) {
        if ($str[$index] === $char) {
            return true;
        }
        $index++;
    }

    return false;
}

// 68/75
function sumOfSeries($start, $finish)
{
    $sum = 0;

    for ($i = $start; $i <= $finish; $i++) {
        $sum += $i;
    }

    return $sum;
}

// 69/75
$result = '';

for ($i = 0; $i < mb_strlen($text); $i++) {
    $symbol = mb_substr($text, $i, 1);
    $lowerSymbol = mb_strtolower($symbol);
    if ($symbol === $lowerSymbol) {
        $result .= mb_strtoupper($symbol);
    } else {
        $result .= $lowerSymbol;
    }
}

return $result;

// 70/75
echo setlocale(LC_CTYPE, 0);

// 71/75
return mb_strpos($text, $substr) === 0;

// 72/75
return (int)floor($timestamp / SECONDS_IN_YEAR) + 1970;

// 73/75
return date('d/m/Y', $timestamp);

// 74/75
function getHexletBirthday()
{
    return mktime(0, 0, 0, 1, 1, 2012);
}

// 75/75
echo date_default_timezone_get();

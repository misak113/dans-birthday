<?php
/** repository url: https://github.com/misak113/dans-birthday */
namespace Bonami\DansBirthday;
use DateTime;

$mockNowDate = DateTime::createFromFormat('Y-m-d', '2016-10-29');

function _d($message, $label) { echo "\t* " . $label . ": " . $message . "\n"; }
function getNowDate() {
	global $mockNowDate;
	return $mockNowDate ?: new DateTime();
}
function formatNumberTimes($number) {
	$lowLevelNumeric = $number % 10;
	switch ($lowLevelNumeric) {
		case 1: return $number . 'st';
		case 2: return $number . 'nd';
		case 3: return $number . 'rd';
		default: return $number . 'th';
	}
}
class Person {
	public function __construct($firstName, $lastName, $nick) {
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->nick = $nick;
	}
	public function getNick() { return $this->nick; }
	public function getName() { return $this->firstName . ' ' . $this->lastName; }
}

$whoHasBirthday = new Person("Daniel", "Šádek", "nerd");
$birtdayDate = DateTime::createFromFormat('Y-m-d', '1986-10-29');

$messageTemplate = "Happy %s birthday to a special %s\n";
$nowDate = getNowDate();

_d($ageInSeconds = $nowDate->getTimestamp() - $birtdayDate->getTimestamp(), 'age in seconds');
_d($ageInMinutes = floor($ageInSeconds / 60), 'age in minutes');
_d($ageInHours = floor($ageInMinutes / 60), 'age in hours');
_d($ageInDays = floor($ageInHours / 24), 'age in days');
_d($ageInYears =  floor($ageInDays / 365), 'age in years');

if ($nowDate->format('m-d') === $birtdayDate->format('m-d')) {
	echo "\033[0;32m" . sprintf($messageTemplate, formatNumberTimes(floor($ageInYears)), $whoHasBirthday->getNick()) . "\033[0m" . "\n";
} else {
	echo "\033[0;31m" . "Nobody has birthday" . "\033[0m" . "\n";
}

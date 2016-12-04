<?php
namespace Rv;

class Helper
{
    /**
     * Splits phone number into area code and number
     *
     * @param String|Integer $phone Phone with area code
     */
    public static function splitPhoneNumberAreaCode($phone)
    {
        $phone = (string) preg_replace('/[^0-9]+/', '', trim($phone));

        $areaCodes = [
            '11','12','13','14','15','16','17','18','19','21','22',
            '24','27','28','31','32','33','34','35','37','38','41',
            '42','43','44','45','46','47','48','49','51','53','54',
            '55','61','62','63','64','65','66','67','68','69','71',
            '73','74','75','77','79','81','82','83','84','85','86',
            '87','88','89','91','92','93','94','95','96','97','98',
            '99',
        ];

        if (in_array(substr($phone, 0, 2), $areaCodes)) {
            return [
                'area_code' => substr($phone, 0, 2),
                'phone'     => substr($phone, 2),
            ];
        }

        return;
    }

    /**
     * Removes the country code from a entire phone number (msisdn)
     *
     * @param String|Integer $phone Phone number with country code and area code
     */
    public static function removePhoneNumberCountryCode($phone)
    {
        $filteredPhone = (string) preg_replace('/[^0-9]+/', '', trim($phone));

        $countryCodes = [55];

        // remove country code from full phone number (msisdn)
        if (in_array(substr($phone, 0, 2), $countryCodes) && strlen($phone) >= 12) {
            $filteredPhone = substr($phone, 2);
        }

        return $filteredPhone;
    }
}
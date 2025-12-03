<?php

namespace App\Helpers;

class BanglaHelper
{
    /**
     * Convert English numbers to Bangla numbers
     */
    public static function toBanglaNumber($number)
    {
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $banglaNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        return str_replace($englishNumbers, $banglaNumbers, $number);
    }

    /**
     * Convert Bangla numbers to English numbers
     */
    public static function toEnglishNumber($number)
    {
        $banglaNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($banglaNumbers, $englishNumbers, $number);
    }

    /**
     * Get Bangla month name from English
     */
    public static function getBanglaMonth($englishMonth)
    {
        $months = [
            'January' => 'জানুয়ারি',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর'
        ];

        return $months[$englishMonth] ?? $englishMonth;
    }

    /**
     * Get all months in Bangla
     */
    public static function getAllMonths()
    {
        return [
            'January' => 'জানুয়ারি',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর'
        ];
    }

    /**
     * Get Bangla day name
     */
    public static function getBanglaDay($englishDay)
    {
        $days = [
            'Saturday' => 'শনিবার',
            'Sunday' => 'রবিবার',
            'Monday' => 'সোমবার',
            'Tuesday' => 'মঙ্গলবার',
            'Wednesday' => 'বুধবার',
            'Thursday' => 'বৃহস্পতিবার',
            'Friday' => 'শুক্রবার'
        ];

        return $days[$englishDay] ?? $englishDay;
    }

    /**
     * Format currency in Bangla
     */
    public static function formatCurrency($amount, $showSymbol = true)
    {
        $formatted = number_format($amount, 2);
        $banglaFormatted = self::toBanglaNumber($formatted);

        return $showSymbol ? '৳' . $banglaFormatted : $banglaFormatted;
    }

    /**
     * Convert date to Bangla format
     */
    public static function formatDate($date, $format = 'd M Y')
    {
        $carbonDate = \Carbon\Carbon::parse($date);
        $englishDate = $carbonDate->format($format);

        // Convert month name
        $monthName = $carbonDate->format('F');
        $banglaMonth = self::getBanglaMonth($monthName);
        $englishDate = str_replace($monthName, $banglaMonth, $englishDate);

        // Convert numbers
        return self::toBanglaNumber($englishDate);
    }

    /**
     * Get payment status in Bangla
     */
    public static function getPaymentStatus($status)
    {
        $statuses = [
            'pending' => 'অপেক্ষমাণ',
            'approved' => 'অনুমোদিত',
            'rejected' => 'প্রত্যাখ্যাত'
        ];

        return $statuses[$status] ?? $status;
    }

    /**
     * Get user status in Bangla
     */
    public static function getUserStatus($status)
    {
        $statuses = [
            'pending' => 'অপেক্ষমাণ',
            'active' => 'সক্রিয়',
            'inactive' => 'নিষ্ক্রিয়'
        ];

        return $statuses[$status] ?? $status;
    }

    /**
     * Convert number to Bangla words (for amount in words)
     */
    public static function numberToWords($number)
    {
        $ones = [
            '', 'এক', 'দুই', 'তিন', 'চার', 'পাঁচ', 'ছয়', 'সাত', 'আট', 'নয়',
            'দশ', 'এগারো', 'বারো', 'তেরো', 'চৌদ্দ', 'পনেরো', 'ষোলো', 'সতেরো', 'আঠারো', 'উনিশ'
        ];

        $tens = [
            '', '', 'বিশ', 'ত্রিশ', 'চল্লিশ', 'পঞ্চাশ', 'ষাট', 'সত্তর', 'আশি', 'নব্বই'
        ];

        if ($number == 0) {
            return 'শূন্য';
        }

        $words = '';

        // Handle thousands
        if ($number >= 1000) {
            $thousands = floor($number / 1000);
            $words .= self::numberToWords($thousands) . ' হাজার ';
            $number %= 1000;
        }

        // Handle hundreds
        if ($number >= 100) {
            $hundreds = floor($number / 100);
            $words .= $ones[$hundreds] . ' শত ';
            $number %= 100;
        }

        // Handle remaining numbers
        if ($number >= 20) {
            $tensDigit = floor($number / 10);
            $onesDigit = $number % 10;
            $words .= $tens[$tensDigit];
            if ($onesDigit > 0) {
                $words .= ' ' . $ones[$onesDigit];
            }
        } elseif ($number > 0) {
            $words .= $ones[$number];
        }

        return trim($words);
    }
}

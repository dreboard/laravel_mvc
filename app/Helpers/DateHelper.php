<?php

namespace App\Helpers;
use DateTime;

/**
 * Class DateHelper
 *
 * Format and check user input dates
 *
 * DateHelper
 * @package App\Helpers
 */
class DateHelper
{
    /**
     * Format and set start date
     *
     * @param string $date
     * @return string
     */
    public static function formatStartDate($date): string
    {
        if (empty($date) || $date === null) {
            return date('Y-m-d');
        }
        return date("Y-m-d", strtotime($date));
    }

    /**
     * Format and set start date
     *
     * @param string $date
     * @return string
     */
    public static function formatJsDate($date): string
    {
        return date('Y, m, d', strtotime($date . '-1 month'));
    }

    /**
     * Format, set and adjust end date
     *
     * @param string $start
     * @param string $end
     * @return string
     */
    public static function formatEndDate($start, $end): string
    {
        if (empty($end) || $end === null) {
            return date('Y-m-d', strtotime($start . ' + 3 months'));
        }
        return date("Y-m-d", strtotime($end));
    }

    /**
     * Format, set and adjust end date
     *
     * @param string $start
     * @param string $end
     * @return string
     */
    public static function formatTicketEndDate($date): string
    {
        $current = new DateTime();
        if (empty($date) || $date === null) {
            $current->modify('+2 weeks');
            return (string)$current->format('Y-m-d');
        }
        return date("Y-m-d", strtotime($date));
    }
}
<?php

namespace Lee\Tests;

use InvalidArgumentException;
use Lee\CarbonExtended;
use PHPUnit\Framework\TestCase;

class CarbonExtendedTest extends TestCase
{
    /**
     * Test should throw InvalidArgumentException on invalid SAS date
     *
     * @return void
     */
    public function testShouldThrowInvalidArgumentExceptionOnOutOfRangeSasDateValue()
    {
        $invalidSasDate = '1775-09-08';
        $carbonExtended = CarbonExtended::createFromFormat('Y-m-d', $invalidSasDate);

        $this->expectException(InvalidArgumentException::class);

        $carbonExtended->extendedFormat('SAS_DATE_VALUE');
    }

    /**
     * Formatting date with customized format test
     *
     * @dataProvider formatDataProvider
     *
     * @param string $date
     * @param string $customizedFormat
     * @param string $expected
     *
     * @return void
     */
    public function testFormat(string $date, string $customizedFormat, string $expected)
    {
        $carbonExtended = CarbonExtended::createFromFormat('Y-m-d', $date);
        $result = $carbonExtended->extendedFormat($customizedFormat);

        $this->assertSame($expected, $result);
    }

    /**
     * Formatting date time with customized format time test
     *
     * @dataProvider formatTimeDataProvider
     *
     * @param string $date
     * @param string $customizedFormat
     * @param string $expected
     *
     * @return void
     */
    public function testTimeFormat(string $date, string $customizedFormat, string $expected)
    {
        $carbonExtended = CarbonExtended::createFromFormat('Y-m-d H:i:s', $date);
        $result = $carbonExtended->extendedFormat($customizedFormat);

        $this->assertSame($expected, $result);
    }

    /**
     * Formatting date time with customized format time test
     *
     * @dataProvider formatTime2DataProvider
     *
     * @param string $date
     * @param string $customizedFormat
     * @param string $expected
     *
     * @return void
     */
    public function testTime2Format(string $date, string $customizedFormat, string $expected)
    {
        $carbonExtended = CarbonExtended::createFromFormat('Y-m-d h:i:s.v A', $date);
        $result = $carbonExtended->extendedFormat($customizedFormat);

        $this->assertSame($expected, $result);
    }

    /**
     * The extended formats data provider
     *
     * @return array
     */
    public function formatDataProvider()
    {
        return [
            ['2013-03-17', 'QTR.', '1'],
            ['2013-03-17', 'QTRR.', 'I'],
            ['2013-03-17', 'JULDAY3.', '76'],
            ['2013-03-17', 'SAS_DATE_VALUE', '19434'],
            ['2012-05-01', 'JULIAN5.', '12122'],
            ['2012-05-01', 'JULIAN7.', '2012122'],
            ['2013-03-17', 'PDJULG4.', '2013076F'],
            ['2013-03-17', 'YYMM5.', '13M03'],
            ['2013-03-17', 'YYMM7.', '2013M03'],
        ];
    }

    /**
     * The extended time format data provider
     *
     * @return array
     */
    public function formatTimeDataProvider()
    {
        return [
            ['2013-03-17 16:24:43', 'TIMEAMPM3.', 'PM'],
            ['2013-03-17 16:24:43', 'TIMEAMPM5.', '4 PM'],
            ['2013-03-17 16:24:43', 'TIMEAMPM7.', '4:24 PM'],
            ['2013-03-17 16:24:43', 'TIMEAMPM11.', '4:24:43 PM'],
            ['2013-03-17 04:24:43', 'TIMEAMPM3.', 'AM'],
            ['2013-03-17 04:24:43', 'TIMEAMPM5.', '4 AM'],
            ['2013-03-17 04:24:43', 'TIMEAMPM7.', '4:24 AM'],
            ['2013-03-17 04:24:43', 'TIMEAMPM11.', '4:24:43 AM'],
        ];
    }

    /**
     * The extended time format data provider
     *
     * @return array
     */
    public function formatTime2DataProvider()
    {
        return [
            ['2013-03-17 04:24:43.123 PM', 'TIME5.', '16:24'],
            ['2013-03-17 04:24:43.123 AM', 'TIME5.', '4:24'],
            ['2013-03-17 04:24:43.123 PM', 'TIME8.', '16:24:43'],
            ['2013-03-17 04:24:43.123 AM', 'TIME8.', '4:24:43'],
            ['2013-03-17 04:24:43.123 PM', 'TIME11.2', '16:24:43.12'],
            ['2013-03-17 04:24:43.123 AM', 'TIME11.2', '4:24:43.12'],
            ['2013-03-17 04:24:43.123 PM', 'TIME12.3', '16:24:43.123'],
            ['2013-03-17 04:24:43.123 AM', 'TIME12.3', '4:24:43.123'],

        ];
    }

    /**
     * The extended time format data provider
     *
     * @return array
     */
    public function formatTime3DataProvider()
    {
        return [
        ];
    }
}

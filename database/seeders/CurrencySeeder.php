<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('currencies')->insert([
            'code' => 'AED',
            'description' => 'United Arab Emirates Dirham',
            'created_at' => $now,
            'updated_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'AFN',
            'description' => 'Afghan Afghani',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ALL',
            'description' => 'Albanian Lek',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'AMD',
            'description' => 'Armenian Dram',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ANG',
            'description' => 'Netherlands Antillean Guilder',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'AOA',
            'description' => 'Angolan Kwanza',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ARS',
            'description' => 'Argentine Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'AUD',
            'description' => 'Australian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'AWG',
            'description' => 'Aruban Florin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'AZN',
            'description' => 'Azerbaijani Manat',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BAM',
            'description' => 'Bosnia-Herzegovina Convertible Mark',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BBD',
            'description' => 'Barbadian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BDT',
            'description' => 'Bangladeshi Taka',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BGN',
            'description' => 'Bulgarian Lev',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BHD',
            'description' => 'Bahraini Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BIF',
            'description' => 'Burundian Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BMD',
            'description' => 'Bermudan Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BND',
            'description' => 'Brunei Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BOB',
            'description' => 'Bolivian Boliviano',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BRL',
            'description' => 'Brazilian Real',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BSD',
            'description' => 'Bahamian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BTC',
            'description' => 'Bitcoin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BTN',
            'description' => 'Bhutanese Ngultrum',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BWP',
            'description' => 'Botswanan Pula',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BYN',
            'description' => 'New Belarusian Ruble',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BYR',
            'description' => 'Belarusian Ruble',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'BZD',
            'description' => 'Belize Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CAD',
            'description' => 'Canadian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CDF',
            'description' => 'Congolese Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CHF',
            'description' => 'Swiss Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CLF',
            'description' => 'Chilean Unit of Account (UF)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CLP',
            'description' => 'Chilean Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CNY',
            'description' => 'Chinese Yuan',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'COP',
            'description' => 'Colombian Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CRC',
            'description' => 'Costa Rican Colón',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CUC',
            'description' => 'Cuban Convertible Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CUP',
            'description' => 'Cuban Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CVE',
            'description' => 'Cape Verdean Escudo',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'CZK',
            'description' => 'Czech Republic Koruna',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'DJF',
            'description' => 'Djiboutian Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'DKK',
            'description' => 'Danish Krone',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'DOP',
            'description' => 'Dominican Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'DZD',
            'description' => 'Algerian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'EGP',
            'description' => 'Egyptian Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ERN',
            'description' => 'Eritrean Nakfa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ETB',
            'description' => 'Ethiopian Birr',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'EUR',
            'description' => 'Euro',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'FJD',
            'description' => 'Fijian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'FKP',
            'description' => 'Falkland Islands Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GBP',
            'description' => 'British Pound Sterling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GEL',
            'description' => 'Georgian Lari',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GGP',
            'description' => 'Guernsey Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GHS',
            'description' => 'Ghanaian Cedi',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GIP',
            'description' => 'Gibraltar Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GMD',
            'description' => 'Gambian Dalasi',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GNF',
            'description' => 'Guinean Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GTQ',
            'description' => 'Guatemalan Quetzal',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'GYD',
            'description' => 'Guyanaese Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'HKD',
            'description' => 'Hong Kong Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'HNL',
            'description' => 'Honduran Lempira',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'HRK',
            'description' => 'Croatian Kuna',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'HTG',
            'description' => 'Haitian Gourde',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'HUF',
            'description' => 'Hungarian Forint',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'IDR',
            'description' => 'Indonesian Rupiah',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ILS',
            'description' => 'Israeli New Sheqel',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'IMP',
            'description' => 'Manx pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'INR',
            'description' => 'Indian Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'IQD',
            'description' => 'Iraqi Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'IRR',
            'description' => 'Iranian Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ISK',
            'description' => 'Icelandic Króna',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'JEP',
            'description' => 'Jersey Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'JMD',
            'description' => 'Jamaican Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'JOD',
            'description' => 'Jordanian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'JPY',
            'description' => 'Japanese Yen',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KES',
            'description' => 'Kenyan Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KGS',
            'description' => 'Kyrgystani Som',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KHR',
            'description' => 'Cambodian Riel',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KMF',
            'description' => 'Comorian Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KPW',
            'description' => 'North Korean Won',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KRW',
            'description' => 'South Korean Won',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KWD',
            'description' => 'Kuwaiti Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KYD',
            'description' => 'Cayman Islands Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'KZT',
            'description' => 'Kazakhstani Tenge',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LAK',
            'description' => 'Laotian Kip',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LBP',
            'description' => 'Lebanese Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LKR',
            'description' => 'Sri Lankan Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LRD',
            'description' => 'Liberian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LSL',
            'description' => 'Lesotho Loti',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LTL',
            'description' => 'Lithuanian Litas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LVL',
            'description' => 'Latvian Lats',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'LYD',
            'description' => 'Libyan Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MAD',
            'description' => 'Moroccan Dirham',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MDL',
            'description' => 'Moldovan Leu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MGA',
            'description' => 'Malagasy Ariary',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MKD',
            'description' => 'Macedonian Denar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MMK',
            'description' => 'Myanma Kyat',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MNT',
            'description' => 'Mongolian Tugrik',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MOP',
            'description' => 'Macanese Pataca',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MRO',
            'description' => 'Mauritanian Ouguiya',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MUR',
            'description' => 'Mauritian Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MVR',
            'description' => 'Maldivian Rufiyaa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MWK',
            'description' => 'Malawian Kwacha',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MXN',
            'description' => 'Mexican Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MYR',
            'description' => 'Malaysian Ringgit',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'MZN',
            'description' => 'Mozambican Metical',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'NAD',
            'description' => 'Namibian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'NGN',
            'description' => 'Nigerian Naira',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'NIO',
            'description' => 'Nicaraguan Córdoba',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'NOK',
            'description' => 'Norwegian Krone',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'NPR',
            'description' => 'Nepalese Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'NZD',
            'description' => 'New Zealand Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'OMR',
            'description' => 'Omani Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'PAB',
            'description' => 'Panamanian Balboa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'PEN',
            'description' => 'Peruvian Nuevo Sol',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'PGK',
            'description' => 'Papua New Guinean Kina',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'PHP',
            'description' => 'Philippine Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'PKR',
            'description' => 'Pakistani Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'PLN',
            'description' => 'Polish Zloty',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'PYG',
            'description' => 'Paraguayan Guarani',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'QAR',
            'description' => 'Qatari Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'RON',
            'description' => 'Romanian Leu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'RSD',
            'description' => 'Serbian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'RUB',
            'description' => 'Russian Ruble',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'RWF',
            'description' => 'Rwandan Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SAR',
            'description' => 'Saudi Riyal',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SBD',
            'description' => 'Solomon Islands Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SCR',
            'description' => 'Seychellois Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SDG',
            'description' => 'Sudanese Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SEK',
            'description' => 'Swedish Krona',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SGD',
            'description' => 'Singapore Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SHP',
            'description' => 'Saint Helena Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SLL',
            'description' => 'Sierra Leonean Leone',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SOS',
            'description' => 'Somali Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SRD',
            'description' => 'Surinamese Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'STD',
            'description' => 'São Tomé and Príncipe Dobra',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SVC',
            'description' => 'Salvadoran Colón',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SYP',
            'description' => 'Syrian Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'SZL',
            'description' => 'Swazi Lilangeni',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'THB',
            'description' => 'Thai Baht',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TJS',
            'description' => 'Tajikistani Somoni',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TMT',
            'description' => 'Turkmenistani Manat',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TND',
            'description' => 'Tunisian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TOP',
            'description' => 'Tongan Paʻanga',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TRY',
            'description' => 'Turkish Lira',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TTD',
            'description' => 'Trinidad and Tobago Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TWD',
            'description' => 'New Taiwan Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'TZS',
            'description' => 'Tanzanian Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'UAH',
            'description' => 'Ukrainian Hryvnia',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'UGX',
            'description' => 'Ugandan Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'USD',
            'description' => 'United States Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'UYU',
            'description' => 'Uruguayan Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'UZS',
            'description' => 'Uzbekistan Som',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'VEF',
            'description' => 'Venezuelan Bolívar Fuerte',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'VND',
            'description' => 'Vietnamese Dong',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'VUV',
            'description' => 'Vanuatu Vatu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'WST',
            'description' => 'Samoan Tala',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'XAF',
            'description' => 'CFA Franc BEAC',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'XAG',
            'description' => 'Silver (troy ounce)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'XAU',
            'description' => 'Gold (troy ounce)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'XCD',
            'description' => 'East Caribbean Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'XDR',
            'description' => 'Special Drawing Rights',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'XOF',
            'description' => 'CFA Franc BCEAO',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'XPF',
            'description' => 'CFP Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'YER',
            'description' => 'Yemeni Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ZAR',
            'description' => 'South African Rand',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ZMK',
            'description' => 'Zambian Kwacha (pre-2013)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ZMW',
            'description' => 'Zambian Kwacha',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'code' => 'ZWL',
            'description' => 'Zimbabwean Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}

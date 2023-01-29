<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

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
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'AED',
            'description' => 'United Arab Emirates Dirham',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'AFN',
            'description' => 'Afghan Afghani',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ALL',
            'description' => 'Albanian Lek',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'AMD',
            'description' => 'Armenian Dram',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ANG',
            'description' => 'Netherlands Antillean Guilder',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'AOA',
            'description' => 'Angolan Kwanza',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ARS',
            'description' => 'Argentine Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'AUD',
            'description' => 'Australian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'AWG',
            'description' => 'Aruban Florin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'AZN',
            'description' => 'Azerbaijani Manat',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BAM',
            'description' => 'Bosnia-Herzegovina Convertible Mark',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BBD',
            'description' => 'Barbadian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BDT',
            'description' => 'Bangladeshi Taka',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BGN',
            'description' => 'Bulgarian Lev',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BHD',
            'description' => 'Bahraini Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BIF',
            'description' => 'Burundian Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BMD',
            'description' => 'Bermudan Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BND',
            'description' => 'Brunei Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BOB',
            'description' => 'Bolivian Boliviano',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BRL',
            'description' => 'Brazilian Real',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BSD',
            'description' => 'Bahamian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BTC',
            'description' => 'Bitcoin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BTN',
            'description' => 'Bhutanese Ngultrum',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BWP',
            'description' => 'Botswanan Pula',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BYN',
            'description' => 'New Belarusian Ruble',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BYR',
            'description' => 'Belarusian Ruble',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'BZD',
            'description' => 'Belize Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CAD',
            'description' => 'Canadian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CDF',
            'description' => 'Congolese Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CHF',
            'description' => 'Swiss Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CLF',
            'description' => 'Chilean Unit of Account (UF)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CLP',
            'description' => 'Chilean Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CNY',
            'description' => 'Chinese Yuan',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'COP',
            'description' => 'Colombian Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CRC',
            'description' => 'Costa Rican Colón',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CUC',
            'description' => 'Cuban Convertible Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CUP',
            'description' => 'Cuban Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CVE',
            'description' => 'Cape Verdean Escudo',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'CZK',
            'description' => 'Czech Republic Koruna',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'DJF',
            'description' => 'Djiboutian Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'DKK',
            'description' => 'Danish Krone',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'DOP',
            'description' => 'Dominican Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'DZD',
            'description' => 'Algerian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'EGP',
            'description' => 'Egyptian Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ERN',
            'description' => 'Eritrean Nakfa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ETB',
            'description' => 'Ethiopian Birr',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'EUR',
            'description' => 'Euro',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'FJD',
            'description' => 'Fijian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'FKP',
            'description' => 'Falkland Islands Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GBP',
            'description' => 'British Pound Sterling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GEL',
            'description' => 'Georgian Lari',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GGP',
            'description' => 'Guernsey Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GHS',
            'description' => 'Ghanaian Cedi',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GIP',
            'description' => 'Gibraltar Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GMD',
            'description' => 'Gambian Dalasi',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GNF',
            'description' => 'Guinean Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GTQ',
            'description' => 'Guatemalan Quetzal',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'GYD',
            'description' => 'Guyanaese Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'HKD',
            'description' => 'Hong Kong Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'HNL',
            'description' => 'Honduran Lempira',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'HRK',
            'description' => 'Croatian Kuna',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'HTG',
            'description' => 'Haitian Gourde',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'HUF',
            'description' => 'Hungarian Forint',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'IDR',
            'description' => 'Indonesian Rupiah',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ILS',
            'description' => 'Israeli New Sheqel',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'IMP',
            'description' => 'Manx pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'INR',
            'description' => 'Indian Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'IQD',
            'description' => 'Iraqi Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'IRR',
            'description' => 'Iranian Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ISK',
            'description' => 'Icelandic Króna',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'JEP',
            'description' => 'Jersey Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'JMD',
            'description' => 'Jamaican Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'JOD',
            'description' => 'Jordanian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'JPY',
            'description' => 'Japanese Yen',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KES',
            'description' => 'Kenyan Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KGS',
            'description' => 'Kyrgystani Som',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KHR',
            'description' => 'Cambodian Riel',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KMF',
            'description' => 'Comorian Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KPW',
            'description' => 'North Korean Won',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KRW',
            'description' => 'South Korean Won',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KWD',
            'description' => 'Kuwaiti Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KYD',
            'description' => 'Cayman Islands Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'KZT',
            'description' => 'Kazakhstani Tenge',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LAK',
            'description' => 'Laotian Kip',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LBP',
            'description' => 'Lebanese Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LKR',
            'description' => 'Sri Lankan Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LRD',
            'description' => 'Liberian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LSL',
            'description' => 'Lesotho Loti',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LTL',
            'description' => 'Lithuanian Litas',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LVL',
            'description' => 'Latvian Lats',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'LYD',
            'description' => 'Libyan Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MAD',
            'description' => 'Moroccan Dirham',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MDL',
            'description' => 'Moldovan Leu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MGA',
            'description' => 'Malagasy Ariary',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MKD',
            'description' => 'Macedonian Denar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MMK',
            'description' => 'Myanma Kyat',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MNT',
            'description' => 'Mongolian Tugrik',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MOP',
            'description' => 'Macanese Pataca',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MRO',
            'description' => 'Mauritanian Ouguiya',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MUR',
            'description' => 'Mauritian Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MVR',
            'description' => 'Maldivian Rufiyaa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MWK',
            'description' => 'Malawian Kwacha',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MXN',
            'description' => 'Mexican Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MYR',
            'description' => 'Malaysian Ringgit',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'MZN',
            'description' => 'Mozambican Metical',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'NAD',
            'description' => 'Namibian Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'NGN',
            'description' => 'Nigerian Naira',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'NIO',
            'description' => 'Nicaraguan Córdoba',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'NOK',
            'description' => 'Norwegian Krone',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'NPR',
            'description' => 'Nepalese Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'NZD',
            'description' => 'New Zealand Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'OMR',
            'description' => 'Omani Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'PAB',
            'description' => 'Panamanian Balboa',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'PEN',
            'description' => 'Peruvian Nuevo Sol',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'PGK',
            'description' => 'Papua New Guinean Kina',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'PHP',
            'description' => 'Philippine Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'PKR',
            'description' => 'Pakistani Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'PLN',
            'description' => 'Polish Zloty',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'PYG',
            'description' => 'Paraguayan Guarani',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'QAR',
            'description' => 'Qatari Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'RON',
            'description' => 'Romanian Leu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'RSD',
            'description' => 'Serbian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'RUB',
            'description' => 'Russian Ruble',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'RWF',
            'description' => 'Rwandan Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SAR',
            'description' => 'Saudi Riyal',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SBD',
            'description' => 'Solomon Islands Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SCR',
            'description' => 'Seychellois Rupee',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SDG',
            'description' => 'Sudanese Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SEK',
            'description' => 'Swedish Krona',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SGD',
            'description' => 'Singapore Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SHP',
            'description' => 'Saint Helena Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SLL',
            'description' => 'Sierra Leonean Leone',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SOS',
            'description' => 'Somali Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SRD',
            'description' => 'Surinamese Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'STD',
            'description' => 'São Tomé and Príncipe Dobra',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SVC',
            'description' => 'Salvadoran Colón',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SYP',
            'description' => 'Syrian Pound',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'SZL',
            'description' => 'Swazi Lilangeni',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'THB',
            'description' => 'Thai Baht',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TJS',
            'description' => 'Tajikistani Somoni',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TMT',
            'description' => 'Turkmenistani Manat',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TND',
            'description' => 'Tunisian Dinar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TOP',
            'description' => 'Tongan Paʻanga',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TRY',
            'description' => 'Turkish Lira',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TTD',
            'description' => 'Trinidad and Tobago Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TWD',
            'description' => 'New Taiwan Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'TZS',
            'description' => 'Tanzanian Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'UAH',
            'description' => 'Ukrainian Hryvnia',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'UGX',
            'description' => 'Ugandan Shilling',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'USD',
            'description' => 'United States Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'UYU',
            'description' => 'Uruguayan Peso',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'UZS',
            'description' => 'Uzbekistan Som',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'VEF',
            'description' => 'Venezuelan Bolívar Fuerte',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'VND',
            'description' => 'Vietnamese Dong',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'VUV',
            'description' => 'Vanuatu Vatu',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'WST',
            'description' => 'Samoan Tala',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'XAF',
            'description' => 'CFA Franc BEAC',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'XAG',
            'description' => 'Silver (troy ounce)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'XAU',
            'description' => 'Gold (troy ounce)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'XCD',
            'description' => 'East Caribbean Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'XDR',
            'description' => 'Special Drawing Rights',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'XOF',
            'description' => 'CFA Franc BCEAO',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'XPF',
            'description' => 'CFP Franc',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'YER',
            'description' => 'Yemeni Rial',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ZAR',
            'description' => 'South African Rand',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ZMK',
            'description' => 'Zambian Kwacha (pre-2013)',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ZMW',
            'description' => 'Zambian Kwacha',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('currencies')->insert([
            'external_id' => Uuid::uuid4()->toString(),
            'code' => 'ZWL',
            'description' => 'Zimbabwean Dollar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}

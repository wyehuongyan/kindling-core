<?php

use Illuminate\Database\Seeder;
use App\Models\PieceBrand;

class PieceBrandTableSeeder extends Seeder {

    public function run()
    {
        if(env('APP_ENV') != "production") {
            // staging or local
            $this->staging();
        } else {
            // production
            $this->production();
        }
    }

    public function production() {
        // empty the piece brand table first
        DB::table('piece_brands')->truncate();

        $brand_1 = new PieceBrand(); // 1
        $brand_1->name = "A BATHING APE";
        $brand_1->save();

        $brand_2 = new PieceBrand(); // 2
        $brand_2->name = "Adidas";
        $brand_2->save();

        $brand_3 = new PieceBrand(); // 3
        $brand_3->name = "Aeropostale";
        $brand_3->save();

        $brand_4 = new PieceBrand(); // 4
        $brand_4->name = "agnes b.";
        $brand_4->save();

        $brand_5 = new PieceBrand(); // 5
        $brand_5->name = "American Eagle Outfitters";
        $brand_5->save();

        $brand_6 = new PieceBrand(); // 6
        $brand_6->name = "Armani Exchange";
        $brand_6->save();

        $brand_7 = new PieceBrand(); // 7
        $brand_7->name = "bebe";
        $brand_7->save();

        $brand_8 = new PieceBrand(); // 8
        $brand_8->name = "Bershka";
        $brand_8->save();

        $brand_9 = new PieceBrand(); // 9
        $brand_9->name = "Birkenstock";
        $brand_9->save();

        $brand_10 = new PieceBrand(); // 10
        $brand_10->name = "Bossini";
        $brand_10->save();

        $brand_11 = new PieceBrand(); // 11
        $brand_11->name = "Burberry";
        $brand_11->save();

        $brand_12 = new PieceBrand(); // 12
        $brand_12->name = "bYSI";
        $brand_12->save();

        $brand_13 = new PieceBrand(); // 13
        $brand_13->name = "Calvin Klein";
        $brand_13->save();

        $brand_14 = new PieceBrand(); // 14
        $brand_14->name = "Christian Louboutin";
        $brand_14->save();

        $brand_15 = new PieceBrand(); // 15
        $brand_15->name = "Converse";
        $brand_15->save();

        $brand_16 = new PieceBrand(); // 16
        $brand_16->name = "Cotton On";
        $brand_16->save();

        $brand_17 = new PieceBrand(); // 17
        $brand_17->name = "Denizen";
        $brand_17->save();

        $brand_18 = new PieceBrand(); // 18
        $brand_18->name = "Desigual";
        $brand_18->save();

        $brand_19 = new PieceBrand(); // 19
        $brand_19->name = "Dior";
        $brand_19->save();

        $brand_20 = new PieceBrand(); // 20
        $brand_20->name = "DKNY";
        $brand_20->save();

        $brand_21 = new PieceBrand(); // 21
        $brand_21->name = "Dockers";
        $brand_21->save();

        $brand_22 = new PieceBrand(); // 22
        $brand_22->name = "Dorothy Perkins";
        $brand_22->save();

        $brand_23 = new PieceBrand(); // 23
        $brand_23->name = "Dressabelle";
        $brand_23->save();

        $brand_24 = new PieceBrand(); // 24
        $brand_24->name = "Esprit";
        $brand_24->save();

        $brand_25 = new PieceBrand(); // 25
        $brand_25->name = "Factorie";
        $brand_25->save();

        $brand_26 = new PieceBrand(); // 26
        $brand_26->name = "Forever 21";
        $brand_26->save();

        $brand_27 = new PieceBrand(); // 27
        $brand_27->name = "Forever New";
        $brand_27->save();

        $brand_28 = new PieceBrand(); // 28
        $brand_28->name = "Fred Perry";
        $brand_28->save();

        $brand_29 = new PieceBrand(); // 29
        $brand_29->name = "G2000";
        $brand_29->save();

        $brand_30 = new PieceBrand(); // 30
        $brand_30->name = "GAP";
        $brand_30->save();

        $brand_31 = new PieceBrand(); // 31
        $brand_31->name = "GG<5";
        $brand_31->save();

        $brand_32 = new PieceBrand(); // 32
        $brand_32->name = "Giodarno";
        $brand_32->save();

        $brand_33 = new PieceBrand(); // 33
        $brand_33->name = "Guess";
        $brand_33->save();

        $brand_34 = new PieceBrand(); // 34
        $brand_34->name = "H&M";
        $brand_34->save();

        $brand_35 = new PieceBrand(); // 35
        $brand_35->name = "Hang Ten";
        $brand_35->save();

        $brand_36 = new PieceBrand(); // 36
        $brand_36->name = "Jeffrey Campbell";
        $brand_36->save();

        $brand_37 = new PieceBrand(); // 37
        $brand_37->name = "Jrunway";
        $brand_37->save();

        $brand_38 = new PieceBrand(); // 38
        $brand_38->name = "Kate Spade Saturday";
        $brand_38->save();

        $brand_39 = new PieceBrand(); // 39
        $brand_39->name = "Lacoste";
        $brand_39->save();

        $brand_40 = new PieceBrand(); // 40
        $brand_40->name = "LEVI'S";
        $brand_40->save();

        $brand_41 = new PieceBrand(); // 41
        $brand_41->name = "Louis Vuitton";
        $brand_41->save();

        $brand_42 = new PieceBrand(); // 42
        $brand_42->name = "M)phosis";
        $brand_42->save();

        $brand_43 = new PieceBrand(); // 43
        $brand_43->name = "MANGO";
        $brand_43->save();

        $brand_44 = new PieceBrand(); // 44
        $brand_44->name = "Marc by Marc Jacobs";
        $brand_44->save();

        $brand_45 = new PieceBrand(); // 45
        $brand_45->name = "Marks & Spencer";
        $brand_45->save();

        $brand_46 = new PieceBrand(); // 46
        $brand_46->name = "MDS";
        $brand_46->save();

        $brand_47 = new PieceBrand(); // 47
        $brand_47->name = "MDSCollections";
        $brand_47->save();

        $brand_48 = new PieceBrand(); // 48
        $brand_48->name = "New Balance";
        $brand_48->save();

        $brand_49 = new PieceBrand(); // 49
        $brand_49->name = "Nike";
        $brand_49->save();

        $brand_50 = new PieceBrand(); // 50
        $brand_50->name = "Ninth Collective";
        $brand_50->save();

        $brand_51 = new PieceBrand(); // 51
        $brand_51->name = "Prada";
        $brand_51->save();

        $brand_52 = new PieceBrand(); // 52
        $brand_52->name = "Promod";
        $brand_52->save();

        $brand_53 = new PieceBrand(); // 53
        $brand_53->name = "Pull&Bear";
        $brand_53->save();

        $brand_54 = new PieceBrand(); // 54
        $brand_54->name = "PUMA";
        $brand_54->save();

        $brand_55 = new PieceBrand(); // 55
        $brand_55->name = "River Island";
        $brand_55->save();

        $brand_56 = new PieceBrand(); // 56
        $brand_56->name = "Saint Laurent";
        $brand_56->save();

        $brand_57 = new PieceBrand(); // 57
        $brand_57->name = "Salvatore Ferragamo";
        $brand_57->save();

        $brand_58 = new PieceBrand(); // 58
        $brand_58->name = "Stradivarius";
        $brand_58->save();

        $brand_59 = new PieceBrand(); // 59
        $brand_59->name = "Superdry";
        $brand_59->save();

        $brand_60 = new PieceBrand(); // 60
        $brand_60->name = "Ted Baker";
        $brand_60->save();

        $brand_61 = new PieceBrand(); // 61
        $brand_61->name = "Topshop";
        $brand_61->save();

        $brand_62 = new PieceBrand(); // 62
        $brand_62->name = "UNIQLO";
        $brand_62->save();

        $brand_63 = new PieceBrand(); // 63
        $brand_63->name = "Valentino";
        $brand_63->save();

        $brand_64 = new PieceBrand(); // 64
        $brand_64->name = "Vans";
        $brand_64->save();

        $brand_65 = new PieceBrand(); // 65
        $brand_65->name = "Young Hungry Free";
        $brand_65->save();

        $brand_66 = new PieceBrand(); // 66
        $brand_66->name = "ZARA";
        $brand_66->save();

        /* Japanese Brands */
        $brand_67 = new PieceBrand(); // 67
        $brand_67->name = "31 Sons de mode";
        $brand_67->save();

        $brand_68 = new PieceBrand(); // 68
        $brand_68->name = "American Apparel";
        $brand_68->save();

        $brand_69 = new PieceBrand(); // 69
        $brand_69->name = "Avan Lily";
        $brand_69->save();

        $brand_70 = new PieceBrand(); // 70
        $brand_70->name = "BEAMS";
        $brand_70->save();

        $brand_71 = new PieceBrand(); // 71
        $brand_71->name = "BOY LONDON";
        $brand_71->save();

        $brand_72 = new PieceBrand(); // 72
        $brand_72->name = "CECIL McBEE";
        $brand_72->save();

        $brand_73 = new PieceBrand(); // 73
        $brand_73->name = "dazzlin";
        $brand_73->save();

        $brand_74 = new PieceBrand(); // 74
        $brand_74->name = "DRWCYS";
        $brand_74->save();

        $brand_75 = new PieceBrand(); // 75
        $brand_75->name = "EGOIST";
        $brand_75->save();

        $brand_76 = new PieceBrand(); // 76
        $brand_76->name = "EMODA";
        $brand_76->save();

        $brand_77 = new PieceBrand(); // 77
        $brand_77->name = "EVRIS";
        $brand_77->save();

        $brand_78 = new PieceBrand(); // 78
        $brand_78->name = "FIG&VIPER";
        $brand_78->save();

        $brand_79 = new PieceBrand(); // 79
        $brand_79->name = "G.U.";
        $brand_79->save();

        $brand_80 = new PieceBrand(); // 80
        $brand_80->name = "GYDA";
        $brand_80->save();

        $brand_81 = new PieceBrand(); // 81
        $brand_81->name = "Heather";
        $brand_81->save();

        $brand_82 = new PieceBrand(); // 82
        $brand_82->name = "Khaju";
        $brand_82->save();

        $brand_83 = new PieceBrand(); // 83
        $brand_83->name = "LIP SERVICE";
        $brand_83->save();

        $brand_84 = new PieceBrand(); // 84
        $brand_84->name = "LIZ LISA";
        $brand_84->save();

        $brand_85 = new PieceBrand(); // 85
        $brand_85->name = "LOWRYS FARM";
        $brand_85->save();

        $brand_86 = new PieceBrand(); // 86
        $brand_86->name = "merry jenny";
        $brand_86->save();

        $brand_87 = new PieceBrand(); // 87
        $brand_87->name = "MOUSSY";
        $brand_87->save();

        $brand_88 = new PieceBrand(); // 88
        $brand_88->name = "MURUA";
        $brand_88->save();

        $brand_89 = new PieceBrand(); // 89
        $brand_89->name = "PUNYUS";
        $brand_89->save();

        $brand_90 = new PieceBrand(); // 90
        $brand_90->name = "RESEXXY";
        $brand_90->save();

        $brand_91 = new PieceBrand(); // 91
        $brand_91->name = "rienda";
        $brand_91->save();

        $brand_92 = new PieceBrand(); // 92
        $brand_92->name = "SHEL'TTER";
        $brand_92->save();

        $brand_93 = new PieceBrand(); // 93
        $brand_93->name = "SLY";
        $brand_93->save();

        $brand_94 = new PieceBrand(); // 94
        $brand_94->name = "SPINNS";
        $brand_94->save();

        $brand_95 = new PieceBrand(); // 95
        $brand_95->name = "SPIRALGIRL";
        $brand_95->save();

        $brand_96 = new PieceBrand(); // 96
        $brand_96->name = "The Virginia";
        $brand_96->save();

        $brand_97 = new PieceBrand(); // 97
        $brand_97->name = "titty&Co";
        $brand_97->save();

        $brand_98 = new PieceBrand(); // 98
        $brand_98->name = "Ungrid";
        $brand_98->save();

        $brand_99 = new PieceBrand(); // 99
        $brand_99->name = "UNIQLO";
        $brand_99->save();

        $brand_100 = new PieceBrand(); // 100
        $brand_100->name = "VOGUE GIRL";
        $brand_100->save();

        $brand_101 = new PieceBrand(); // 101
        $brand_101->name = "WEGO";
        $brand_101->save();
    }

    public function staging() {
        // empty the piece brand table first
        DB::table('piece_brands')->truncate();

        $brand_1 = new PieceBrand(); // 1
        $brand_1->name = "Chanel";
        $brand_1->save();

        $brand_2 = new PieceBrand(); // 2
        $brand_2->name = "Forever 21";
        $brand_2->save();

        $brand_3 = new PieceBrand(); // 3
        $brand_3->name = "Pull&Bear";
        $brand_3->save();

        $brand_4 = new PieceBrand(); // 4
        $brand_4->name = "Marc by Marc Jacobs";
        $brand_4->save();

        $brand_5 = new PieceBrand(); // 5
        $brand_5->name = "Gucci";
        $brand_5->save();

        $brand_6 = new PieceBrand(); // 6
        $brand_6->name = "Converse";
        $brand_6->save();

        $brand_7 = new PieceBrand(); // 7
        $brand_7->name = "River Island";
        $brand_7->save();

        $brand_8 = new PieceBrand(); // 8
        $brand_8->name = "Topshop";
        $brand_8->save();

        $brand_9 = new PieceBrand(); // 9
        $brand_9->name = "H&M";
        $brand_9->save();

        $brand_10 = new PieceBrand(); // 10
        $brand_10->name = "American Apparel";
        $brand_10->save();

        $brand_11 = new PieceBrand(); // 11
        $brand_11->name = "Vans";
        $brand_11->save();

        $brand_12 = new PieceBrand(); // 12
        $brand_12->name = "Uniqlo";
        $brand_12->save();

        $brand_13 = new PieceBrand(); // 13
        $brand_13->name = "Nordstorm";
        $brand_13->save();

        $brand_14 = new PieceBrand(); // 14
        $brand_14->name = "Nike";
        $brand_14->save();

        $brand_15 = new PieceBrand(); // 15
        $brand_15->name = "ASOS";
        $brand_15->save();

        $brand_16 = new PieceBrand(); // 16
        $brand_16->name = "New Look";
        $brand_16->save();

        $brand_17 = new PieceBrand(); // 17
        $brand_17->name = "Urban Outfitters";
        $brand_17->save();

        $brand_18 = new PieceBrand(); // 18
        $brand_18->name = "Sprubix";
        $brand_18->save();

        $brand_19 = new PieceBrand(); // 19
        $brand_19->name = "Flufflea";
        $brand_19->save();
    }
}
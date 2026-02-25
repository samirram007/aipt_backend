<?php

namespace App\Modules\Distributor\Database\Seeders;

use App\Modules\Distributor\Requests\DistributorRequest;
use App\Modules\Distributor\Services\DistributorService;
use Illuminate\Database\Seeder;
use App\Modules\Distributor\Models\Distributor;
use Illuminate\Support\Facades\Validator;

class DistributorSeeder extends Seeder
{
    protected DistributorService $distributorService;

    public function __construct(DistributorService $distributorService)
    {
        $this->distributorService = $distributorService;
    }

    public function run(): void
    {
        $rows = [
            // id, code, name, contact_no, phone, line1, postal_code
            [1, "620569A073", "ADRIJA ENTERPRISE", "9734000052", "", "NALAGOLA", "733124"],
            [2, "620569R063", "RATAN SAHA", "7679555530", "", "PAKUAHAT", "732138"],
            [3, "620569A065", "ARAPUR CEMENT CENTRE", "9434682557", "", "ENGLISH BAZAR", "732143"],
            [4, "620569D025", "DAS CEMENT STORES", "9332288348", "", "ENGLISH BAZAR", "732101"],
            [5, "620569G025", "GHOSH CEMENT CENTRE", "9734183398", "", "ENGLISH BAZAR", "732103"],
            [6, "620569J013", "JAGANNATH ENTERPRISE", "9932840986", "", "ENGLISH BAZAR", "732101"],
            [7, "620569J021", "JOY ENTERPRISE", "9733050763", "", "GOYESHPUR", "732102"],
            [8, "620569M070", "MANOJ KUMAR DAS & BROTHERS", "9932951810", "", "ENGLISH BAZAR", "732216"],
            [9, "620569R041", "RADHA KRISHNA TRADERS", "9434149803", "", "ENGLISH BAZAR", "732103"],
            [10, "620569R071", "REJA ENTERPRISE", "8972782383", "", "ENGLISH BAZAR", "732208"],
            [11, "620569S135", "SEEMA TRADING COMPANY", "9434067014", "", "ENGLISH BAZAR", "732102"],
            [12, "620569R037", "ROY CONSTRUCTION", "9474475339", "", "HABIBPUR", "732122"],
            [13, "620569K028", "KHAN ENTERPRISE", "9002777232", "", "MANIKCHAK", "732202"],
            [14, "620569B081", "BABA LOKENATH TRADING", "8927832816", "", "8 MILE", "732128"],
            [15, "620569G023", "GHOSH ENTERPRISE II", "9434240639", "", "OLD MALDA", "732142"],
            [16, "620569M116", "MAULIK ENTERPRISE", "9933350531", "9434231645", "NARAYANPUR", "732141"],
            [17, "620569A086", "AHANA ENTERPRISE", "6296782487", "", "DALALMORE", "732201"],
            [18, "620569K019", "K.M. SAHA & SONS.", "9733280900", "", "OLD MALDA", "732128"],
            [19, "620569B072", "BASIR ENTERPRISE", "9733174879", "", "BAKHARPUR", "732206"],
            [20, "620569B074", "BISWAS HARDWARE", "9932979687", "", "JALUABADHA", "732216"],
            [21, "620569M069", "M.H. ENTERPRISE UBS", "9734882187", "", "KALIACHAK", "732201"],
            [22, "620569M071", "MD. JAKIR HOSSAIN II *", "9733213503", "", "KALIACHAK", "732206"],
            [23, "620569M107", "MD. EMRAN ALI KHAN", "9851051383", "", "KALIACHAK", "732201"],
            [24, "620569M110", "MAA ENTERPRISE", "9083275401", "", "KALIACHAK", "732201"],
            [25, "620569N037", "NOOR ENTERPRISE", "7866813060", "", "KALIACHAK", "732212"],
            [26, "621669S001", "SAKIL ENTERPRISE", "8250802075", "", "BALIADANGA", "732201"],
            [27, "620569T024", "TAMIM ENTERPRISE", "8116372123", "", "NATIBPUR", "732206"],
            [28, "620569T028", "TAJEM ENTERPRISE", "8670214992", "", "", "732206"],
            [29, "621669A001", "ASFIKA HARDWARE", "9735006297", "", "NURPUR", "732203"],
            [30, "620569R035", "REJA HARDWARE UBS", "9153920114", "", "MANIKCHAK", "732203"],
            [31, "620569R070", "RIMPA ENTERPRISE", "9002391884", "", "MATHURAPUR", "732203"],
            [32, "620569R074", "RAHIM ENTERPRISE", "9832894075", "", "ENYETPUR", "732202"],
            [33, "620569A052", "ANANTA ROY", "9851601818", "", "GAZOLE", "732124"],
            [34, "620569B050", "BISWAS CEMENT AGENCY", "9933515733", "", "GAZOLE", "732124"],
            [35, "620569B084", "BINA ENTERPRISE", "9932467667", "", "GAZOLE", "732138"],
            [36, "620569G024", "GHOSH HARDWARE V", "9434681643", "", "GAZOLE", "732102"],
            [37, "620569G041", "GANAPATI SUPPLIERS", "9734989265", "9734033169", "GAZOLE", "732124"],
            [38, "620569A066", "ABDUL MANNAN", "9775916700", "9734939390", "BAISHNAB NAGAR", "732127"],
            [39, "620569H019", "HABIBUR ENTERPRISE", "9733006180", "", "GOLAPGANJ", "732201"],
            [40, "620569M062", "MD. FAJLUR RAHAMAN", "8927895615", "", "KALIACHAK", "732201"],
            [41, "620569R038", "RAGHUNATH ENTERPRISE", "9732737075", "", "KALIACHAK", "732201"],
            [42, "620569S103", "SAMIUL HARDWARE *", "9734989583", "", "KALIACHAK", "732201"],
            [43, "620569B054", "BADRI PRASAD AGARWALA & SONS(HUF)", "9932721499", "", "RATUA", "732205"],
            [44, "620569R075", "R K ENTERPRISE", "9064751263", "", "RATUA", "732205"],
            [45, "620569S136", "SUMI ENTERPRISE", "7001138045", "", "KAHALA", "732205"],
            [46, "620569I002", "IFSANUR HOSSAIN UBS", "9734357177", "", "CHANCHOL", "732123"],
            [47, "620569K034", "KAMALUDDIN", "6295094755", "", "CHANCHOL", "732126"],
            [48, "620569S146", "SAMIM ENTERPRISE", "9614772182", "", "CHANCHOL", "732126"],
            [49, "620569S150", "SAHA SUPPLIERS", "9002360398", "", "ASHAPUR", "732150"],
            [50, "620569F008", "FAHAD HOSSAIN", "7908915080", "", "RAMPUR", "732126"],
            [51, "620569M129", "MYSA HARDWARE", "9734751887", "", "MALATIPUR", "732123"],
            [52, "620569J012", "JAMAN ENTERPRISE", "8972101075", "", "RATUA", "732204"],
            [53, "620569N041", "NAAZ CONSTRUCTION", "9733453092", "", "RATUA", "732205"],
            [54, "620569T025", "TANISA HARDWARE", "7547918861", "", "DHANGARA", "732125"],
            [55, "620569D043", "DEBMOY MANDAL", "9064235058", "", "RATUA", "732205"],
            [56, "620569K025", "KOMAL ENTERPRISE", "9932451897", "", "RATUA", "732139"],
            [57, "620569R051", "REJA ENTERPRISE", "9733408360", "", "", "732125"],
            [58, "620569I008", "INDIAN ENTERPRISE", "9002591828", "", "CHANCHOL", "732123"],
            [59, "620569A087", "A AKTAR ENTERPRISE", "9733449956", "", "GOALPARA", "732126"],
            [60, "620569N040", "NEW HARDWARE", "9851616889", "", "NAYATOLA", "732123"],
            [61, "620569B052", "BASAK BUILDERS", "9434680202", "", "PUKHURIA", "732214"],
            [62, "620569K020", "KRISHNA TRADERS I", "9434818175", "", "BANSHIHARI", "733121"],
            [63, "620569N028", "NEW KRISHNA TRADERS", "9733177144", "", "BANSHIHARI", "733121"],
            [64, "620569A061", "APARNA GHOSH", "9733079411", "", "HARIRAMPUR", "733125"],
            [65, "620569S079", "SAHIN CONSTRUCTION", "9733204003", "", "KUSHMANDI", "732125"],
            [66, "620569U004", "UTTAM KUMAR SAHA", "8145858085", "", "KUSHMANDI", "733132"],
            [67, "621669W001", "WASHIM BARI", "7319348361", "", "KUSHMANDI", "733132"],
            [68, "620569A081", "ANUSHKA ENTERPRISE", "9679633290", "", "KHADIMPUR", "733101"],
            [69, "620569B077", "BOLLA MAA PROJECTS", "8116230124", "9064791758", "BALURGHAT", "733101"],
            [70, "620569M095", "MAHA LAKSHMI HARDWARE", "9933678585", "", "BALURGHAT", "733158"],
            [71, "620569R078", "RUDRA COMMERCE", "9932434296", "", "BALURGHAT", "733103"],
            [72, "620569A093", "ALI MONOROMA HARDWARE", "9734910399", "", "GANGARAMPUR", "733141"],
            [73, "620569B070", "BISWAS CONSTRUCTION", "9832996855", "", "GANGARAMPUR", "733140"],
            [74, "620569N027", "NEW SAMRAT ENTERPRISE", "9046196510", "", "GANGARAMPUR", "733124"],
            [75, "620569S096", "SAHA BROTHERS *", "8972164856", "", "GANGARAMPUR", "733124"],
            [76, "620569N035", "NARAYAN ENGINEERING WORKS", "9733191040", "", "TAPAN", "733142"],
            [77, "620569R069", "RAHAMAN ENTERPRISE", "9775825788", "", "TAPAN", "733127"],
        ];

        foreach ($rows as $row) {

            [$id, $code, $name, $contact_no, $phone, $line1, $postal] = $row;

            $payload = [
                "name" => $name,
                "code" => $code,
                "status" => "active",
                "gstin" => "",
                "pan" => "",
                "contact_person" => "",
                "contact_no" => $contact_no,
                "phone" => $phone,
                "email" => "",
                "account_group_id" => 10008,
                "address" => [
                    "line1" => $line1,
                    "line2" => "",
                    "landmark" => "",
                    "city" => "",
                    "state_id" => 36,
                    "country_id" => 76,
                    "postal_code" => $postal,
                    "is_primary" => true,
                    "addressable" => [
                        "addressable_id" => null,
                        "addressable_type" => ""
                    ]
                ],
                "is_edit" => false
            ];


            $rules = (new DistributorRequest())->rules();
            $validatedData = Validator::make($payload, $rules)->validate();

            $this->distributorService->store($validatedData);
        }
    }
}

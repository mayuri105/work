<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\AchModel;
use App\RegionsModel;
use App\RegistrationPaymentModel;
use App\RegistrationModel;
use App\RepaymentModel;
use App\RepaymentAchsModel;
use App\RepaymentAmountsModel;
use App\BankNameModel;
use App\RegistrationFeesModel;
use App\SahyognidhiManpowerRefundpaymentAmounts;
use App\SahyognidhiManpowerFinalRefundamounts;
use App\SahyognidhiManpowerModel;
use App\LedgerAccountModel;
use App\BankChargesModel;
use App\SahyognidhiRequestModel;
use App\SahyognidhiAmountModel;
use App\SahyognidhiPaymentModel;
use App\DiseaseModel;
use App\SamajZoneModel;
use App\YuvaMandalNumberModel;
use App\CityModel;
use App\NomineeDetailsModel;
use App\CouncilModel;
use App\LockingPeriodModel;
use App\AllBankEntryDetailsModel;
use App\AllBankEntryModel;
use App\RegistrationUploadDocumentModel;
use App\DivisionModel;
use App\RegistrationDonationModel;
use App\RegistrationDevelopmentFundAmount;

use Mail;
use App\Exports\Collection;
use \Illuminate\Database\Eloquent\Model ;
use Input;
use Validator;
use Auth;
use session;
use DB;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportUsers implements FromCollection,WithHeadings,WithTitle,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;
    protected $idExport;
    protected $allSearch;

		function __construct($id,$idExport,$allSearch) {
		        $this->id = $id;
                $this->idExport = $idExport;
                $this->allSearch = $allSearch;
		}
    public function collection()
    { 	//dd($this->allSearch);
        // User::get();
        //return User::all();
      /*return [
            [1, 2, 3],
            [4, 5, 6]
        ];*/
        //dd($this->idExport);
        if($this->idExport == 1){

            return RepaymentModel::select('repayments.name','repayments.ysk_id','repayments.age','regions.region_name','yuva_mandal_numbers.yuva_mandal_number','repayments.phone_number_first',
                DB::raw(('CASE WHEN repayments.payment_completed = 0 THEN "Pending" 
                        WHEN repayments.payment_completed= 1 THEN "Paid"
                        ELSE " " 
                        END') ))
            ->leftJoin('registrations', 'registrations.registration_id', '=', 'repayments.fk_registration_id')
            ->leftJoin('regions','regions.region_id','=','repayments.fk_region_id')
            ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','registrations.fk_yuva_mandal_id')
            ->groupBy('repayments.fk_registration_id')
            ->orderBy('repayments.repayment_id','ASC')
            ->whereIn('repayments.fk_registration_id',explode(",",$this->id))->get();
        }
        if($this->idExport == 2){
            return RegistrationModel::whereNotIn('registrations.status',['3','6'])
            ->select(DB::raw('DATE_FORMAT(registrations.today_date,"%d-%m-%Y") as date1'),'registrations.processing_id','registrations.family_id',DB::raw('DATE_FORMAT(registrations.ysk_date,"%d-%m-%Y") as ysk_date1'),'registrations.ysk_id','registrations.pre_ysk_id',DB::raw('UPPER(registrations.name_as_per_yuva_sangh_org)as name_as_per_yuva_sangh_org'),'registrations.fk_city_id','registrations.phone_number_first','regions.region_name',DB::raw(('CASE WHEN registrations.status = 0 THEN "Pending" 
                        WHEN registrations.status= 1 THEN "Active"
                        WHEN registrations.status= 2 THEN "DeActive" 
                        WHEN registrations.status= 7 THEN "YSK Mitra"
                        WHEN registrations.status= 8 THEN "YSK Transfer"
                        ELSE "Deleted" 
                        END') ))
                    ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                    ->orderByRaw('LENGTH(ysk_id) asc')
                    ->orderBy('ysk_id','ASC')
                    ->orderByRaw('LENGTH(pre_ysk_id) asc')
                    ->orderBy('pre_ysk_id','ASC')
                    ->groupBy('registrations.registration_id')
                    ->whereIn('registrations.registration_id',explode(",",$this->id))->get();
        }
        if($this->idExport == 3){
            return RegistrationModel::whereNotIn('registrations.status',['3','6'])
            ->select(DB::raw('DATE_FORMAT(registrations.today_date,"%d-%m-%Y") as date1'),'registrations.processing_id','registrations.family_id',DB::raw('DATE_FORMAT(registrations.ysk_date,"%d-%m-%Y") as ysk_date1'),'registrations.ysk_id','registrations.pre_ysk_id','registrations.name_as_per_yuva_sangh_org','registrations.fk_city_id','registrations.phone_number_first','regions.region_name',DB::raw(('CASE WHEN registrations.status = 0 THEN "Pending" 
                        WHEN registrations.status= 1 THEN "Active"
                        WHEN registrations.status= 2 THEN "DeActive" 
                        WHEN registrations.status= 7 THEN "YSK Mitra"
                        WHEN registrations.status= 8 THEN "YSK Transfer"
                        ELSE "Deleted" 
                        END') ))
                    ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                    ->orderByRaw('LENGTH(ysk_id) asc')
                    ->orderBy('ysk_id','ASC')
                    ->orderByRaw('LENGTH(pre_ysk_id) asc')
                    ->orderBy('pre_ysk_id','ASC')
                    ->groupBy('registrations.registration_id')
                    ->whereIn('registrations.registration_id',explode(",",$this->id))->get();
        }

        if($this->idExport == 4){
            return $sahyognidhiRequest = SahyognidhiRequestModel::where('sahyognidhi_requests.status','!=','3')
                ->select('sahyognidhi_requests.fk_ysk_id',DB::raw('DATE_FORMAT(sahyognidhi_requests.inform_date,"%d-%m-%Y") as inform_date'),DB::raw('DATE_FORMAT(sahyognidhi_requests.sahyognidhi_date,"%d-%m-%Y") as sahyognidhi_date'),'sahyognidhi_requests.sahyognidhi_request','sahyognidhi_requests.region_name','sahyognidhi_requests.yuva_mandal_name',DB::raw(('CASE WHEN sahyognidhi_requests.status = 0 THEN "Pending" 
                        WHEN sahyognidhi_requests.status= 1 THEN "Paid"
                        WHEN sahyognidhi_requests.status= 2 THEN "Unpaid" 
                        ELSE " " 
                        END') ))
                ->groupBy('sahyognidhi_requests.sahyognidhi_id')
                ->orderBy('sahyognidhi_requests.sahyognidhi_id','DESC')
                ->whereIn('sahyognidhi_requests.sahyognidhi_id',explode(",",$this->id))->get();
        }
    	if($this->idExport == 5){
            //dd('as');
            return $ach = AchModel::where('achs.status','!=','3')
                ->select('registrations.family_id','achs.fk_ysk_id','registrations.name_as_per_yuva_sangh_org','achs.city_name','achs.phone_number','achs.ach_status')
                ->leftJoin('registrations','registrations.ysk_id','=','achs.fk_ysk_id')
                ->orderBy('achs.ach_id','DESC')
                ->groupBy('achs.ach_id')
                ->whereIn('achs.ach_id',explode(",",$this->id))->get();
                //dd($ach);

        }
        if($this->idExport == 6){
            return RegistrationModel::whereNotIn('registrations.status',['3','6'])
            ->select(DB::raw('DATE_FORMAT(registrations.today_date,"%d-%m-%Y") as date1'),'registrations.processing_id','registrations.family_id','registrations.member',DB::raw('DATE_FORMAT(registrations.ysk_date,"%d-%m-%Y") as ysk_date1'),'registrations.ysk_id','registrations.pre_ysk_id',DB::raw('UPPER(registrations.name_as_per_yuva_sangh_org)as name_as_per_yuva_sangh_org'),'registrations.email','registrations.registration_amount','registrations.aadhar_card_number',DB::raw('DATE_FORMAT(registrations.date_of_birth,"%d-%m-%Y") as date_of_birth'),'registrations.age','registrations.gender','registrations.country','registrations.fk_state_id','registrations.fk_district_id','registrations.fk_city_id','registrations.phone_number_first','regions.region_name',DB::raw(('CASE WHEN registrations.status = 0 THEN "Pending" 
                        WHEN registrations.status= 1 THEN "Active"
                        WHEN registrations.status= 2 THEN "DeActive" 
                        WHEN registrations.status= 7 THEN "YSK Mitra"
                        WHEN registrations.status= 8 THEN "YSK Transfer"
                        ELSE "Deleted" 
                        END') ),'councils.name','divisions.division_name','samaj_zones.samaj_zone_name','yuva_mandal_numbers.yuva_mandal_number')
                    ->leftJoin('regions','regions.region_id','=','registrations.fk_region_id')
                    ->leftJoin('councils','councils.council_id','=','registrations.fk_council_id')
                    ->leftJoin('divisions','divisions.division_id','=','registrations.fk_division_id')
                    ->leftJoin('samaj_zones','samaj_zones.samaj_zone_id','=','registrations.fk_samaj_zone_id')
                    ->leftJoin('yuva_mandal_numbers','yuva_mandal_numbers.yuva_mandal_number_id','=','registrations.fk_yuva_mandal_id')
                    ->orderByRaw('LENGTH(ysk_id) asc')
                    ->orderBy('ysk_id','ASC')
                    ->orderByRaw('LENGTH(pre_ysk_id) asc')
                    ->orderBy('pre_ysk_id','ASC')
                    ->groupBy('registrations.registration_id')
                    ->whereIn('registrations.registration_id',explode(",",$this->id))->get();
        }
    }
     public function array(): array
    {
        return  $this->id;
    }
     public function headings(): array
    {
        if($this->idExport == 1){
                return [
                    'Name',
                    'YSK Id',
                    'Age',
                    'Region Name',
                    'Yuva Mandal Name',
                    'Phone Number',
                    'Status'
                ];
        }
        if($this->idExport == 2){
            return [
                    'Entry Date',
                    'Processing ID',
                    'Family ID',
                    'YSK Date',
                    'YSK Number',
                    'Pre YSK Number',
                    'YSK Member Name',
                    'City Name',
                    'Contact',
                    'Region',
                    'Status'
                ];

        }

        if($this->idExport == 3){
            return [
                    'Entry Date',
                    'Processing ID',
                    'Family ID',
                    'YSK Date',
                    'YSK Number',
                    'Pre YSK Number',
                    'YSK Member Name',
                    'City Name',
                    'Contact',
                    'Region',
                    'Status'
                ];

        }

        if($this->idExport == 4){
            return [
                    'YSK Number',
                    'Inform Date',
                    'Sahyognidhi Date',
                    'Sahyognidhi Type',
                    'Region',
                    'Yuva Mandal Name',
                    'Status'
                ];

        }
        if($this->idExport == 5){
            return [
                    'Family Id',
                    'YSK Number',
                    'YSK Member Name',
                    'City',
                    'Contact Number',
                    'Status'
                ];

        }
        if($this->idExport == 6){
            return [
                    'Entry Date',
                    'Processing ID',
                    'Family ID',
                    'Member ID',
                    'YSK Date',
                    'YSK Number',
                    'Pre YSK Number',
                    'YSK Member Name',
                    'Email',
                    'Amount',
                    'Adhar Card Number',
                    'Birth Date',
                    'Age',
                    'Gender',
                    'Country Name',
                    'State Name',
                    'District Name',
                    'City Name',
                    'Contact',
                    'Region',
                    'Status',
                    'Council',
                    'Division',
                    'Samaj Zone',
                    'Yuva mandal'
                ];

        }
    }
    public function registerEvents(): array
    {   
        if($this->idExport == 2){
            $styleTitulos = [
                        'font' => [
                            'bold' => true,
                            'size' => 12
                        ]
                    ];
            return [
                    
                    // Handle by a closure.
                    BeforeExport::class => function(BeforeExport $event) {
                        $event->writer->getProperties()->setCreator('Sistema de alquileres');
                    },
                    AfterSheet::class => function(AfterSheet $event) use ($styleTitulos){
                        $event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos);
                        //$event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()+1),"Total");
                        /*foreach ($this->filas as $index => $fila){
                            $fila++;*/
                            $style_text_center = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ]
                            ];
                             $style_text_center_color = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ],
                                'font' => array(
                                    'color' => ['argb' => '69725c'],
                                )
                            ];

                        $style_color = [
                                'font' => array(
                                    'color' => ['argb' => 'EB2B02'],
                                )
                            ];
                            $style_font = [
                                'font' => array(
                                    'name'      =>  'Calibri',
                                    'size'      =>  15,
                                    'bold'      =>  true
                                )
                            ];
                            $last_column = Coordinate::stringFromColumnIndex(11);
                            // calculate last row + 1 (total results + header rows + column headings row + new row)
                                $last_row = count(explode(",",$this->id)) + 6 + 1 + 1;
                            //dd($last_row);
                            $event->sheet->insertNewRowBefore(1, 6);
                            $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
                            $event->sheet->mergeCells(sprintf('A2:%s2',$last_column));
                            $event->sheet->mergeCells(sprintf('A3:%s3',$last_column));
                            $event->sheet->mergeCells(sprintf('A4:%s4',$last_column));
                            $event->sheet->mergeCells(sprintf('A5:%s5',$last_column));
                            $event->sheet->mergeCells(sprintf('A6:%s6',$last_column));
                            $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,$last_column,$last_row));
                            // assign cell values
                            $event->sheet->setCellValue('A1','YUVA SURAKSHA KAVACH');
                            $event->sheet->setCellValue('A2','501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD. ');
                            $event->sheet->setCellValue('A3','MO: 7575898989, 8575898989 | EMAIL: OFFICEYSK@GMAIL.COM');
                            if($this->allSearch != 0){
                                $event->sheet->setCellValue('A4','Up to Date:'.$this->allSearch[0].' to '.$this->allSearch[1].'');
                            
                                $event->sheet->setCellValue('A5','COUNCIL: '.$this->allSearch[2].'  | SAMAJ ZONE: '.$this->allSearch[3].' | REGION : '.$this->allSearch[4].' | DIVISION NAME: '.$this->allSearch[5].' | YUVAMANDAL NAME: '.$this->allSearch[6].' | AGE GROUP: '.$this->allSearch[7].' | GENDER: '.$this->allSearch[8].' | OPTION : 1. WITH APPLY DATE/PID');
                                 $event->sheet->setCellValue('A6',''.$this->allSearch[9].' - Member List');
                            }
                            ///$event->sheet->setCellValue(sprintf('A%d',$last_row),'SECURITY CLASSIFICATION - UNCLASSIFIED [Generated: ...]');

                            // assign cell styles
                            $event->sheet->getStyle('A1:A1')->applyFromArray($style_font);
                            $event->sheet->getStyle('A5:A5')->applyFromArray($style_color);
                            $event->sheet->getStyle('A6:A6')->applyFromArray($style_text_center_color);
                            $event->sheet->getStyle('A1:A4')->applyFromArray($style_text_center);
                            $event->sheet->getStyle(sprintf('A%d',$last_row))->applyFromArray($style_text_center);
                            /*$event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A1","YUVA SURAKSHA KAVACH");
                            $event->sheet->setCellValue("K1", "");

                            $event->sheet->getStyle("A2:K2")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A2","501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD.");
                            $event->sheet->setCellValue("K2", "");*/
                        /*}*/
                      //  $event->sheet->getDelegate()->mergeCells("A{$event->sheet->getHighestRow()}:F{$event->sheet->getHighestRow()}");
                       // $event->sheet->setCellValue('G'. ($event->sheet->getHighestRow()),5);
                    }
            ];
        }
        if($this->idExport == 3){
            $styleTitulos = [
                        'font' => [
                            'bold' => true,
                            'size' => 12
                        ]
                    ];
            return [
                    
                    // Handle by a closure.
                    BeforeExport::class => function(BeforeExport $event) {
                        $event->writer->getProperties()->setCreator('Sistema de alquileres');
                    },
                    AfterSheet::class => function(AfterSheet $event) use ($styleTitulos){
                        $event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos);
                        //$event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()+1),"Total");
                        /*foreach ($this->filas as $index => $fila){
                            $fila++;*/
                            $style_text_center = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ]
                            ];
                             $style_text_center_color = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ],
                                'font' => array(
                                    'color' => ['argb' => '69725c'],
                                )
                            ];

                        $style_color = [
                                'font' => array(
                                    'color' => ['argb' => 'EB2B02'],
                                )
                            ];
                            $style_font = [
                                'font' => array(
                                    'name'      =>  'Calibri',
                                    'size'      =>  15,
                                    'bold'      =>  true
                                )
                            ];
                            $last_column = Coordinate::stringFromColumnIndex(11);
                            // calculate last row + 1 (total results + header rows + column headings row + new row)
                                $last_row = count(explode(",",$this->id)) + 6 + 1 + 1;
                            //dd($last_row);
                            $event->sheet->insertNewRowBefore(1, 6);
                            $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
                            $event->sheet->mergeCells(sprintf('A2:%s2',$last_column));
                            $event->sheet->mergeCells(sprintf('A3:%s3',$last_column));
                            $event->sheet->mergeCells(sprintf('A4:%s4',$last_column));
                            $event->sheet->mergeCells(sprintf('A5:%s5',$last_column));
                            $event->sheet->mergeCells(sprintf('A6:%s6',$last_column));
                            $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,$last_column,$last_row));
                            // assign cell values
                            $event->sheet->setCellValue('A1','YUVA SURAKSHA KAVACH');
                            $event->sheet->setCellValue('A2','501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD. ');
                            $event->sheet->setCellValue('A3','MO: 7575898989, 8575898989 | EMAIL: OFFICEYSK@GMAIL.COM');
                            if($this->allSearch != 0){
                                $event->sheet->setCellValue('A4','Up to Date:'.$this->allSearch[0].' to '.$this->allSearch[1].'');
                            
                                $event->sheet->setCellValue('A5','COUNCIL: '.$this->allSearch[2].'  | SAMAJ ZONE: '.$this->allSearch[3].' | REGION : '.$this->allSearch[4].' | DIVISION NAME: '.$this->allSearch[5].' | YUVAMANDAL NAME: '.$this->allSearch[6].' | GENDER: '.$this->allSearch[7].' | OPTION : 1. WITH APPLY DATE/PID');
                                 $event->sheet->setCellValue('A6',''.$this->allSearch[8].' - Member List');
                            }
                            ///$event->sheet->setCellValue(sprintf('A%d',$last_row),'SECURITY CLASSIFICATION - UNCLASSIFIED [Generated: ...]');

                            // assign cell styles
                            $event->sheet->getStyle('A1:A1')->applyFromArray($style_font);
                            $event->sheet->getStyle('A5:A5')->applyFromArray($style_color);
                            $event->sheet->getStyle('A6:A6')->applyFromArray($style_text_center_color);
                            $event->sheet->getStyle('A1:A4')->applyFromArray($style_text_center);
                            $event->sheet->getStyle(sprintf('A%d',$last_row))->applyFromArray($style_text_center);
                            /*$event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A1","YUVA SURAKSHA KAVACH");
                            $event->sheet->setCellValue("K1", "");

                            $event->sheet->getStyle("A2:K2")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A2","501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD.");
                            $event->sheet->setCellValue("K2", "");*/
                        /*}*/
                      //  $event->sheet->getDelegate()->mergeCells("A{$event->sheet->getHighestRow()}:F{$event->sheet->getHighestRow()}");
                       // $event->sheet->setCellValue('G'. ($event->sheet->getHighestRow()),5);
                    }
            ];
        }
        if($this->idExport == 1){
            $styleTitulos = [
                        'font' => [
                            'bold' => true,
                            'size' => 12
                        ]
                    ];
            return [
                    
                    // Handle by a closure.
                    BeforeExport::class => function(BeforeExport $event) {
                        $event->writer->getProperties()->setCreator('Sistema de alquileres');
                    },
                    AfterSheet::class => function(AfterSheet $event) use ($styleTitulos){
                        $event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos);
                        //$event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()+1),"Total");
                        /*foreach ($this->filas as $index => $fila){
                            $fila++;*/
                            $style_text_center = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ]
                            ];
                             $style_text_center_color = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ],
                                'font' => array(
                                    'color' => ['argb' => '69725c'],
                                )
                            ];

                        $style_color = [
                                'font' => array(
                                    'color' => ['argb' => 'EB2B02'],
                                )
                            ];
                            $style_font = [
                                'font' => array(
                                    'name'      =>  'Calibri',
                                    'size'      =>  15,
                                    'bold'      =>  true
                                )
                            ];
                            $last_column = Coordinate::stringFromColumnIndex(11);
                            // calculate last row + 1 (total results + header rows + column headings row + new row)
                                $last_row = count(explode(",",$this->id)) + 6 + 1 + 1;
                            //dd($last_row);
                            $event->sheet->insertNewRowBefore(1, 6);
                            $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
                            $event->sheet->mergeCells(sprintf('A2:%s2',$last_column));
                            $event->sheet->mergeCells(sprintf('A3:%s3',$last_column));
                            $event->sheet->mergeCells(sprintf('A4:%s4',$last_column));
                            $event->sheet->mergeCells(sprintf('A5:%s5',$last_column));
                            $event->sheet->mergeCells(sprintf('A6:%s6',$last_column));
                            $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,$last_column,$last_row));
                            // assign cell values
                            $event->sheet->setCellValue('A1','YUVA SURAKSHA KAVACH');
                            $event->sheet->setCellValue('A2','501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD. ');
                            $event->sheet->setCellValue('A3','MO: 7575898989, 8575898989 | EMAIL: OFFICEYSK@GMAIL.COM');
                            if($this->allSearch != 0){
                                $event->sheet->setCellValue('A4','Up to Date:'.$this->allSearch[0].' to '.$this->allSearch[1].'');
                            
                                $event->sheet->setCellValue('A5','COUNCIL: '.$this->allSearch[2].'  | SAMAJ ZONE: '.$this->allSearch[3].' | REGION : '.$this->allSearch[4].' | DIVISION NAME: '.$this->allSearch[5].' | YUVAMANDAL NAME: '.$this->allSearch[6].' | AGE GROUP: '.$this->allSearch[7].' | GENDER: '.$this->allSearch[8].'| Status: '.$this->allSearch[9].'| OPTION : 1. WITH APPLY DATE/PID');
                                 $event->sheet->setCellValue('A6',''.$this->allSearch[10].' - Member List');
                            }
                            ///$event->sheet->setCellValue(sprintf('A%d',$last_row),'SECURITY CLASSIFICATION - UNCLASSIFIED [Generated: ...]');

                            // assign cell styles
                            $event->sheet->getStyle('A1:A1')->applyFromArray($style_font);
                            $event->sheet->getStyle('A5:A5')->applyFromArray($style_color);
                            $event->sheet->getStyle('A6:A6')->applyFromArray($style_text_center_color);
                            $event->sheet->getStyle('A1:A4')->applyFromArray($style_text_center);
                            $event->sheet->getStyle(sprintf('A%d',$last_row))->applyFromArray($style_text_center);
                            /*$event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A1","YUVA SURAKSHA KAVACH");
                            $event->sheet->setCellValue("K1", "");

                            $event->sheet->getStyle("A2:K2")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A2","501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD.");
                            $event->sheet->setCellValue("K2", "");*/
                        /*}*/
                      //  $event->sheet->getDelegate()->mergeCells("A{$event->sheet->getHighestRow()}:F{$event->sheet->getHighestRow()}");
                       // $event->sheet->setCellValue('G'. ($event->sheet->getHighestRow()),5);
                    }
            ];
        }
        if($this->idExport == 4){
            $styleTitulos = [
                        'font' => [
                            'bold' => true,
                            'size' => 12
                        ]
                    ];
            return [
                    
                    // Handle by a closure.
                    BeforeExport::class => function(BeforeExport $event) {
                        $event->writer->getProperties()->setCreator('Sistema de alquileres');
                    },
                    AfterSheet::class => function(AfterSheet $event) use ($styleTitulos){
                        $event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos);
                        //$event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()+1),"Total");
                        /*foreach ($this->filas as $index => $fila){
                            $fila++;*/
                            $style_text_center = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ]
                            ];
                             $style_text_center_color = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ],
                                'font' => array(
                                    'color' => ['argb' => '69725c'],
                                )
                            ];

                        $style_color = [
                                'font' => array(
                                    'color' => ['argb' => 'EB2B02'],
                                )
                            ];
                            $style_font = [
                                'font' => array(
                                    'name'      =>  'Calibri',
                                    'size'      =>  15,
                                    'bold'      =>  true
                                )
                            ];
                            $last_column = Coordinate::stringFromColumnIndex(11);
                            // calculate last row + 1 (total results + header rows + column headings row + new row)
                                $last_row = count(explode(",",$this->id)) + 6 + 1 + 1;
                            //dd($last_row);
                            $event->sheet->insertNewRowBefore(1, 6);
                            $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
                            $event->sheet->mergeCells(sprintf('A2:%s2',$last_column));
                            $event->sheet->mergeCells(sprintf('A3:%s3',$last_column));
                            $event->sheet->mergeCells(sprintf('A4:%s4',$last_column));
                            $event->sheet->mergeCells(sprintf('A5:%s5',$last_column));
                            $event->sheet->mergeCells(sprintf('A6:%s6',$last_column));
                            $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,$last_column,$last_row));
                            // assign cell values
                            $event->sheet->setCellValue('A1','YUVA SURAKSHA KAVACH');
                            $event->sheet->setCellValue('A2','501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD. ');
                            $event->sheet->setCellValue('A3','MO: 7575898989, 8575898989 | EMAIL: OFFICEYSK@GMAIL.COM');
                            if($this->allSearch != 0){
                                $event->sheet->setCellValue('A4','Up to Date:'.$this->allSearch[0].' to '.$this->allSearch[1].'');
                            
                                $event->sheet->setCellValue('A5','COUNCIL: '.$this->allSearch[2].'  | SAMAJ ZONE: '.$this->allSearch[3].' | REGION : '.$this->allSearch[4].' | DIVISION NAME: '.$this->allSearch[5].' | YUVAMANDAL NAME: '.$this->allSearch[6].' | AGE GROUP: '.$this->allSearch[7].' | GENDER: '.$this->allSearch[8].'| Status: '.$this->allSearch[9].'| OPTION : 1. WITH APPLY DATE/PID');
                                 $event->sheet->setCellValue('A6',''.$this->allSearch[10].' - Member List');
                            }
                            ///$event->sheet->setCellValue(sprintf('A%d',$last_row),'SECURITY CLASSIFICATION - UNCLASSIFIED [Generated: ...]');

                            // assign cell styles
                            $event->sheet->getStyle('A1:A1')->applyFromArray($style_font);
                            $event->sheet->getStyle('A5:A5')->applyFromArray($style_color);
                            $event->sheet->getStyle('A6:A6')->applyFromArray($style_text_center_color);
                            $event->sheet->getStyle('A1:A4')->applyFromArray($style_text_center);
                            $event->sheet->getStyle(sprintf('A%d',$last_row))->applyFromArray($style_text_center);
                            /*$event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A1","YUVA SURAKSHA KAVACH");
                            $event->sheet->setCellValue("K1", "");

                            $event->sheet->getStyle("A2:K2")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A2","501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD.");
                            $event->sheet->setCellValue("K2", "");*/
                        /*}*/
                      //  $event->sheet->getDelegate()->mergeCells("A{$event->sheet->getHighestRow()}:F{$event->sheet->getHighestRow()}");
                       // $event->sheet->setCellValue('G'. ($event->sheet->getHighestRow()),5);
                    }
            ];
        }
        if($this->idExport == 5){
            $styleTitulos = [
                        'font' => [
                            'bold' => true,
                            'size' => 12
                        ]
                    ];
            return [
                    
                    // Handle by a closure.
                    BeforeExport::class => function(BeforeExport $event) {
                        $event->writer->getProperties()->setCreator('Sistema de alquileres');
                    },
                    AfterSheet::class => function(AfterSheet $event) use ($styleTitulos){
                        $event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos);
                        //$event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()+1),"Total");
                        /*foreach ($this->filas as $index => $fila){
                            $fila++;*/
                            $style_text_center = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ]
                            ];
                             $style_text_center_color = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ],
                                'font' => array(
                                    'color' => ['argb' => '69725c'],
                                )
                            ];

                        $style_color = [
                                'font' => array(
                                    'color' => ['argb' => 'EB2B02'],
                                )
                            ];
                            $style_font = [
                                'font' => array(
                                    'name'      =>  'Calibri',
                                    'size'      =>  15,
                                    'bold'      =>  true
                                )
                            ];
                            $last_column = Coordinate::stringFromColumnIndex(11);
                            // calculate last row + 1 (total results + header rows + column headings row + new row)
                                $last_row = count(explode(",",$this->id)) + 6 + 1 + 1;
                            //dd($last_row);
                            $event->sheet->insertNewRowBefore(1, 6);
                            $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
                            $event->sheet->mergeCells(sprintf('A2:%s2',$last_column));
                            $event->sheet->mergeCells(sprintf('A3:%s3',$last_column));
                            $event->sheet->mergeCells(sprintf('A4:%s4',$last_column));
                            $event->sheet->mergeCells(sprintf('A5:%s5',$last_column));
                            $event->sheet->mergeCells(sprintf('A6:%s6',$last_column));
                            $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,$last_column,$last_row));
                            // assign cell values
                            $event->sheet->setCellValue('A1','YUVA SURAKSHA KAVACH');
                            $event->sheet->setCellValue('A2','501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD. ');
                            $event->sheet->setCellValue('A3','MO: 7575898989, 8575898989 | EMAIL: OFFICEYSK@GMAIL.COM');
                            if($this->allSearch != 0){
                                $event->sheet->setCellValue('A4','Up to Date:'.$this->allSearch[0].' to '.$this->allSearch[1].'');
                            
                                $event->sheet->setCellValue('A5','COUNCIL: '.$this->allSearch[2].'  | SAMAJ ZONE: '.$this->allSearch[3].' | REGION : '.$this->allSearch[4].' | DIVISION NAME: '.$this->allSearch[5].' | YUVAMANDAL NAME: '.$this->allSearch[6].' | AGE GROUP: '.$this->allSearch[7].' | GENDER: '.$this->allSearch[8].'| OPTION : 1. WITH APPLY DATE/PID');
                                 $event->sheet->setCellValue('A6',''.$this->allSearch[9].' - Member List');
                            }
                            ///$event->sheet->setCellValue(sprintf('A%d',$last_row),'SECURITY CLASSIFICATION - UNCLASSIFIED [Generated: ...]');

                            // assign cell styles
                            $event->sheet->getStyle('A1:A1')->applyFromArray($style_font);
                            $event->sheet->getStyle('A5:A5')->applyFromArray($style_color);
                            $event->sheet->getStyle('A6:A6')->applyFromArray($style_text_center_color);
                            $event->sheet->getStyle('A1:A4')->applyFromArray($style_text_center);
                            $event->sheet->getStyle(sprintf('A%d',$last_row))->applyFromArray($style_text_center);
                            /*$event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A1","YUVA SURAKSHA KAVACH");
                            $event->sheet->setCellValue("K1", "");

                            $event->sheet->getStyle("A2:K2")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A2","501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD.");
                            $event->sheet->setCellValue("K2", "");*/
                        /*}*/
                      //  $event->sheet->getDelegate()->mergeCells("A{$event->sheet->getHighestRow()}:F{$event->sheet->getHighestRow()}");
                       // $event->sheet->setCellValue('G'. ($event->sheet->getHighestRow()),5);
                    }
            ];
        }
        if($this->idExport == 6){
            $styleTitulos = [
                        'font' => [
                            'bold' => true,
                            'size' => 12
                        ]
                    ];
            return [
                    
                    // Handle by a closure.
                    BeforeExport::class => function(BeforeExport $event) {
                        $event->writer->getProperties()->setCreator('Sistema de alquileres');
                    },
                    AfterSheet::class => function(AfterSheet $event) use ($styleTitulos){
                        $event->sheet->getStyle("A1:Z1")->applyFromArray($styleTitulos);
                        //$event->sheet->setCellValue('A'. ($event->sheet->getHighestRow()+1),"Total");
                        /*foreach ($this->filas as $index => $fila){
                            $fila++;*/
                            $style_text_center = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ]
                            ];
                             $style_text_center_color = [
                                'alignment' => [
                                    'horizontal' => Alignment::HORIZONTAL_CENTER
                                ],
                                'font' => array(
                                    'color' => ['argb' => '69725c'],
                                )
                            ];

                        $style_color = [
                                'font' => array(
                                    'color' => ['argb' => 'EB2B02'],
                                )
                            ];
                            $style_font = [
                                'font' => array(
                                    'name'      =>  'Calibri',
                                    'size'      =>  15,
                                    'bold'      =>  true
                                )
                            ];
                            $last_column = Coordinate::stringFromColumnIndex(19);
                            // calculate last row + 1 (total results + header rows + column headings row + new row)
                                $last_row = count(explode(",",$this->id)) + 6 + 1 + 1;
                            //dd($last_row);
                            $event->sheet->insertNewRowBefore(1, 6);
                            $event->sheet->mergeCells(sprintf('A1:%s1',$last_column));
                            $event->sheet->mergeCells(sprintf('A2:%s2',$last_column));
                            $event->sheet->mergeCells(sprintf('A3:%s3',$last_column));
                            $event->sheet->mergeCells(sprintf('A4:%s4',$last_column));
                            $event->sheet->mergeCells(sprintf('A5:%s5',$last_column));
                            $event->sheet->mergeCells(sprintf('A6:%s6',$last_column));
                            $event->sheet->mergeCells(sprintf('A%d:%s%d',$last_row,$last_column,$last_row));
                            // assign cell values
                            $event->sheet->setCellValue('A1','YUVA SURAKSHA KAVACH');
                            $event->sheet->setCellValue('A2','501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD. ');
                            $event->sheet->setCellValue('A3','MO: 7575898989, 8575898989 | EMAIL: OFFICEYSK@GMAIL.COM');
                            if($this->allSearch != 0){
                                $event->sheet->setCellValue('A4','Up to Date:'.$this->allSearch[0].' to '.$this->allSearch[1].'');
                            
                                $event->sheet->setCellValue('A5','COUNCIL: '.$this->allSearch[2].'  | SAMAJ ZONE: '.$this->allSearch[3].' | REGION : '.$this->allSearch[4].' | DIVISION NAME: '.$this->allSearch[5].' | YUVAMANDAL NAME: '.$this->allSearch[6].' | AGE GROUP: '.$this->allSearch[7].' | GENDER: '.$this->allSearch[8].' | OPTION : 1. WITH APPLY DATE/PID');
                                 $event->sheet->setCellValue('A6',''.$this->allSearch[9].' - Member List');
                            }
                            ///$event->sheet->setCellValue(sprintf('A%d',$last_row),'SECURITY CLASSIFICATION - UNCLASSIFIED [Generated: ...]');

                            // assign cell styles
                            $event->sheet->getStyle('A1:A1')->applyFromArray($style_font);
                            $event->sheet->getStyle('A5:A5')->applyFromArray($style_color);
                            $event->sheet->getStyle('A6:A6')->applyFromArray($style_text_center_color);
                            $event->sheet->getStyle('A1:A4')->applyFromArray($style_text_center);
                            $event->sheet->getStyle(sprintf('A%d',$last_row))->applyFromArray($style_text_center);
                            /*$event->sheet->getStyle("A1:K1")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A1","YUVA SURAKSHA KAVACH");
                            $event->sheet->setCellValue("K1", "");

                            $event->sheet->getStyle("A2:K2")->applyFromArray($styleTitulos)->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('FFF');
                            $event->sheet->setCellValue("A2","501-504, NARODA BUSINESS HUB, RING ROAD DEHAGAM CIRCLE TO NARODA, HANSPURA-NARODA, AMADAVAD.");
                            $event->sheet->setCellValue("K2", "");*/
                        /*}*/
                      //  $event->sheet->getDelegate()->mergeCells("A{$event->sheet->getHighestRow()}:F{$event->sheet->getHighestRow()}");
                       // $event->sheet->setCellValue('G'. ($event->sheet->getHighestRow()),5);
                    }
            ];
        }
    }
    public function title(): string
    {
       
            return 'Some Text';
        
    }
}

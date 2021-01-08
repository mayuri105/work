<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



/*Route::get('/', function () {

    return view('elements/login_master');

});*/

Route::get('/mac', 'LoginController@mac')->name('mac');

// Login

Route::get('/', 'LoginController@login')->name('login');
Route::get('/userpanel', 'LoginController@userLogin')->name('userpanel');
Route::post('login-authentication', 'LoginController@loginAuthentications')->name('login-authentication');

Route::post('user-login-authentication', 'LoginController@userLoginAuthentications')->name('user-login-authentication');


Route::get('logout', 'LoginController@logout')->name('logout');

Route::get('otp-verification', 'LoginController@otpVerification')->name('otp-verification');

Route::post('otp-authentication', 'LoginController@otpAuthentication')->name('otp-authentication');







Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');

Route::get('dashboard-1', 'DashboardController@dashboard1')->name('dashboard1');

Route::get('role-list', 'RoleController@role')->name('role-list');

Route::get('add-role','RoleController@addRole')->name('add-role');

Route::post('/save-role-data','RoleController@saveRoleData')->name('save-role-data');

Route::get('/edit-role/{role_id}','RoleController@editRole')->name('edit-role');

Route::post('/update-role','RoleController@updateRole')->name('update-role');

Route::get('/delete-role/{role_id}','RoleController@deleteRole')->name('delete-role');

Route::post('/multiple-Delete','RoleController@multipleDeleteRole')->name('multiple-Delete');



/*Role Permission*/

Route::get('/list-role-permission','RolePermissionController@listRolePermission')->name('list-role-permission');

Route::get('/add-role-permission','RolePermissionController@addRolePermission')->name('add-role-permission');

Route::post('/save-role-permission','RolePermissionController@saveRolePermission')->name('save-role-permission');

Route::get('/edit-role-permission/{role_id}','RolePermissionController@editRolePermission')->name('edit-role-permission');

Route::post('/update-role-permission','RolePermissionController@updateRolePermission')->name('update-role-permission');

Route::get('/delete-role-permission/{id}','RolePermissionController@deleteRolePermission');

Route::post('/delete-multiple-role-permission','RolePermissionController@multipleDeleteRolePermission')->name('delete-multiple-role-permission');





/*Death Type*/

Route::get('/death-type','DeathTypeController@deathType')->name('death-type');

Route::get('/add-death-type','DeathTypeController@addDeathType')->name('add-death-type');

Route::post('/save-death-type-data','DeathTypeController@saveDeathType')->name('save-death-type-data');

Route::get('/edit-death-type/{death_type_id}','DeathTypeController@editDeathType')->name('edit-death-type');

Route::post('/update-death-type','DeathTypeController@updateDeathType')->name('update-death-type');

Route::get('/delete-death-type/{death_type_id}','DeathTypeController@deleteDeathType')->name('delete-death-type');

Route::post('/delete-multiple-death-type','DeathTypeController@multipleDeleteDeathType')->name('delete-multiple-death-type');





/*Death Type Amount*/

Route::get('/sahyognidhi-amount','SahyognidhiAmountController@sahyognidhiAmount')->name('sahyognidhi-amount');

Route::get('/add-sahyognidhi-amount','SahyognidhiAmountController@addSahyognidhiAmount')->name('add-sahyognidhi-amount');

Route::post('/save-sahyognidhi-amount','SahyognidhiAmountController@saveSahyognidhiAmount')->name('save-sahyognidhi-amount');

Route::get('/edit-sahyognidhi-amount/{sahyognidhi_amount_id}','SahyognidhiAmountController@editSahyognidhiAmount')->name('edit-sahyognidhi-amount');

Route::post('/update-sahyognidhi-amount','SahyognidhiAmountController@updateSahyognidhiAmount')->name('update-sahyognidhi-amount');

Route::get('/delete-sahyognidhi-amount/{sahyognidhi_amount_id}','SahyognidhiAmountController@deleteSahyognidhiAmount')->name('delete-sahyognidhi-amount');

Route::post('/multiple-delete-sahyognidhi-amount','SahyognidhiAmountController@multipleDeleteSahyognidhiAmount')->name('multiple-delete-sahyognidhi-amount');





/*Bank Details*/

Route::get('/bank-details','BankDetailsController@bankDetails')->name('bank-details');

Route::get('/switch-bank-details/{bank_detail_id}','BankDetailsController@defaultBankAccountStatus')->name('switch-bank-details');

Route::get('/add-bank-details','BankDetailsController@addBankDetails')->name('add-bank-details');

Route::post('/save-bank-details','BankDetailsController@saveBankDetails')->name('save-bank-details');

Route::get('/edit-bank-details/{bank_detail_id}','BankDetailsController@editBankDetails')->name('edit-bank-details');

Route::post('/update-bank-details','BankDetailsController@updateBankDeatils')->name('update-bank-details');

Route::get('/delete-bank-details/{bank_detail_id}','BankDetailsController@deleteBankDetails')->name('delete-bank-details');

Route::post('/multiple-delete-bank-details','BankDetailsController@multipleDeleteBankDetails')->name('multiple-delete-bank-details');





/*Bank Charges*/

Route::get('/bank-charge','BankChargeController@bankCharges')->name('bank-charge');

Route::get('/add-bank-charges','BankChargeController@addBankCharges')->name('add-bank-charges');

Route::post('/save-bank-charges','BankChargeController@saveBankCharges')->name('save-bank-charges');

Route::get('/edit-bank-charges/{bank_charges_id}','BankChargeController@editBankCharge')->name('edit-bank-charges');

Route::post('/update-bank-charges','BankChargeController@updateBankCharge')->name('update-bank-charges');

Route::get('/delete-bank-charges/{bank_charges_id}','BankChargeController@deleteBankCharge')->name('delete-bank-charges');

Route::post('/delete-multiple-bank-charges','BankChargeController@multipleDeleteBankCharge')->name('delete-multiple-bank-charges');





/*ACH Charges*/

Route::get('/ach-charges','AchChargeController@achCharges')->name('ach-charges');

Route::get('/add-ach-charges','AchChargeController@addAchCharges')->name('add-ach-charges');

Route::post('/save-ach-charge-amount','AchChargeController@saveAchChargeAmount')->name('save-ach-charge-amount');

Route::get('/edit-ach-charge-amount/{ach_charge_id}','AchChargeController@editAchCharge')->name('edit-ach-charge-amount');

Route::post('/update-ach-charge-amount','AchChargeController@updateAchCharge')->name('update-ach-charge-amount');

Route::get('/delete-ach-charge-amount/{ach_charge_id}','AchChargeController@deleteAchCharge')->name('delete-ach-charge-amount');

Route::post('/multiple-delete-ach-charge-amount','AchChargeController@multipleDeleteAchCharge')->name('multiple-delete-ach-charge-amount');





/*Re payment date*/

//Route::get('/re-payment-dates','YuvaSanghController@rePaymentDate')->name('re-payment-dates');





/*Reserve Funds*/

Route::get('/reserve-funds','ReservedFundsController@reserveFunds')->name('reserve-funds');

Route::get('/add-reserved-funds','ReservedFundsController@addReserveFunds')->name('add-reserved-funds');

Route::post('/save-reserve-funds','ReservedFundsController@saveReserveFunds')->name('save-reserve-funds');

Route::get('/edit-reserve-funds/{reserved_fund_id}','ReservedFundsController@editReserveFunds')->name('edit-reserve-funds');

Route::post('/update-reserve-funds','ReservedFundsController@updateReserveFunds')->name('update-reserve-funds');

Route::get('/delete-reserve-funds/{reserved_fund_id}','ReservedFundsController@deleteReserveFunds')->name('delete-reserve-funds');

Route::post('/multiple-delete-reserved-funds','ReservedFundsController@multipleDeleteReserveFunds')->name('multiple-delete-reserved-funds');





/*District*/

Route::get('/district','DistrictController@district')->name('district');

Route::get('/add-district','DistrictController@addDistrict')->name('add-district');

Route::post('/save-district','DistrictController@saveDistrict')->name('save-district');

Route::get('/edit-district/{district_id}','DistrictController@editDistrict')->name('edit-district');

Route::post('/update-district','DistrictController@updateDistrict')->name('update-district');

Route::get('/delete-district/{district_id}','DistrictController@deleteDistrict')->name('delete-district');

Route::post('/multiple-delete-district','DistrictController@multipleDeleteDistrict')->name('multiple-delete-district');





/*District Area*/

Route::get('/district-area','DistrictAreaController@districtArea')->name('district-area');

Route::get('/add-district-area','DistrictAreaController@addDistrictArea')->name('add-district-area');

Route::post('/save-district-area','DistrictAreaController@saveDistrictArea')->name('save-district-area');

Route::get('/edit-district-area/{area_id}','DistrictAreaController@editDistrictArea')->name('edit-district-area');

Route::post('/update-district-area','DistrictAreaController@updateDistrictArea')->name('update-district-area');

Route::get('/delete-district-area/{area_id}','DistrictAreaController@deleteDistrictArea')->name('delete-district-area');

Route::post('/multiple-delete-district-area','DistrictAreaController@multipleDeleteDistrictArea')->name('multiple-delete-district-area');







/*Expense Type*/

Route::get('/expense-type','ExpenseTypeController@expenseType')->name('expense-type');

Route::get('/add-expense-type','ExpenseTypeController@addExpenseType')->name('add-expense-type');

Route::post('/save-expense-type','ExpenseTypeController@saveExpenseType')->name('save-expense-type');

Route::get('/edit-expense-type/{expense_type_id}','ExpenseTypeController@editExpenseType')->name('edit-expense-type');

Route::post('/update-expense-type','ExpenseTypeController@updateExpenseType')->name('update-expense-type');

Route::get('/delete-expense-type/{expense_type_id}','ExpenseTypeController@deleteExpenseType')->name('delete-expense-type');

Route::post('/multiple-delete-expense-type','ExpenseTypeController@multipleDeleteExpenseType')->name('multiple-delete-expense-type');





/*Income Type*/

Route::get('/income-type','IncomeTypeController@incomeType')->name('income-type');

Route::get('/add-income-type','IncomeTypeController@addIncomeType')->name('add-income-type');

Route::post('/save-income-type','IncomeTypeController@saveIncomeType')->name('save-income-type');

Route::get('/edit-income-type/{income_type_id}','IncomeTypeController@editIncomeType')->name('edit-income-type');

Route::post('/update-income-type','IncomeTypeController@updateIncomeType')->name('update-income-type');

Route::get('/delete-income-type/{income_type_id}','IncomeTypeController@deleteIncomeType')->name('delete-income-type');

Route::post('/delete-multiple-income-type','IncomeTypeController@multipleDeleteIncomeType')->name('delete-multiple-income-type');





/*Registration Fees*/

Route::get('/registration-fees','RegistrationFeesController@registrationFees')->name('registration-fees');

Route::get('/add-registration-fees','RegistrationFeesController@addRegistrationFees')->name('add-registration-fees');

Route::post('/save-registration-fees','RegistrationFeesController@saveRegistrationFees')->name('save-registration-fees');

Route::get('/edit-registration-fees/{registration_fees_id}','RegistrationFeesController@editRegistrationFees')->name('edit-registration-fees');

Route::post('/update-registration-fees','RegistrationFeesController@updateRegistrationFees')->name('update-registration-fees');

Route::get('/delete-registration-fees/{registration_fees_id}','RegistrationFeesController@deleteRegistrationFees')->name('delete-registration-fees');

Route::post('/delete-multiple-registration-fees','RegistrationFeesController@multipleDeleteRegistrationFees')->name('delete-multiple-registration-fees');

Route::get('/registration-fees-details/{registration_fees_id}','RegistrationFeesController@detailsRegistrationFees')->name('registration-fees-details');





/*Regions*/

Route::get('/region','RegionsController@region')->name('region');

Route::get('/add-region','RegionsController@addRegion')->name('add-region');

Route::post('/save-region','RegionsController@saveRegion')->name('save-region');

Route::get('/edit-region/{region_id}','RegionsController@editRegion')->name('edit-region');

Route::post('/update-region','RegionsController@updateRegion')->name('update-region');

Route::get('/delete-region/{region_id}','RegionsController@deleteRegion')->name('delete-region');

Route::post('/multiple-delete-region','RegionsController@multipleDeleteRegion')->name('multiple-delete-region');





/*Samaj Zone*/

Route::get('/samaj-zone','SamajZoneController@samajZone')->name('samaj-zone');

Route::get('/add-samaj-zone','SamajZoneController@addSmajZone')->name('add-samaj-zone');

Route::post('/save-samaj-zone','SamajZoneController@saveSmajZones')->name('save-samaj-zone');

Route::get('/edit-samaj-zone/{samaj_zone_id}','SamajZoneController@editSamajZone')->name('edit-samaj-zone');

Route::post('/update-samaj-zone','SamajZoneController@updateSamajZone')->name('update-samaj-zone');

Route::get('/delete-samaj-zone/{samaj_zone_id}','SamajZoneController@deleteSamajZone')->name('delete-samaj-zone');

Route::post('/delete-multiple-samaj-zone','SamajZoneController@multipleDeleteSamajZone')->name('delete-multiple-samaj-zone');





/*Yuva Mandal Number*/

Route::get('/yuva-mandal-number','YuvaMandalController@yuvaMandalNumber')->name('yuva-mandal-number');

Route::get('/add-yuva-mandal-number','YuvaMandalController@addYuvaMandalNumber')->name('add-yuva-mandal-number');

Route::post('/save-yuva-mandal-number','YuvaMandalController@saveYuvaMandalNumber')->name('save-yuva-mandal-number');

Route::get('edit-yuva-mandal-number/{yuva_mandal_number_id}','YuvaMandalController@editYuvaMandalNumber')->name('edit-yuva-mandal-number');

Route::post('/update-yuva-mandal-number','YuvaMandalController@updateYuvaMandalNumber')->name('update-yuva-mandal-number');

Route::get('/delete-yuva-mandal-number/{yuva_mandal_number_id}','YuvaMandalController@deleteYuvaMandalNumber')->name('delete-yuva-mandal-number');

Route::post('/multiple-delete-yuva-mandal-number','YuvaMandalController@multipleYuvaMandalNumber')->name('multiple-delete-yuva-mandal-number');

Route::post('/get-region-data-by-id','YuvaMandalController@getSamajZoneDataByRegionID')->name('get-region-data-by-id');





/* Courier Company */

Route::get('/courier-company','CourierCompanyController@courierCompanyDetails')->name('courier-company');

Route::get('/add-courier-company','CourierCompanyController@addCourierCompanyDetails')->name('add-courier-company');

Route::post('/save-courier-company','CourierCompanyController@saveCourierComapnyDetails')->name('save-courier-company');

Route::get('/edit-courier-company/{courier_company_id}','CourierCompanyController@editCourierCompanyDetails')->name('edit-courier-company');

Route::post('/update-courier_company','CourierCompanyController@updateCourierCompanyDetails')->name('update-courier_company');

Route::get('/default-courier-status/{courier_company_id}','CourierCompanyController@changeDefaltCourierStatus')->name('default-courier-status');

Route::get('/default-courier-status-deactive/{courier_company_id}','CourierCompanyController@deactiveStatus')->name('default-courier-status-deactive');

Route::get('/delete-courier-company/{courier_company_id}','CourierCompanyController@deleteCourierCompanyDetails')->name('edit-courier-company');

Route::post('/multiple-delete-courier-company','CourierCompanyController@multipleDeleteCourierCompanyDetails')->name('multiple-delete-courier-company');





/*Disease*/

Route::get('/disease','DiseaseController@disease')->name('disease');

Route::get('/add-disease','DiseaseController@addDisease')->name('add-disease');

Route::post('/save-disease','DiseaseController@saveDisease')->name('save-disease');

Route::get('/edit-disease/{disease_id}','DiseaseController@editDisease')->name('edit-disease');

Route::post('/update-disease','DiseaseController@updateDisease')->name('update-disease');

Route::get('/delete-disease/{disease_id}','DiseaseController@deleteDisease')->name('delete-disease');

Route::post('/multiple-delete-disease','DiseaseController@multipleDeleteDisease')->name('multiple-delete-disease');







/*Registration*/

Route::get('/registration','RegistrationController@registration')->name('registration');

Route::get('/registration-test/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{processingid?}/{yskname?}/{yskidnew?}/{yskidnewpre?}','RegistrationController@registrationTest')->name('registration-test');

Route::get('/add-registration','RegistrationController@addRegistration')->name('add-registration');

Route::post('/get-samaj-zone-by-region-id','RegistrationController@getSamajZoneByRegionId')->name('get-samaj-zone-by-region-id');

Route::post('/get-yuva-mandal-number-by-samaj-zone','RegistrationController@getYuvaMandalBySamajZoneId')->name('get-yuva-mandal-number-by-samaj-zone');

Route::post('/save-registration','RegistrationController@saveRegistration')->name('save-registration');

Route::get('/save-ysk-id','RegistrationController@generateYskId')->name('save-ysk-id');

//Route::get('/edit','RegistrationController@edit')->name('edit');

Route::get('/edit-registration/{registration_id}','RegistrationController@editRegistration')->name('edit-registration');

Route::post('/update-registration','RegistrationController@updateRegistration')->name('update-registration');

Route::get('/delete-registration/{registration_id}','RegistrationController@deleteRegistration')->name('delete-registration');

Route::post('/multiple-delete-registration','RegistrationController@multipleDeleteRegistration')->name('multiple-delete-registration');

Route::get('/details-registrationstatus/{registration_id}','RegistrationController@detailsRegistration')->name('details-registrationstatus');

Route::post('/get-data-by-family-id','RegistrationController@getDataByFamilyId')->name('get-data-by-family-id');

Route::post('/get-data-by-first-nominee-family-id','RegistrationController@getDataByFirstNomineeFamilyId')->name('get-data-by-first-nominee-family-id');

Route::post('/get-data-by-second-nominee-family-id','RegistrationController@getDataBySecondNomineeFamilyId')->name('get-data-by-second-nominee-family-id');

Route::post('/get-data-by-member-id','RegistrationController@getDataByMemberId')->name('get-data-by-member-id');

Route::post('/get-first-nominee-data','RegistrationController@getFirstNomineeData')->name('get-first-nominee-data');

Route::post('/get-second-nominee-data','RegistrationController@getSecondNomineeData')->name('get-second-nominee-data');

Route::post('/find-age','RegistrationController@findAgeByDateOfBirth')->name('find-age');

Route::post('/tooltip-status','RegistrationController@tooltipStatus')->name('tooltip-status');

Route::post('/tooltip-status-all','RegistrationController@tooltipStatusAll')->name('tooltip-status-all');

Route::get('/payment-details/{registration_id}','RegistrationController@paymentDetails')->name('payment-details');

Route::get('delete-upload-document/{registration_document_id}','RegistrationController@deleteUploadDocument')->name('delete-upload-document');

Route::post('/insert-image-during-preview','RegistrationController@insertImage')->name('insert-image-during-preview');

Route::post('/delete-temp-image','RegistrationController@deleteImage')->name('delete-temp-image');



/*Minor Account*/

Route::get('minor-account','MinorAccountController@minorAccount')->name('minor-account');

Route::get('change-minor-account','MinorAccountController@changeMinorAccount')->name('change-minor-account');

Route::get('delete-minor-account/{registration_id}','MinorAccountController@deleteMinorAccount')->name('delete-minor-account');

Route::post('/multiple-delete-minor-account','MinorAccountController@multipleDeleteMinorAccount')->name('multiple-delete-minor-account');



/*Check Clearence*/

Route::get('/check-clearence','CheckClearenceController@checkClearence')->name('check-clearence');

Route::get('/save-check-clearence','CheckClearenceController@saveCheckClearence')->name('save-check-clearence');

Route::get('/save-check-clearence-of-sahyognidhi','CheckClearenceController@saveSahyognidhiCheckClearence')->name('save-check-clearence-of-sahyognidhi');





/*Registration Donation*/

Route::get('/registration-donation','RegistrationDonationController@registrationDonation')->name('registration-donation');

Route::get('/add-registration-donation','RegistrationDonationController@addRegistrationDonation')->name('add-registration-donation');

Route::post('/save-registration-donation','RegistrationDonationController@saveRegistrationDonation')->name('save-registration-donation');

Route::get('/edit-registration-donation/{registration_donation_id}','RegistrationDonationController@editRegistrationDonation')->name('edit-registration-donation');

Route::post('/update-registration-donation','RegistrationDonationController@updateRegistrationDonation')->name('update-registration-donation');

Route::get('/delete-registration-donation/{registration_donation_id}','RegistrationDonationController@deleteRegistrationDonation')->name('delete-registration-donation');

Route::post('/multiple-delete-registration-donation','RegistrationDonationController@multipleDeleteRegistrationDonation')->name('multiple-delete-registration-donation');







/*Repayment Donation*/

Route::get('/repayment-donation','RepaymentDonationController@repaymentDonation')->name('repayment-donation');

Route::get('/add-repayment-donation','RepaymentDonationController@addRepaymentDonation')->name('add-repayment-donation');

Route::post('/save-repayment-donation','RepaymentDonationController@saveRepaymentDonation')->name('save-repayment-donation');

Route::get('/edit-repayment-donation/{repayment_donations_id}','RepaymentDonationController@editRepaymentDonation')->name('edit-repayment-donation');

Route::post('/update-repayment-donation','RepaymentDonationController@updateRepaymentDonation')->name('update-repayment-donation');

Route::get('/delete-repayment-donation/{repayment_donations_id}','RepaymentDonationController@deleteRepaymentDonation')->name('delete-repayment-donation');

Route::post('/multiple-delete-repayment-donation','RepaymentDonationController@multipleDeleteRepaymentDonation')->name('multiple-delete-repayment-donation');





/*Locking Period*/

Route::get('/locking-period','LockingPeriodController@lockingPeriod')->name('locking-period');

Route::get('/add-locking-period','LockingPeriodController@addLockingPeriod')->name('add-locking-period');

Route::post('/save-locking-period','LockingPeriodController@saveLockingPeriod')->name('save-locking-period');

Route::get('/edit-locking-period/{locking_period_id}','LockingPeriodController@editLockingPeriod')->name('edit-locking-period');

Route::post('/update-locking-period','LockingPeriodController@updateLockingPeriod')->name('update-locking-period');

Route::get('/delete-locking-period/{locking_period_id}','LockingPeriodController@deleteLockingPeriod')->name('delete-locking-period');

Route::post('/multiple-delete-locking-period','LockingPeriodController@multipleDeleteLockingPeriod')->name('multiple-delete-locking-period');





/*Late fees amount*/

Route::get('/late-fees-amount','LateFeesAmountController@lateFeesAmount')->name('late-fees-amount');

Route::get('/add-late-fees-amount','LateFeesAmountController@addLateFeesAmount')->name('add-late-fees-amount');

Route::post('/save-late-fees-amount','LateFeesAmountController@saveLateFeesAmount')->name('save-late-fees-amount');

Route::get('/edit-late-fees-amount/{late_fees_amount_id}','LateFeesAmountController@editLateFeesAmount')->name('edit-late-fees-amount');

Route::post('/update-late-fees-amount','LateFeesAmountController@updateLateFeesAmount')->name('update-late-fees-amount');

Route::get('/delete-late-fees-amount/{late_fees_amount_id}','LateFeesAmountController@deleteLateFeesAmount')->name('delete-late-fees-amount');

Route::post('/multiple-delete-late-fees-amount','LateFeesAmountController@multipleDeleteLateFeesAmount')->name('multiple-delete-late-fees-amount');



/*Courier*/
Route::get('/courier','CourierController@courier')->name('courier');
Route::get('/add-courier','CourierController@addCourier')->name('add-courier');
Route::get('/add-courier-for-registration-sahyognidhi/{id}','CourierController@addForRegistrationSahyognidhi')->name('add-courier-for-registration-sahyognidhi');
Route::post('/get-name-by-ysk-id','CourierController@getNameByYskId')->name('get-name-by-ysk-id');
Route::post('/save-courier','CourierController@saveCourier')->name('save-courier');
Route::get('/edit-courier/{courier_id}','CourierController@editCourier')->name('edit-courier');
Route::post('/update-courier','CourierController@updateCourier')->name('update-courier');
Route::get('/details-courier/{courier_id}','CourierController@courierDetails')->name('details-courier');
Route::get('/delete-courier/{courier_id}','CourierController@deleteCourier')->name('delete-courier');
Route::post('/multiple-delete-courier','CourierController@multipleDeleteCourier')->name('multiple-delete-courier');
Route::get('delete-courier-upload-document/{courier_document_id}','CourierController@deleteCourierUploadDocument')->name('delete-courier-upload-document');





/*Ach*/

//Route::get('/ach','AchController@ach')->name('ach');
Route::get('/ach/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}','AchController@ach')->name('ach');

Route::any('ach-excel-id/{id}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}', 'AchController@ACHexcelid')->name('ach-excel-id');

Route::any('/ach-excel-id-all/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}','AchController@ACHexcelidAll')->name('ach-excel-id-all');

Route::get('/add-ach','AchController@addAch')->name('add-ach');

Route::post('/data-by-ysk-id','AchController@getDataByYskId')->name('data-by-ysk-id');

Route::post('/save-ach','AchController@saveAch')->name('save-ach');

Route::post('/generate-urmn-number','AchController@urmnNumber')->name('generate-urmn-number');

Route::get('/edit-ach/{ach_id}','AchController@editAch')->name('edit-ach');

Route::post('/update-ach','AchController@updateAch')->name('update-ach');

Route::get('/view-ach/{ach_id}','AchController@viewAch')->name('view-ach');

Route::get('/delete-ach/{ach_id}','AchController@deleteAch')->name('delete-ach');

Route::post('/multiple-delete-ach','AchController@multipleDeleteAch')->name('multiple-delete-ach');

Route::post('/change-ach-status','AchController@changeAchStatus')->name('change-ach-status');

Route::post('/change-multiple-ach-status','AchController@changeMultipleStatus')->name('change-multiple-ach-status');









/*Sahyognidhi Request*/

Route::get('/sahyognidhi-request/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{status2?}','SahyognidhiRequestController@sahyognidhiRequest')->name('sahyognidhi-request');

Route::any('sayognidhi-request-excel/{id}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{status2?}', 'SahyognidhiRequestController@SayognidhiExcel')->name('sayognidhi-request-excel');
Route::any('/sayognidhi-request-excel-all/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{status2?}','SahyognidhiRequestController@SayognidhiExcelAll')->name('sayognidhi-request-excel-all');



Route::get('/add-sahyognidhi-request','SahyognidhiRequestController@addSahyognidhiRequest')->name('add-sahyognidhi-request');

Route::post('/data-by-first-family-id','SahyognidhiRequestController@dataByFirstNomineeFamilyId')->name('data-by-first-family-id');

Route::post('/data-by-second-family-id','SahyognidhiRequestController@dataBySecondNomineeFamilyId')->name('data-by-second-family-id');

Route::post('/get-first-nominee-data-by-family-id','SahyognidhiRequestController@getFirstNomineeDataByFamilyId')->name('get-first-nominee-data-by-family-id');

Route::post('/get-second-nominee-data-by-family-id','SahyognidhiRequestController@getSecondNomineeDataByFamilyId')->name('get-second-nominee-data-by-family-id');

Route::post('/save-sahyognidhi-request','SahyognidhiRequestController@saveSahyognidhiRequest')->name('save-sahyognidhi-request');

Route::post('/get-data-by-ysk-id','SahyognidhiRequestController@getDataByYskId')->name('get-data-by-ysk-id');

Route::get('/edit-sahyognidhi-request/{sahyognidhi_id}','SahyognidhiRequestController@editSahyognidhiRequest')->name('edit-sahyognidhi-request');

Route::post('/update-sahyognidhi-request','SahyognidhiRequestController@updateSahyognidhiRequest')->name('update-sahyognidhi-request');

Route::get('/delete-sahyognidhi-request/{sahyognidhi_id}','SahyognidhiRequestController@deleteSahyognidhiRequest')->name('delete-sahyognidhi-request');

Route::post('/multiple-delete-sahyognidhi-request','SahyognidhiRequestController@multipleDeleteSahyognidhiRequest')->name('multiple-delete-sahyognidhi-request');

Route::get('/view-sahyognidhi-request/{sahyognidhi_id}','SahyognidhiRequestController@viewSahyognidhiRequest')->name('view-sahyognidhi-request');

Route::post('/save-sahyognidhi-payment','SahyognidhiRequestController@saveSahyognidhiPayment')->name('save-sahyognidhi-payment');

Route::post('/get-data-by-sahyognidhi-id','SahyognidhiRequestController@getDataBySahyognidhi')->name('get-data-by-sahyognidhi-id');

Route::post('/get-relation','SahyognidhiRequestController@getNomineeRelation')->name('get-relation');

Route::post('/get-nominee-ysk-id','SahyognidhiRequestController@getNomineeYskId')->name('get-nominee-ysk-id');

Route::get('/sahyognidhi-request-payment-details/{sahyognidhi_id}','SahyognidhiRequestController@sahyognidhiPaymentDetails')->name('sahyognidhi-request-payment-details');

Route::get('delete-image/{sahyognidhi_upload_document_id}','SahyognidhiRequestController@deleteImage')->name('delete-image');

Route::post('/cancel-sahyognidhi-request','SahyognidhiRequestController@closeAccount')->name('cancel-sahyognidhi-request');

Route::get('/devangat-after-half-disiability/{id}','SahyognidhiRequestController@devangatAfterHalfDisiability')->name('devangat-after-half-disiability');

Route::post('/save-divangat-after-death','SahyognidhiRequestController@saveDevangatAfterHalfDisiability')->name('save-divangat-after-death');



/*Suspense Account*/

Route::get('/suspense-account','SuspenseAccountController@suspenseAccount')->name('suspense-account');

Route::post('/get-amount-by-registration-id','SuspenseAccountController@getAmountByRegistrationId')->name('get-amount-by-registration-id');

Route::post('/get-divangat-amount-by-registration-id','SuspenseAccountController@getDivangatAmountByRegistrationId')->name('get-divangat-amount-by-registration-id');

Route::post('/save-assign-suspense-account','SuspenseAccountController@assignSuspence')->name('save-assign-suspense-account');

Route::get('/edit-suspense-account/{suspense_account_id}','SuspenseAccountController@editSuspenseAccount')->name('edit-suspense-account');

Route::post('/update-suspense-account','SuspenseAccountController@updateSuspenseAccount')->name('update-suspense-account');

Route::get('/details-suspense-account/{suspense_account_id}','SuspenseAccountController@detailsSuspenseAccount')->name('details-suspense-account');

Route::get('/delete-suspense-account/{suspense_account_id}','SuspenseAccountController@deleteSuspenseAccount')->name('delete-suspense-account');

Route::post('/multiple-delete-suspense-account','SuspenseAccountController@multipleDeleteSuspenseAccount')->name('multiple-delete-suspense-account');





/*Today Calling*/

Route::get('/today-calling','TodayCallingController@getDataTodayCalling')->name('today-calling');



/*Council*/

Route::get('/council','CouncilController@council')->name('council');

Route::get('/add-council','CouncilController@addCouncil')->name('add-council');

Route::post('/save-council','CouncilController@saveCouncil')->name('save-council');

Route::get('/edit-council/{council_id}','CouncilController@editCouncil')->name('edit-council');

Route::post('/update-council','CouncilController@updateCouncil')->name('update-council');

Route::get('/delete-council/{council_id}','CouncilController@deleteCouncil')->name('delete-council');

Route::post('/multiple-delete-council','CouncilController@multipleDeleteCouncil')->name('multiple-delete-council');



/*All Bank Entry*/

Route::get('/all-bank-entry','AllBankEntryAddController@allBankEntry')->name('all-bank-entry');

Route::get('/session-destroy','AllBankEntryAddController@sessionDestroy')->name('session-destroy');

Route::get('/add-all-bank-entry','AllBankEntryAddController@addAllBankEntry')->name('add-all-bank-entry');

Route::post('/save-all-bank-entry','AllBankEntryAddController@saveBankEntry')->name('save-all-bank-entry');

Route::post('/get-amount-by-registration','AllBankEntryAddController@getRegistrationAmount')->name('get-amount-by-registration');

Route::post('/get-divangat-amount-by-registration','AllBankEntryAddController@getDivangatAmountByRedId')->name('get-divangat-amount-by-registration');

Route::get('/details-all-bank-entry/{all_bank_entry_id}','AllBankEntryAddController@viewAllBankEntry')->name('details-all-bank-entry');

Route::get('/delete-all-bank-entry/{all_bank_entry_id}','AllBankEntryAddController@deleteAllBankEntry')->name('delete-all-bank-entry');

Route::post('/multiple-delete-all-bank-entry','AllBankEntryAddController@multipleDeleteAllBankEntry')->name('multiple-delete-all-bank-entry');





/*Repayment*/

//Route::get('/repayment','RepaymentController@index')->name('repayment');

Route::post('/save-repayment','RepaymentController@create')->name('save-repayment');







/*Group*/

Route::get('/add-group','GroupController@addGroup')->name('add-group');

Route::post('/save-group','GroupController@saveGroup')->name('save-group');

Route::get('/group','GroupController@group')->name('group');

Route::get('/edit-group/{group_id}','GroupController@editGroup')->name('edit-group');

Route::post('/update-group','GroupController@updateGroup')->name('update-group');





/*Ledger Account*/

Route::get('/ledger-account','LedgerAccountController@ledgerAccount')->name('ledger-account');

Route::get('/add-ledger-account','LedgerAccountController@addLedgerAccount')->name('add-ledger-account');

Route::post('/save-ledger-account','LedgerAccountController@saveLedgerAccount')->name('save-ledger-account');

Route::get('/edit-ledger-account/{ledger_account_id}','LedgerAccountController@editLedgerAccount')->name('edit-ledger-account');

Route::post('/update-ledger-account','LedgerAccountController@updateLedgerAccount')->name('update-ledger-account');



/*Division*/

Route::get('/division','DivisionController@division')->name('division');

Route::get('/add-division','DivisionController@addDivision')->name('add-division');

Route::post('/save-division','DivisionController@saveDivision')->name('save-division');

Route::get('/edit-division/{division_id}','DivisionController@editDivision')->name('edit-division');

Route::post('/update-division','DivisionController@updateDivision')->name('update-division');

Route::get('/delete-division/{division_id}','DivisionController@deleteDivision')->name('delete-division');

Route::post('/multiple-delete-division','DivisionController@multipleDeleteDivision')->name('multiple-delete-division');



/*Sahyognidhi Manpower*/

Route::get('/sahyognidhi-manpower','SahyognidhiManpowerController@sahyognidhiManpower')->name('sahyognidhi-manpower');

Route::get('/sahyognidhi-manpower-view','SahyognidhiManpowerController@viewSahyognidhiManpower')->name('sahyognidhi-manpower-view');

Route::get('/sahyognidhi-manpower-view-all/{id}','SahyognidhiManpowerController@viewSahyognidhiManpowerData')->name('sahyognidhi-manpower-view-all');

Route::post('/get-data','SahyognidhiManpowerController@getData')->name('get-data');

Route::post('/admincharge-add','SahyognidhiManpowerController@AdminChargeAdd')->name('admincharge-add');

Route::post('/final-repayment-add','SahyognidhiManpowerController@FinalRepaymentAdd')->name('final-repayment-add');

Route::post('/save-sahyognidhi-manpower','SahyognidhiManpowerController@saveSahyognidhiManpower')->name('save-sahyognidhi-manpower');

Route::get('/delete-sahyognidhi-manpower/{id}/delete','SahyognidhiManpowerController@deleteSahyognidhiManpower')->name('delete-sahyognidhi-manpower');

////////////////////////////////Repayment Amount/////////////////////////////////////

Route::post('/repayment_reg_list','RepaymentController@RepaymentAmount')->name('repayment_reg_list');

Route::post('/final-payment-total','RepaymentController@FinalPaymentTotal')->name('final-payment-total');

Route::post('/paymentform','RepaymentController@ChequeInfoSave')->name('paymentform');

Route::get('/repayment-view/{id}','RepaymentController@RepaymentView')->name('repayment-view');

//Route::get('/ach_list/{ach?}','RepaymentController@index')->name('ach_list');

Route::get('/repayment/{ach?}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{status2?}','RepaymentController@index')->name('repayment');

Route::post('/check-clearance-data','CheckClearenceController@CheckClearanceData')->name('check-clearance-data');



Route::post('/multiple-delete-repayment','RepaymentController@multipleDeleteRepayment')->name('multiple-delete-repayment');

Route::get('/multiple-ach-paid','RepaymentController@multipleAchPaid')->name('multiple-ach-paid');

Route::get('/multiple-ach-bounce','RepaymentController@multipleAchBounce')->name('multiple-ach-bounce');

Route::get('/ach-excel','RepaymentController@ACHEXCEL')->name('ach-excel');

Route::post('/repayment-region-data','RepaymentController@RepaymentRegion')->name('repayment-region-data');



/*Route::get('import-export', 'RepaymentController@importExport');

Route::post('import', 'RepaymentController@import');

Route::get('export', 'RepaymentController@export');*/

//Route::post('/save-repayment','RepaymentController@create')->name('save-repayment');



/*Route::get('/sahyognidhi-request-payment-details', function () {

    return view('admin.sahyognidhi_request_payment_details');

});*/



/*55 Years Old*/

//Route::get('55-years-old','FiftyYearsController@fiftyFiveYears')->name('55-years-old');
Route::get('55-years-old/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{gender?}/{status1?}','FiftyYearsController@fiftyFiveYears')->name('55-years-old');
Route::get('fifty_exportall/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{gender?}/{status1?}','FiftyYearsController@fiftyExportAll')->name('fifty_exportall');
Route::get('fifty_export/{id?}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{gender?}/{status1?}','FiftyYearsController@fiftyExport')->name('fifty_export');

Route::get('/add-55-years-old/{id}','FiftyYearsController@addFiftyFiveYears')->name('add-55-years-old');

Route::get('/view-55-years-old','FiftyYearsController@viewFiftyFiveYears')->name('view-55-years-old');

Route::get('change-status-ysk-mitra/{id}','FiftyYearsController@changeStatusYskMitra')->name('change-status-ysk-mitra');

Route::get('/details-55-years/{id}','FiftyYearsController@detailsYSKMitra')->name('details-55-years');

Route::post('/multiple-delete-55-years','FiftyYearsController@multipleDelete55Years')->name('multiple-delete-55-years');

Route::post('/save-ysk-transfer-to-registration/{id}','FiftyYearsController@saveYskTransferToRegistration')->name('save-ysk-transfer-to-registration');



/*Employee Registration*/

Route::get('/employee-registration','EmployeeRegistrationController@employeeRegistration')->name('employee-registration');

Route::get('/add-employee-registration','EmployeeRegistrationController@addEmployeeRegistration')->name('add-employee-registration');

Route::post('/save-employee-registration','EmployeeRegistrationController@saveEmployeeRegistration')->name('save-employee-registration');

Route::get('/edit-employee-registration/{id}','EmployeeRegistrationController@editEmployeeRegistration')->name('edit-employee-registration');

Route::post('/update-employee-registration','EmployeeRegistrationController@updateEmployeeRegistration')->name('update-employee-registration');

Route::get('/view-employee-registration/{id}','EmployeeRegistrationController@viewEmployeeRegistration')->name('view-employee-registration');

Route::get('delete-employee-registration/{id}','EmployeeRegistrationController@deleteEmployeeRegistration')->name('delete-employee-registration');

Route::post('/multiple-delete-employee-registration','EmployeeRegistrationController@multipleDeleteEmployeeRegistration')->name('multiple-delete-employee-registration');

Route::get('delete-upload-employee-document/{id}','EmployeeRegistrationController@deleteUploadEmployeeDocument')->name('delete-upload-employee-document');



/*Attendance & Overtime*/

Route::get('/employee-attendance','AttendenceController@employeeAttendence')->name('employee-attendance');

Route::get('/employee-salary','EmployeeSalaryController@employeeSalary')->name('employee-salary');

Route::get('/employee-bonus','EmployeeBonusController@employeeBonus')->name('employee-bonus');

/////////////////////////////////////////////////////////////////////////////////////////////
Route::post('/in-time-employee','EmployeeSalaryController@InTimeSet')->name('in-time-employee');
Route::post('/out-time-employee','EmployeeSalaryController@OutTimeSet')->name('out-time-employee');
Route::post('/over-total-hours-employee','EmployeeSalaryController@OverTimeSet')->name('over-total-hours-employee');
Route::post('/get-data-by-employee-changes','EmployeeSalaryController@getDataByEmployeeChanges')->name('get-data-by-employee-changes');
///////////////////////////////////////////////////////////////////////////////////////////



/*Salary*/

Route::get('/employee-salary','EmployeeSalaryController@employeeSalary')->name('employee-salary');

Route::post('/get-data-by-employee','EmployeeSalaryController@getDataByEmployee')->name('get-data-by-employee');

Route::post('/save-employee-salary','EmployeeSalaryController@saveEmployeeSalary')->name('save-employee-salary');



Route::any('exceltest/{id}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{processingid?}/{yskname?}/{yskidnew?}/{yskidnewpre?}', 'RegistrationController@exceltest')->name('exceltest');
//Route::any('exceltest-all', 'RegistrationController@exceltestALL')->name('exceltest-all');
//Route::any('all-excel-data', 'RegistrationController@AllExcelData')->name('all-excel-data');
Route::any('/exceltest-all/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{processingid?}/{yskname?}/{yskidnew?}/{yskidnewpre?}','RegistrationController@exceltestALL')->name('exceltest-all');

Route::any('exceltest-fileds-admin/{id}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{processingid?}/{yskname?}/{yskidnew?}/{yskidnewpre?}', 'RegistrationController@exceltestFiledsAdmin')->name('exceltest-fileds-admin');
//Route::any('exceltest-all', 'RegistrationController@exceltestALL')->name('exceltest-all');
//Route::any('all-excel-data', 'RegistrationController@AllExcelData')->name('all-excel-data');
Route::any('/exceltest-all-fileds-admin/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{processingid?}/{yskname?}/{yskidnew?}/{yskidnewpre?}','RegistrationController@exceltestALLFiledsAdmin')->name('exceltest-all-fileds-admin');




Route::get('import-export', 'RepaymentController@importExport');

Route::post('import', 'RepaymentController@import')->name('import');

Route::get('export/{id}/{ach?}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{status2?}', 'RepaymentController@export')->name('export');

Route::get('repayment-all/{ach?}/{region?}/{council?}/{startDate?}/{endDate?}/{division?}/{samajzone?}/{yuvamandal?}/{agegroup?}/{gender?}/{status1?}/{status2?}', 'RepaymentController@RepaymentexportAll')->name('repayment-all');



Route::get('users-data-table', 'UsersController@getUsersForDataTable')->name('users-data-table');

Route::get('wel', 'UsersController@test')->name('wel');





/*Karyakarta*/

Route::get('/add-karyakarta','KaryakartaController@addKaryakarta')->name('add-karyakarta');

Route::post('/get-assign-permission','KaryakartaController@getAssignPermission')->name('get-assign-permission');

Route::post('/get-ysk-details-by-registration-id','KaryakartaController@getYskDetailByRegistrationId')->name('get-ysk-details-by-registration-id');

Route::post('/save-karyakarta','KaryakartaController@saveKaryakarta')->name('save-karyakarta');

Route::get('/karyakarta','KaryakartaController@karyakarta')->name('karyakarta');

Route::get('/edit-karyakarta/{id}','KaryakartaController@editKaryakarta')->name('edit-karyakarta');

Route::post('/update-karyakarta','KaryakartaController@updateKaryakarta')->name('update-karyakarta');

Route::get('/view-karyakarta/{id}','KaryakartaController@viewKaryakarta')->name('view-karyakarta');

Route::get('/delete-karyakarta/{id}','KaryakartaController@deleteKaryakarta')->name('delete-karyakarta');

Route::get('/deactive-status','KaryakartaController@deactiveStatus')->name('deactive-status');

Route::post('/multiple-delete-karyakarta','KaryakartaController@multipleDeleteKaryakarta')->name('multiple-delete-karyakarta');


Route::get('/user-admin', function () {
    return view('elements/user_admin');
});


/*User Dashboard*/
Route::get('/user-dashboard/{id}','UserDashboardController@userDashboard')->name('user-dashboard');

/*User Registration*/
Route::get('/user-registration/{id}','UserRegistrationController@userRegistration')->name('user-registration');
Route::post('/update-user-registration/{id}','UserRegistrationController@updateUserRegistration')->name('update-user-registration');

/*User Ledger Account*/
Route::get('/user-ledger-account/{id}','UserLedgerAccountController@userLedgerAccount')->name('user-ledger-account');

/*User Sahyognidhi Request*/
Route::get('/user-sahyognidhi-request/{id}','UserSahyognidhiRequestController@userSahyognidhiRequest')->name('user-sahyognidhi-request');

/*User Repayment*/
Route::get('/user-repayment/{id}','UserRepaymentController@userRepayment')->name('user-repayment');

/*User Transfer*/
Route::get('/user-transfer/{id}','UserTransferController@userTransfer')->name('user-transfer');

/*User Ach*/
Route::get('/user-ach/{id}','UserAchController@userAch')->name('user-ach');
Route::get('/user-add-ach/{id}','UserAchController@addUserAch')->name('user-add-ach');
Route::post('/save-user-ach/{id}','UserAchController@saveUserAch')->name('save-user-ach');
Route::get('/view-user-ach/{id}','UserAchController@viewUserAch')->name('view-user-ach');


/*Accounting Receipt*/

Route::get('/receipt','ReceiptController@receipt')->name('receipt');
Route::get('/add-receipt','ReceiptController@addReceipt')->name('add-receipt');

Route::post('/save-receipt','ReceiptController@saveReceipt')->name('save-receipt');

Route::get('/edit-receipt/{id}','ReceiptController@editReceipt')->name('edit-receipt');

Route::post('/update-receipt','ReceiptController@updateReceipt')->name('update-receipt');

Route::get('/view-receipt/{id}','ReceiptController@viewReceipt')->name('view-receipt');

Route::get('delete-receipt/{id}','ReceiptController@deleteReceipt')->name('delete-receipt');

Route::post('/multiple-delete-receipt','ReceiptController@multipleDeleteReceipt')->name('multiple-delete-receipt');

/*Accounting Payment*/

Route::get('/payment','PaymentController@payment')->name('payment');
Route::get('/add-payment','PaymentController@addPayment')->name('add-payment');

Route::post('/save-payment','PaymentController@savePayment')->name('save-payment');

Route::get('/edit-payment/{id}','PaymentController@editPayment')->name('edit-payment');

Route::post('/update-payment','PaymentController@updatePayment')->name('update-payment');

Route::get('/view-payment/{id}','PaymentController@viewPayment')->name('view-payment');

Route::get('delete-payment/{id}','PaymentController@deletePayment')->name('delete-payment');

Route::post('/multiple-delete-payment','PaymentController@multipleDeletePayment')->name('multiple-delete-payment');

/*Accounting Journal Voucher*/

Route::get('/journal-voucher','JournalVoucherController@JournalVoucher')->name('journal-voucher');
Route::get('/add-journal-voucher','JournalVoucherController@addJournalVoucher')->name('add-journal-voucher');

Route::post('/save-journal-voucher','JournalVoucherController@saveJournalVoucher')->name('save-journal-voucher');

Route::get('/edit-journal-voucher/{id}','JournalVoucherController@editJournalVoucher')->name('edit-journal-voucher');

Route::post('/update-journal-voucher','JournalVoucherController@updateJournalVoucher')->name('update-journal-voucher');

Route::get('/view-journal-voucher/{id}','JournalVoucherController@viewJournalVoucher')->name('view-journal-voucher');

Route::get('delete-journal-voucher/{id}','JournalVoucherController@deleteJournalVoucher')->name('delete-journal-voucher');

Route::post('/multiple-delete-journal-voucher','JournalVoucherController@multipleDeleteJournalVoucher')->name('multiple-delete-journal-voucher');

/*Accounting Fix Deposit */

Route::get('/fix-deposit','FixDepositController@FixDeposit')->name('fix-deposit');
Route::get('/add-fix-deposit','FixDepositController@addFixDeposit')->name('add-fix-deposit');

Route::post('/save-fix-deposit','FixDepositController@saveFixDeposit')->name('save-fix-deposit');

Route::get('/edit-fix-deposit/{id}','FixDepositController@editFixDeposit')->name('edit-fix-deposit');

Route::post('/update-fix-deposit','FixDepositController@updateFixDeposit')->name('update-fix-deposit');

Route::get('/view-fix-deposit/{id}','FixDepositController@viewFixDeposit')->name('view-fix-deposit');

Route::get('delete-fix-deposit/{id}','FixDepositController@deleteFixDeposit')->name('delete-fix-deposit');

Route::post('/multiple-delete-fix-deposit','FixDepositController@multipleDeleteFixDeposit')->name('multiple-delete-fix-deposit');


/*Registration Council route */
Route::post('/getcouncil/', 'RegistrationController@council');
Route::post('/getregion/', 'RegistrationController@division');
Route::post('/getdivision/', 'RegistrationController@samaj');
Route::post('/getyuvamandal_name/', 'RegistrationController@yuvamandal');
Route::post('/getcouncilname/', 'RegistrationController@councilname');
Route::post('/getinactive/', 'RegistrationController@inactive');
Route::get('/onlinetransaction/', 'OnlinePaymentController@onlinepayment');
Route::post('/ccavRequestHandler', 'OnlinePaymentController@ccavRequestHandler');
Route::post('/getsendsms','SahyognidhiManpowerController@getsendsms');


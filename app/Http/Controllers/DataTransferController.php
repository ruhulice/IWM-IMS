<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTransferController extends Controller
{
    //
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function transferprojectinfo()
    {
        //dd("Ok");
        // Fetch from MS SQL Server
        $msprojectinfo = DB::connection('sqlsrv')
            ->table('PIM_ProjectInfo')
            ->whereRaw('len(ProjectNo) <=6')
            ->get();

        // // dd($msprojectinfo);
        // foreach ($msprojectinfo as $project) {
        //     echo $project->ProjectNo."<br>";
        // }
        // Fetch all projects from SQL Server

        foreach ($msprojectinfo as $project) {
            DB::connection('pgsql')->table('projectinfo')->insert([
                'projectid' => $project->Id,
                'projecttypeid' => $project->ProjectTypeId,
                'projectcategoryid' => $project->ProjectCategoryId,
                'projectno' => $project->ProjectNo,
                'projecttitle' => $project->ProjectTitle,
                'referenceprojectid' => $project->ReferenceProjectId,
                'issubproject' => $project->IsSubProject,
                'clientid' => $project->ClientId,
                'fundedbyid' => $project->FundedById,
                'executingagencyid' => $project->ExecutingAgencyId,
                'sectorid' => $project->SectorId,
                'divisionid' => $project->DivisionId,
                'projectstatusid' => $project->ProjectStatusId,
                'startdate' => $project->StartDate,
                'expectedenddate' => $project->ExpectedEndDate,
                'actualenddate' => $project->ActualEndDate,
                'remarks' => $project->Remarks,
                'projectleaderid' => $project->ProjectLeaderId,
                'projectsupervisorid' => $project->ProjectSupervisorId,
                'contractsigndate' => $project->ContractSignDate,
                'registrationdate' => $project->RegistrationDate,
                'contractvaluebdt' => $project->ContractValueBDT,
                'iuser' => $project->IUser,
                'euser' => $project->IDate
            ]);
        }

        return "Data Transfer complete";
    }
    public function transferprojectbudget()
    {

        $msprojectbudget = DB::connection('sqlsrv')
        ->table('PIM_ProjectBudget')
        ->get();
        foreach ($msprojectbudget as $budget) {
            DB::connection('pgsql')->table('projectbudget')->insert([
                'budgetid' => $budget->Id,
                'projectid' => $budget->ProjectId,
                'revisionno' => $budget->RevisionNo,
                'budgetdate' => $budget->BudgetDate,
                'budgetstatusid' => $budget->BudgetStatusId,
                'approvedate' => $budget->ApproveDate,
                'remarks' => $budget->Remarks,
            ]);
        }


        return "Project budget data transfer successfully";
    }
    public function transferprojectbudgetdetails()
    {

        $msprojectbudgetdetail = DB::connection('sqlsrv')
        ->table('PIM_ProjectBudgetDetail')
        ->get();
        foreach ($msprojectbudgetdetail as $detail) {
            DB::connection('pgsql')->table('projectbudgetdetail')->insert([
                'budgetid' => $detail->BudgetId,
                'headtype' => $detail->HeadType,
                'budgetsubheadid' => $detail->BudgetSubHeadId,
                'accountheadid' => $detail->AccountHeadId,
                'startdate' => $detail->StartDate,
                'enddate' => $detail->EndDate,
                'amount' => $detail->Amount,
            ]);
        }



        return "Project budgetdetails data transfer successfully";
    }
    public function transferchartofaccount()
    {

        $msChartOfAccount = DB::connection('sqlsrv')
        ->table('FAM_ChartOfAccount')
        ->get();
        foreach ($msChartOfAccount as $account) {
            DB::connection('pgsql')->table('chartofaccount')->insert([
                'accountheadid' => $account->Id,
                'accountheadcode' => $account->AccountHeadCode,
                'accountheadname' => $account->AccountHeadName,
                'accountheadtype' => $account->AccountHeadType,
                'ispostingaccount' => $account->IsPostingAccount,
                'parentheadcode' => $account->ParentHeadCode,
                'openingbalance' => $account->OpeningBalance,
                'bsplname' => $account->BSPLName,
                'bsplserial' => $account->BSPLSerial,
                'isbudgethead' => $account->IsBudgetHead,
                'cashbanktype' => $account->CashBankType,
                'isbank' => $account->IsBank,
                'remarks' => $account->Remarks,
                'isactive' => $account->IsActive,
                'companyid' => $account->CompanyId,
            ]);
        }
        return "Project chart of account data transfer successfully";
    }

    public function transferemployeeinfo()
    {

        $msEmploymentInfo = DB::connection('sqlsrv')
        ->table('PRM_EmploymentInfo')
        ->get();
        foreach ($msEmploymentInfo as $emp) {
            DB::connection('pgsql')->table('employmentinfo')->insert([
                'employeeid' => $emp->Id,
                'empid' => $emp->EmpID,
                'employeeinitial' => $emp->EmployeeInitial,
                'fullname' => $emp->FullName,
                'dateofjoining' => $emp->DateofJoining,
                'dateofconfirmation' => $emp->DateofConfirmation,
                'dateofposition' => $emp->DateofPosition,
                'designationid' => $emp->DesignationId,
                'divisionid' => $emp->DivisionId,
                'resourcelevelid' => $emp->ResourceLevelId,
                'staffcategoryid' => $emp->StaffCategoryId,
                'shiftid' => $emp->ShiftId,
                'employmenttypeid' => $emp->EmploymentTypeId,
                'iscontractual' => $emp->IsContractual ?? false,
                'isconsultant' => $emp->IsConsultant ?? false,
                'mobileno' => $emp->MobileNo,
                'emialaddress' => $emp->EmialAddress,
                'employmentstatusid' => $emp->EmploymentStatusId,
                'dateofinactive' => $emp->DateofInactive,
                'contractexpiredate' => $emp->ContractExpireDate,
                'status' => $emp->status,
            ]);
        }

        return "Project EmployeeInfo  data transfer successfully";
    }
    public function transferdesignation()
    {

        $msDesignation = DB::connection('sqlsrv')
        ->table('PRM_Designation')
        ->get();
        foreach ($msDesignation as $designation) {
            DB::connection('pgsql')->table('designation')->insert([
                'designationid' => $designation->Id,
                'name' => $designation->Name,
                'jobdescription' => $designation->JobDescription,
                'remarks' => $designation->Remarks,
            ]);
        }


        return "Designation  data transfer successfully";
    }


    //end

}

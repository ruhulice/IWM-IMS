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

    public function transfer()
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

}

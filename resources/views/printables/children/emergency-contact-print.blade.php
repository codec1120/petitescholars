@extends('layouts.printable')

@section('header-css')
	<style>
		.header-div {
            text-align: center;
        }

        table {
            width: 100%;
            font-size: 0.685rem;
        }

        table.table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table.borderless td, table.borderless th{
            border: none !important;
        }

        table.table td, table.table th {
            border: 1px solid #000000;
            text-align: left;
            padding-bottom:8px;
            padding-left:3px;
        }

        .value {
            padding: 5px;
            margin-top: 5px;
            font-size:1rem;
        }

        .second_column_width_default_min_width {
            width: 30%;
        }

        .main_column_max_width {
            width: 70%;
        }

        .table label {
            display: block;
        }

        .text-bold {
            font-weight: bold;
        }
        
        .title {
            font-size: 1.85rem;
        }
        
        .border-right {
            border-right: 1px solid black;
        }
        
        .border-left {
            border-left: 1px solid black;
        }
        
        .border-top {
            border-top: 1px solid black;
        }
        
        .border-bottom {
            border-bottom: 1px solid black;
        }
        
        .border {
            border: 1px solid black
        }
        
        .border-bg-black {
            background-color: black;
            color: white;
        }
        
        .flex {
            display: block;
        }
        
        .mt-5 { 
            margin-top: 5px;
        }
        
        .mt-20 {
            margin-top: 20px
        }

        .mt-30 {
            margin-top: 30px
        }
        
        .mt-50 {
            margin-top: 50px
        }
        
        .justify-end {
            justify-content: space-between;
        }

        .text-center {
            text-align: center;
        }

        .w-30 {
            width: 30%;
        }

        .w-44 {
            width: 44%;
        }
	</style>
@endsection

<!-- Content -->
@section('content')
<div class="card">
        <div class="header-div">
            <div class="title">
                <span class="text-bold">Emergency Contact / Parental Consent Form</span>
            </div>
            <div class="description">
                <span class="description-text">55 PA CODE CHAPTERS 3270 124(a)(b), 3270.181 & 182; 3280 124 (a)(b). 329.181 * 182</span>
            </div>
            
        </div>
        <div class="main_wrapper">
            
            <table class="table">
                <tbody>
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" class="text-bold">CHILD'S NAME</label>
                            <label for="value" class="value">{{$child_name ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">BIRTHDATE</label>
                            <label for="value" class="value">{{$child_birthdate ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="name">ADDRESS</label>
                            <label for="value" class="value">{{$child_address ?? ''}}</label>
                        </td>
                    </tr>
                     <!-- Mother's Details -->
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" class="text-bold">MOTHER'S NAME/LEGAL GUARDIAN</label>
                            <label for="value" class="value">{{$mothers_name ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">HOME TELEPHONE NUMBER</label>
                            <label for="value" class="value">{{$mothers_tel ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="name">ADDRESS</label>
                            <label for="value" class="value">{{$mothers_address ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <label for="name">BUSINESS NAME</label>
                            <label for="value" class="value">{{$mothers_business_name ?? ''}}</label>
                        </td>
                        <td class="">
                            <label for="name">BUSINESS TELEPHONE NUMBER</label>
                            <label for="value" class="value">{{$mothers_business_tel ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="name">ADDRESS</label>
                            <label for="value" class="value">{{$mothers_business_address ?? ''}}</label>
                        </td>
                    </tr>
                      <!-- Father's Details -->
                    <tr>
                        <td class="">
                            <label for="name" class="text-bold">FATHER'S NAME/LEGAL GUARDIAN</label>
                            <label for="value" class="value">{{$fathers_name ?? ''}}</label>
                        </td>
                        <td class="">
                            <label for="name">HOME TELEPHONE NUMBER</label>
                            <label for="value" class="value">{{$fathers_tel ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="name">ADDRESS</label>
                            <label for="value" class="value">{{$fathers_address ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <label for="name">BUSINESS NAME</label>
                            <label for="value" class="value">{{$fathers_business_name ?? ''}}</label>
                        </td>
                        <td class="">
                            <label for="name">BUSINESS TELEPHONE NUMBER</label>
                            <label for="value" class="value">{{$fathers_business_tel ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="name">ADDRESS</label>
                            <label for="value" class="value">{{$fathers_business_address ?? ''}}
                        </td>
                    </tr>
                    <!-- Emergency Contact -->
                    <tr>
                        <td colspan="2">
                            <table class="borderless">
                                <tr>
                                    <td width="100px">
                                        <label for="name">EMERGENCY CONTACT</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name">NAME</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name"></label>
                                    </td>
                                    <td width="100px">
                                        <label for="name" class="text-center">TELEPHONE NUMBER WHEN CHILD IS IN CARE</label>
                                    </td>
                                </tr>
                            </table> 
                        </td>   
                    </tr>
                    @foreach($emergency_contacts as $emergency_contact)
                    <tr>
                        <td colspan="2">
                            <table class="borderless">
                                <tr>
                                    <td width="100px">
                                        <label for="name"></label>
                                    </td>
                                    <td width="100px">
                                        <label for="name">{{$emergency_contact['first_name'].' '.$emergency_contact['last_name']}}</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name"></label>
                                    </td>
                                    <td width="100px">
                                        <label for="name" class="text-center">{{$emergency_contact['phone_number']}}</label>
                                    </td>
                                </tr>
                            </table> 
                        </td>   
                    </tr>
                    @endforeach
                    
                    <!-- Authorized Person -->
                    <tr>
                        <td colspan="2">
                            <table class="borderless">
                                <tr>
                                    <td width="100px">
                                        <label for="name">PERSON(S) TO WHOM CHILD  MAY BE RELEASED</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name">NAME</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name">ADDRESS</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name" class="text-center">TELEPHONE NUMBER WHEN CHILD IS IN CARE</label>
                                    </td>
                                </tr>
                            </table> 
                        </td>   
                    </tr>
                    @foreach($auth_persons as $auth_person)
                    <tr>
                        <td colspan="2">
                            <table class="borderless">
                                <tr>
                                    <td width="100px">
                                        <label for="name"></label>
                                    </td >
                                    <td width="100px">
                                        <label for="name">{{$auth_person['first_name'].' '.$auth_person['last_name']}}</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name">''</label>
                                    </td>
                                    <td width="100px">
                                        <label for="name" class="text-center">$auth_person['phone_number']</label>
                                    </td>
                                </tr>
                            </table> 
                        </td>   
                    </tr>
                    @endforeach
                    <!-- Physician-->
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" class="text-bold">NAME OF CHILD'S  PHYSICIAN/MEDICAL CARE PROVIDER</label>
                            <label for="value" class="value">{{$physician_name ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">HOME TELEPHONE NUMBER</label>
                            <label for="value" class="value">{{$physician_tel ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="name">ADDRESS</label>
                            <label for="value" class="value">{{$physician_address ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" >SPECIAL DISABILITIES (ANY)</label>
                            <label for="value" class="value">{{$disabilities ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">ALLERGIES (INCLUDING MEDICATION REACTION)</label>
                            <label for="value" class="value">{{$medication_reaction ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" >MEDICAL or DIETARY INFORMATION NECESSARY IN AN EMERGENCY SITUATION</label>
                            <label for="value" class="value">{{$medical_dietary ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">MEDICAL, SPECIAL CONDITIONS</label>
                            <label for="value" class="value">{{$medical_special_conditions ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="name">ADDITIONAL INFORMATION ON SPECIAL NEEDS OF CHILD</label>
                            <label for="value" class="value">{{$additional_special_child_medication ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" >HEALTH INSURANCE COVERAGE FOR CHILD or MEDICAL  ASSISTANCE BENEFITS</label>
                            <label for="value" class="value">{{$health_insurance ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">POLICY NUMBER</label>
                            <label for="value" class="value">{{$policy_number ?? ''}}</label>
                        </td>
                    </tr>
                    <tr class="border-bg-black">
                        <td colspan="2">
                            <label for="name">PARENT'S SIGNATURE IS REQUIRED FOR EACH ITEM BELOW TO INDICATE PARENTAL CONSENT</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" class="text-bold">OBTAINING EMERGENCY  MEDICAL CARE</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">ADMIN. OF MINOR FIRST - AID PROCEDURES</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name" >WALK AND TRIPS</label>
                            <label for="value" class="value">{{$walk_trips ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">SWIMMING</label>
                            <label for="value" class="value">{{$swimming ?? ''}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="main_column_max_width">
                            <label for="name">TRANSPORTATION BY THE FACULTYS</label>
                            <label for="value" class="value">{{$transportation ?? ''}}</label>
                        </td>
                        <td class="second_column_width_default_min_width">
                            <label for="name">WADING</label>
                            <label for="value" class="value">{{$wading ?? ''}}</label>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="clear:both; position:relative;margin-top:30pt">
                <div style="position:absolute; left:0pt; width:300pt;">
                    <div class="border-top">
                        <label for="name" style="margin-left:40pt">SIGNATURE OF PARENT or GUARDIAN</label>
                    </div>
                </div>
                <div style="margin-left:320pt; width:200pt;">
                    <div class="border-top">
                        <label for="name" style="margin-left:80pt">DATE</label>
                    </div>
                </div>
            </div>

            <div style="clear:both; position:relative;margin-top:30pt">
                <div style="position:absolute; left:0pt; width:300pt;">
                    <div class="border-top">
                        <label for="name" style="margin-left:40pt">SIGNATURE OF PARENT or GUARDIAN</label>
                    </div>
                </div>
                <div style="margin-left:320pt; width:200pt;">
                    <div class="border-top">
                        <label for="name" style="margin-left:80pt">DATE</label>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
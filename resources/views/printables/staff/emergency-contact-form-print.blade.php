@extends('layouts.printable')

@section('header-css')
	<style>
		.card-title,  {
			width: 100%;
			text-align: center;
			font-size: 1.4em;
			border-bottom:  1px solid black;
		}

		.card-headed {
			width: 100%;
			text-align: center;
			margin-bottom: 4%;
		}

		.employee-table {
			width: 100%;
			margin-top:3%;
			font-size: 0.9em
		}

		.td-label {
			color: #6b7280;
			width:18%;
			padding:5px
		}

		.td-value {
			width: 30%;
			padding:5px
		}

		.td-value-full {
			width: auto;
			padding:5px
		}

		.card-employee-info {
			margin-bottom: 2%;
		}

		.card-employee-education {
			margin-bottom: 2%;
		}

		.card-emergency-contact-details {
			margin-bottom: 2%;
		}

		.checkbox-div {
			float:right;
			width: 100%;
			margin-top:3%;
		}
	</style>
@endsection

<!-- Content -->
@section('content')
	<div class="card">
		<div class="card-headed">
			<img src="{{ $brand_src }}" width="100" height="100">
		</div>
		<div class="card-body">
			<!-- Employee Info -->
			<div class="card-employee-info">
				<div class="card-title">
                    Staff Emergency Contact Form
				</div>
				
				<table class="employee-table">
					<tbody>
					<tr>
						<td class="td-label">Employee Name: </td>
						<td class="td-value">{{ $employee['employee_name'] }}</td>
						<td class="td-label">Employee Tite: </td>
						<td class="td-value">{{ $employee['employee_title'] }}</td>
					</tr>
					<tr>
						<td class="td-label">Location: </td>
						<td class="td-value">{{ $employee['location'] }}</td>
						<td class="td-label">Email Address: </td>
						<td class="td-value">{{ $employee['email_address'] }}</td>
					</tr>
					<tr>
						<td class="td-label">Address: </td>
						<td class="td-value-full">{{ $employee['address'] }}</td>
					</tr>
					<tr>
						<td class="td-label">Phone Number: </td>
						<td class="td-value">{{ $employee['phone_number'] }}</td>
						<td class="td-label">Date of Birth: </td>
						<td class="td-value">{{ $employee['dob'] }}</td>
					</tr>
					</tbody>
				</table>
			</div>
			<!-- Employee Emergency Contacte -->
			<div class="card-emergency-contact-details">
                @foreach ($emergencyContactFields['emergency_contact_details'] as $index => $experience)
				<div class="card-title">
					EmploEmergency Contact #{{ $index + 1}}
				</div>
				
				<table class="employee-table">
					<tbody>
                        <tr>
                            <td class="td-label">Emergency {{ $index+1 }} Contact Name: </td>
                            <td class="td-value-full">{{ $emergencyContactFields['emergency_contact_details'][$index]['emergency_contact_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="td-label">Emergency {{ $index+1 }} Home Phone:</td>
                            <td class="td-value-full">{{ $emergencyContactFields['emergency_contact_details'][$index]['emergency_home_phone'] }}</td>
                            <td class="td-label">Emergency {{ $index+1 }} Cell Phone:</td>
                            <td class="td-value-full">{{ $emergencyContactFields['emergency_contact_details'][$index]['emergency_cell_phone'] }}</td>
                        </tr>
                        <tr>
                            <td class="td-label">Emergency {{ $index+1 }} Work Phone:</td>
                            <td class="td-value">{{ $emergencyContactFields['emergency_contact_details'][$index]['emergency_work_phone'] }}</td>
                            <td class="td-label">Emergency {{ $index+1 }} Relation to the Staff: </td>
                            <td class="td-value">{{ $emergencyContactFields['emergency_contact_details'][$index]['emergency_relation_to_staff'] }}</td>
                        </tr>
					</tbody>
				</table>
                @endforeach
			</div>
			<!-- Employee Emergency Other Detail -->
			<div class="card-emergence-other-detail">
				<div class="card-title">
				    Health Information
				</div>
				
				<table class="employee-table">
					<tbody>
					<tr>
						<td class="td-label">Staff Allergies: </td>
						<td class="td-value-full">{{ $emergencyContactFields['staff_allergies'] }}</td>
					</tr>
					<tr>
						<td class="td-label">Staff Reactions to allergies: </td>
						<td class="td-value-full">{{ $emergencyContactFields['staff_reaction_allergies'] }}</td>
					</tr>
                    <tr>
						<td class="td-label">Staff Medication: </td>
						<td class="td-value-full">{{ $emergencyContactFields['staff_medication'] }}</td>
					</tr>
                    <tr>
						<td class="td-label">Staff Medical Conditions: </td>
						<td class="td-value-full">{{ $emergencyContactFields['staff_medical_conditions'] }}</td>
					</tr>
                    <tr>
						<td class="td-label">Actions Needed to Medical Conditions: </td>
						<td class="td-value-full">{{ $emergencyContactFields['actions_needed_to_medical_conditions'] }}</td>
					</tr>
                    <tr>
						<td class="td-label">Medical Insurance (Staff): </td>
						<td class="td-value-full">{{ $emergencyContactFields['staff_medical_insurance'] }}</td>
					</tr>
                    <tr>
						<td class="td-label">Policy Number (Staff): </td>
						<td class="td-value-full">{{ $emergencyContactFields['staff_policy_number'] }}</td>
					</tr>
					</tbody>
				</table>
				<div class="checkbox-div">
					<label for="dateSubmitted" class="dateSubmitted"> Date Submitted: {{  $emergencyContactFields['date_of_submission'] }}</label>
				</div>
			</div>
		</div>
	</div>
@endsection
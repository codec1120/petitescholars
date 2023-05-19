@extends('layouts.printable')
<!-- content css. place the CSS to the HEADER SIDE -->
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

		.card-employee-employment-experience {
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
					Child Care Employee Data Sheet
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
			<!-- Employee Education -->
			<div class="card-employee-education">
				<div class="card-title">
					Education
				</div>
				
				<table class="employee-table">
					<tbody>
					<tr>
						<td class="td-label">Name of High School: </td>
						<td class="td-value">{{ $education['high_school_name'] }}</td>
						<td class="td-label">Grade Completed: </td>
						<td class="td-value">{{ $education['grade_completed'] }}</td>
					</tr>
					<tr>
						<td class="td-label">High School Address: </td>
						<td class="td-value">{{ $education['high_school_address'] }}</td>
						<td class="td-label">Graduate Date: </td>
						<td class="td-value">{{ $education['graduate_date'] }}</td>
					</tr>
					<tr>
						<td class="td-label">Name of College: </td>
						<td class="td-value">{{ $education['name_of_college'] }}</td>
						<td class="td-label">Semester Hours Completed: </td>
						<td class="td-value">{{ $education['semester_hours_completed'] }}</td>
					</tr>
					<tr>
						<td class="td-label">College Address: </td>
						<td class="td-value">{{ $education['college_address'] }}</td>
						<td class="td-label">Degree Earned: </td>
						<td class="td-value">{{ $education['degree_earned'] }}</td>
					</tr>
					</tbody>
				</table>
			</div>
			<!-- Employee Employment Experience -->
			<div class="card-employee-employment-experience">
				<div class="card-title">
					Employment Experience
				</div>
				
				<table class="employee-table">
					<tbody>
					@foreach ($employmentExperience as $index => $experience)
					<tr>
						<td class="td-label">({{$index}}) Name of Employer: </td>
						<td class="td-value">{{ $experience['employer'] }}</td>
						<td class="td-label">({{$index}}) Job Title: </td>
						<td class="td-value">{{ $experience['job_title'] }}</td>
					</tr>
					<tr>
						<td class="td-label">({{$index}}) Employer Address: </td>
						<td class="td-value-full">{{ $experience['employer_address'] }}</td>
					</tr>
					<tr>
						<td class="td-label">({{$index}}) Employement Start Date: </td>
						<td class="td-value">{{ $experience['employment_start_date'] }}</td>
						<td class="td-label">({{$index}}) Employement End Date: </td>
						<td class="td-value">{{ $experience['employment_end_date'] }}</td>
					</tr>
					<tr class="employment-last-tr">
						<td class="td-label">({{$index}}) Job Description: </td>
						<td class="td-value-full">{{ $experience['job_description'] }}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<!-- Employee Present Position -->
			<div class="card-employee-present-position">
				<div class="card-title">
				Present Position
				</div>
				
				<table class="employee-table">
					<tbody>
					<tr>
						<td class="td-label">Date You Can Start: </td>
						<td class="td-value">{{ $presentPosition['date_start'] }}</td>
						<td class="td-label">Days of the Week Available for Work: </td>
						<td class="td-value">{{ $presentPosition['days_week_available_for_work'] }}</td>
					</tr>
					<tr>
						<td class="td-label">Hours of the Day Available for Work: </td>
						<td class="td-value-full">{{ $presentPosition['hours_available_for_work'] }}</td>
					</tr>
					</tbody>
				</table>
				<div class="checkbox-div">
					<label for="dateSubmitted" class="dateSubmitted"> Date Submitted: {{  $employee['date_submitted'] }}</label>
				</div>
			</div>
		</div>
	</div>
@endsection

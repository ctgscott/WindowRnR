@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Edit Profile
@stop

{{-- Content --}}
@section('content')

<h4>Edit 
@if ($user->email == Sentry::getUser()->email)
	Your
@else 
	{{ $user->email }}'s 
@endif 

Profile</h4>
<div class="well">
	<form class="form-horizontal" action="{{ URL::to('users/edit') }}/{{ $user->id }}" method="post">
        {{ Form::token() }}
        
        <div class="control-group {{ ($errors->has('firstName')) ? 'error' : '' }}" for="firstName">
        	<label class="control-label" for="firstName">First Name</label>
    		<div class="controls">
				<input name="firstName" value="{{ (Request::old('firstName')) ? Request::old("firstName") : $user->first_name }}" type="text" class="input-xlarge" placeholder="First Name">
    			{{ ($errors->has('firstName') ? $errors->first('firstName') : '') }}
    		</div>
    	</div>

        <div class="control-group {{ $errors->has('lastName') ? 'error' : '' }}" for="lastName">
        	<label class="control-label" for="lastName">Last Name</label>
    		<div class="controls">
				<input name="lastName" value="{{ (Request::old('lastName')) ? Request::old("lastName") : $user->last_name }}" type="text" class="input-xlarge" placeholder="Last Name">
    			{{ ($errors->has('lastName') ?  $errors->first('lastName') : '') }}
    		</div>
    	</div>

        <div class="avatar">
			<label class="control-label avatar-radios" for="avatars">Avatars</label>
			<div id="avatars">
				<div id="avatarImgs">
					<img src="/img/WinPin.png">
					<img src="/img/WinPin2.png">
					<img src="/img/WinPin3.png">
					<img src="/img/WinPin4.png">
					<img src="/img/WinPin5.png">
					<img src="/img/WinPin6.png">
					<img src="/img/WinPin7.png">
				</div>
				<div id="avatarRadios">
					<input type="radio" name="avatar" id="avatarRadio" value="WinPin.png" @if ($avatar == 'WinPin.png') checked @endif >
					<input type="radio" name="avatar" id="avatarRadio2" value="WinPin2.png" @if ($avatar == 'WinPin2.png') checked @endif >
					<input type="radio" name="avatar" id="avatarRadio3" value="WinPin3.png" @if ($avatar == 'WinPin3.png') checked @endif >
					<input type="radio" name="avatar" id="avatarRadio4" value="WinPin4.png" @if ($avatar == 'WinPin4.png') checked @endif >
					<input type="radio" name="avatar" id="avatarRadio5" value="WinPin5.png" @if ($avatar == 'WinPin5.png') checked @endif >
					<input type="radio" name="avatar" id="avatarRadio6" value="WinPin6.png" @if ($avatar == 'WinPin6.png') checked @endif >
					<input type="radio" name="avatar" id="avatarRadio7" value="WinPin7.png" @if ($avatar == 'WinPin7.png') checked @endif >
				</div>
			</div>

    	<div class="form-actions">
	    	<input class="btn-primary btn" type="submit" value="Submit Changes"> 
	    	<input class="btn-inverse btn" type="reset" value="Reset">
	    </div>
    </form>
</div>

<h4>Change Password</h4>
<div class="well">
	<form class="form-horizontal" action="{{ URL::to('users/changepassword') }}/{{ $user->id }}" method="post">
        {{ Form::token() }}
        
        <div class="control-group {{ $errors->has('oldPassword') ? 'error' : '' }}" for="oldPassword">
        	<label class="control-label" for="oldPassword">Old Password</label>
    		<div class="controls">
				<input name="oldPassword" value="" type="password" class="input-xlarge" placeholder="Old Password">
    			{{ ($errors->has('oldPassword') ? $errors->first('oldPassword') : '') }}
    		</div>
    	</div>

        <div class="control-group {{ $errors->has('newPassword') ? 'error' : '' }}" for="newPassword">
        	<label class="control-label" for="newPassword">New Password</label>
    		<div class="controls">
				<input name="newPassword" value="" type="password" class="input-xlarge" placeholder="New Password">
    			{{ ($errors->has('newPassword') ?  $errors->first('newPassword') : '') }}
    		</div>
    	</div>

    	<div class="control-group {{ $errors->has('newPassword_confirmation') ? 'error' : '' }}" for="newPassword_confirmation">
        	<label class="control-label" for="newPassword_confirmation">Confirm New Password</label>
    		<div class="controls">
				<input name="newPassword_confirmation" value="" type="password" class="input-xlarge" placeholder="New Password Again">
    			{{ ($errors->has('newPassword_confirmation') ? $errors->first('newPassword_confirmation') : '') }}
    		</div>
    	</div>
	        	
	    <div class="form-actions">
	    	<input class="btn-primary btn" type="submit" value="Change Password"> 
	    	<input class="btn-inverse btn" type="reset" value="Reset">
	    </div>
      </form>
  </div>

@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
<h4>User Group Memberships</h4>
<div class="well">
    <form class="form-horizontal" action="{{ URL::to('users/updatememberships') }}/{{ $user->id }}" method="post">
        {{ Form::token() }}

        <table class="table">
            <thead>
                <th>Group</th>
                <th>Membership Status</th>
            </thead>
            <tbody>
                @foreach ($allGroups as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>
                            <div class="switch" data-on-label="In" data-on='info' data-off-label="Out">
                                <input name="permissions[{{ $group->id }}]" type="checkbox" {{ ( $user->inGroup($group)) ? 'checked' : '' }} >
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-actions">
            <input class="btn-primary btn" type="submit" value="Update Memberships">
        </div> 
    </form>
</div>
@endif    

@stop
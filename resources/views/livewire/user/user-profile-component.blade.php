<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <img src="{{ asset('assets/images/profile') }}/{{ $user->profile->image }}" width="100%" />
                    </div>
                    <div class="col-md-8">
                        <p><b>Nom: </b>{{ $user->name }}</p>
                        <p><b>Email: </b>{{ $user->email }}</p>
                        <p><b>Téléphone: </b>{{ $user->profile->mobile }}</p>
                        <hr/>
                        <p><b>Line1: </b>{{ $user->profile->line1 }}</p>
                        <p><b>Line2: </b>{{ $user->profile->line2 }}</p>
                        <p><b>Ville: </b>{{ $user->profile->city }}</p>
                        <p><b>Province: </b>{{ $user->profile->province }}</p>
                        <p><b>Country: </b>{{ $user->profile->country }}</p>
                        <p><b>Zip Code: </b>{{ $user->profile->zipcode }}</p>
                        <a href="{{ route('user.editprofile') }}" class="btn btn-info pull-right">Mettre à jour le profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Sliders
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.addhomeslider') }}" class="btn btn-success pull-right">Ajouter un slider</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Sous-titre</th>
                                    <th>Prix</th>
                                    <th>Url</th>
                                    {{-- <th>Lien</th> --}}
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $slider->id }}</td>
                                        <td>
                                            <img src="{{ asset('assets/images/sliders') }}/{{ $slider->image }}" width="120" />
                                        </td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->subtitle }}</td>
                                        <td>{{ priceFormat($slider->price) }}</td>
                                        <td>{{ $slider->link }}</td>
                                        <td>{{ $slider->status == 1? 'Actif' : 'Desactiver' }}</td>
                                        <td>{{ $slider->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.edithomeslider', ['slide_id' => $slider->id]) }}"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" wire:click.prevent="deleteSlide({{ $slider->id }})"><i class="fa fa-times fa-2x text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $sliders->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

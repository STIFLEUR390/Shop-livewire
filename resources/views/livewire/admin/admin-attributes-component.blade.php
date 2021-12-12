<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block !important;
        }

        .sclist {
            list-style: none;
        }

        .sclist li {
            line-height: 33px;
            border-bottom: 1px solid #ccc;
        }

        .slink {
            font-size: 16px;
            margin-left: 12px;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Tous les attributs
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.add_attribute') }}" class="btn btn-success pull-right">Add new</a>
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
                                    <th>Nom</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_attributes as $product_attribute)
                                    <tr>
                                        <td>{{ $product_attribute->id }}</td>
                                        <td>{{ $product_attribute->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit_attribute', ['attribute_id' => $product_attribute->id]) }}"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" wire:click.prevent="deleteAttribute({{ $product_attribute->id }})" style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $product_attributes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

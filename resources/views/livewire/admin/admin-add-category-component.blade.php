<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Nouvelle Categorie
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.categories') }}" class="btn btn-success pull-right">Toute les Categories</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal"  wire:submit.prevent='storeCategory'>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nom Categorie</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Nom Categorie" class="form-control input-md" wire:model="name" wire:keyup="generateSlug" />
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Slug Categorie</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Slug Categorie" class="form-control input-md" wire:model="slug" />
                                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Categorie Parent</label>
                                <div class="col-md-4">
                                    <select class="form-control input-md" wire:model='category_id'>
                                        <option value="">Aucun</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Créer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

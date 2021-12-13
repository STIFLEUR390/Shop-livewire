<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Modifier un produit
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.products') }}" class="btn btn-success pull-right">Toute les Produits</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateProduct">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nom du produit</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Nom du produit" class="form-control input-md" wire:model="name" wire:keyup="generateSlug" />
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Slug produit</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Slug produit" class="form-control input-md" wire:model="slug" />
                                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Courte description</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea class="form-control" id="short_description" placeholder="Description courte" wire:model="short_description"></textarea>
                                    @error('short_description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Description</label>
                                <div class="col-md-4" wire:ignore>
                                    <textarea class="form-control" id="description" placeholder="Description" wire:model="description"></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Prix habituel</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Prix habituel" class="form-control input-md" wire:model="regular_price" />
                                    @error('regular_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Prix de vente</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Prix de vente" class="form-control input-md" wire:model="sale_price" />
                                    @error('sale_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">SKU</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="SKU" class="form-control input-md" wire:model="SKU" />
                                    @error('SKU') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Stock</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="stock_status">
                                        <option value="instock">En Stock</option>
                                        <option value="outstock">En rupture de stock</option>
                                    </select>
                                    @error('stock_status') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">En vedette</label>
                                <div class="col-md-4" wire:model="featured">
                                    <select class="form-control">
                                        <option value="0">Non</option>
                                        <option value="1">Oui</option>
                                    </select>
                                    @error('featured') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Quantité</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Quantité" class="form-control input-md" wire:model="quantity" />
                                    @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Image du produit</label>
                                <div class="col-md-4">
                                    <input type="file" class="input-file" wire:model="newimage" accept="image/*" />
                                    @error('newimage') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    @if ($newimage)
                                        <img src="{{ $newimage->temporaryUrl() }}" width="120" />
                                    @else
                                        <img src="{{ asset('assets/images/products') }}/{{ $image }}" width="120" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Galerie du produit</label>
                                <div class="col-md-4">
                                    <input type="file" multiple accept="image/*" class="input-file" wire:model="newimages" />
                                    @error('newimages') <span class="text-danger">{{ $message }}</span> @enderror
                                    @if ($newimages)
                                        @foreach ($newimages as $newimage)
                                            @if ($newimage)
                                                <img src="{{ $newimage->temporaryUrl() }}" width="120" />
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($images as $image)
                                            @if ($image)
                                                <img src="{{ asset('assets/images/products') }}/{{ $image }}" width="120" />
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="category_id" wire:change="changeSubcategory">
                                        <option value="">Selectionner une categorie</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Sous Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="sub_category_id">
                                        <option value="">Selectionner une sous categorie</option>
                                        @foreach ($sub_categories as $sub_category)
                                            <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Product Attributes</label>
                                <div class="col-md-3">
                                    <select class="form-control" wire:model="attr">
                                        <option value="">Select Attribute</option>
                                        @foreach ($product_attributes as $product_attribute)
                                            <option value="{{ $product_attribute->id }}">{{ $product_attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" wire:click.prevent='add' class="btn btn-info">Add</button>
                                </div>
                            </div>

                            @foreach ($inputs as $key => $value)
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{ $product_attributes->where('id', $attribute_arr[$key])->first()->name }}</label>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="{{ $product_attributes->where('id', $attribute_arr[$key])->first()->name }}" class="form-control input-md" wire:model="attribute_values.{{ $value }}" />
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" wire:click.prevent='remove({{$key}})' class="btn btn-danger btn-sm">Remove</button>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
  <script type="text/javascript">
    $(function() {
        tinymce.init({
            selector: '#short_description',
            setup: function(editor) {
                editor.on('Change', function(e){
                    tinyMCE.triggerSave();
                    var sd_data = $('#short_description').val();
                    @this.$set('short_description', sd_data);
                });
            }
        });

        tinymce.init({
            selector: '#description',
            setup: function(editor) {
                editor.on('Change', function(e){
                    tinyMCE.triggerSave();
                    var d_data = $('#description').val();
                    @this.$set('description', d_data);
                });
            }
        });
    });
  </script>
@endpush

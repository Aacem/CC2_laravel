@extends('layouts.admin')

@section('content')

<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Product 
                            <a href="{{url('admin/products')}}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                            <form action="{{url('admin/products/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')



                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">SEO Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Product Image</button>
                            </li>
                        </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="mb-3">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Product Name</label>
                                        <input type="text" value="{{$product->name}}" name="name" class="form-control"/>
                                    </div>
                                    <div class="mb-3">
                                        <label>Product Slug</label>
                                        <input type="text"  value="{{$product->slug}}" name="slug" class="form-control"/>
                                    </div>
                                    <div class="mb-3">
                                        <label>Small Description (500 Words)</label>
                                        <textarea name="small_description" class="form-control" rows="4">{{$product->small_description}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="4">{{$product->description}}</textarea>
                                    </div>


                                </div>
                                <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                                    <div class="mb-3">
                                        <label>Meta Title</label>
                                        <input type="text" value="{{$product->meta_title}}" name="meta_title" class="form-control"/>
                                    </div>
                                    <div class="mb-3">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="4">{{$product->meta_description}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Meta Keyword (500 Words)</label>
                                        <textarea name="meta_keyword" class="form-control" rows="4">{{$product->meta_keyword}}</textarea>
                                    </div>
                                
                                </div>
                                <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Original price</label>
                                                <input type="text" value="{{$product->original_price}}" name="original_price" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Selling price</label>
                                                <input type="text" value="{{$product->selling_price}}" name="selling_price" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Ouantity</label>
                                                <input type="number" value="{{$product->quantity}}" name="quantity" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Trending</label>
                                                <input type="checkbox" name="trending" {{$product->trending == '1' ? 'checked':''}} style="width: 25px;height: 25px;"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label>Status</label>
                                                <input type="checkbox" name="status" {{$product->status == '1' ? 'checked':''}} style="width: 25px;height: 25px;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                    <div class="mb-3">
                                        <label>Upload Product Images</label>
                                        <input type="file" name="image[]" multiple class="form-control"/>
                                    </div>
                                    <div>
                                        @if($product->productImages)
                                            @foreach($product->productImages as $image)
                                            
                                            <img src="{{asset($image->image)}}" style="width:80px; height:80px;" class="me-4 border" alt="img">
                                            @endforeach
                                        @else
                                            <h5>No Image Added</h5>
                                        @endif
                                    </div>        
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
</div>

@endsection

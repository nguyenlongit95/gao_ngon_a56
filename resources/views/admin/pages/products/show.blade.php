@extends('admin.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('/css/custom/CustomStyle.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $product->name }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-md-12 float-left">
            @include('admin.layouts.errors')
        </div>

        <section class="content">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $product->name }} Review</h3>
                    <div class="col-12">
                        @if(!empty($product->productImg))
                            <?php $i = 0 ?>
                            @foreach($product->productImg as $image)
                                @if($i === 0)
                                <img src="{{ asset($image->image) }}" class="product-image" alt="{{ $product->name }}">
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-12 product-image-thumbs">
                        @if(!empty($product->productImg))
                            <?php $j = 0; ?>
                            @foreach($product->productImg as $image)
                                <div @if($j == 0) class="product-image-thumb active" @else class="product-image-thumb" @endif><img src="{{ asset($image->image) }}" alt="{{ $product->name }}"></div>
                                <?php $j++; ?>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{ $product->name }} Review</h3>
                    {!! $product->info !!}
                    <hr>
                    <h4>Table special attribute</h4>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Attribute name</td>
                                <td>Value attribute</td>
                                <td>Sort order</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if($product->productAttitude)
                                @foreach($product->productAttitude as $value)
                                <tr>
                                    <td>{{ $value->attribute }}</td>
                                    <td>{{ $value->value }}</td>
                                    <td>{{ $value->sort }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    @if(!empty($product->color))
                    <h4>Available Colors</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        @foreach($product->color as $value)
                        <label class="btn btn-default text-center active">
                            <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                            <span style="color: {{ $value->color }}">{{ $value->color }}</span>
                            <br>
                            <i class="fas fa-circle fa-2x" style="color: {{ $value->color }}"></i>
                        </label>
                        @endforeach
                    </div>
                    @endif

                    @if(!empty($product->size))
                    <h4 class="mt-3">Size</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        @foreach($product->size as $value)
                        <label class="btn btn-default text-center box-size-preview">
                            <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                            <span class="text-xl">{{ $value->size }}</span>
                        </label>
                        @endforeach
                    </div>
                    @endif

                    <div class="bg-gray py-2 px-3 mt-4">
                        <div class="row">
                            <div class="mt-6 margin-right-15per">
                                <h2 class="mb-0">
                                    {{ number_format($product->price, 0) }}
                                </h2>

                                <h4 class="mt-0">
                                    <small>Origin: {{ $product->origin }} </small>
                                </h4>

                                <h4 class="mt-0">
                                    <small>Category: {{ $product->category->name }} </small>
                                </h4>

                                <h4 class="mt-0">
                                    <small>Product code: {{ $product->code }} </small>
                                </h4>

                                <h4 class="mt-0">
                                    <small>Status of product:
                                        @if($product->status == 0)
                                            <span class="text-danger">Out of stock</span>
                                        @else
                                            <span class="text-white">In stock</span>
                                        @endif
                                    </small>
                                </h4>

                                <h4 class="mt-0">
                                    <small>Quantity of product: {{ $product->qty }} </small>
                                </h4>

                                <h4 class="mt-0">
                                    <small>Product tags: </small>
                                    @if(!empty($product->productTags) && !empty($tags))
                                        @foreach($product->productTags as $value)
                                            @foreach($tags as $tag)
                                                @if($value->tags_id === $tag->id)
                                                <a href="{{ url('/admin/tags/' . $tag->id . '/edit') }}" class="btn btn-default">{{ $tag->tags }}</a>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                </h4>
                            </div>
                            <div class="mt-6">
                                <div class="box-qr-code">
                                    {!! $qrCode !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row col-12">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3 w-100" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                            <table class="table table-bordered table-hover text-center">
                                <thead class="background-blue color-white">
                                    <tr>
                                        <td>#</td>
                                        <td>User ratting</td>
                                        <td>Email of user</td>
                                        <td>Star ratting</td>
                                        <td>Time ratting</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($rattings))
                                        @foreach($rattings as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $value->rattings)
                                                        <span class="fa fa-star star-checked"></span>
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td>{{ $value->created_at }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')

@endsection

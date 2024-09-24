@extends('master.master')

@push('css')
@endpush
<style>
  
</style>
@section('content')

     <!-- Content wrapper -->
     <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="app-ecommerce">
            <!-- Add Product -->
            <div
              class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
              <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1">Add a new Product</h4>
                <p class="mb-0">Orders placed across your store</p>
              </div>
              <div class="d-flex align-content-center flex-wrap gap-4">
                <div class="d-flex gap-4">
                  <button class="btn btn-label-secondary">Discard</button>
                  <button class="btn btn-label-primary">Save draft</button>
                </div>
                <button type="submit" class="btn btn-primary">Publish product</button>
              </div>
            </div>

            <div class="row">
              <!-- First column-->
              <div class="col-12 col-lg-7">
                <!-- Product Information -->
                @include('pages.product.addproduct.product-infromation')
                <!-- /Product Information -->
                <!-- Media -->
                <!-- /Media -->

                <!-- Inventory -->
                {{-- @include('pages.product.addproduct.product-inventory') --}}
                <!-- /Inventory -->
              </div>
                  <!-- Second column -->
                  <div class="col-12 col-lg-5">

                    <!-- Organize Card -->
                    @include('pages.product.addproduct.product-vendor')
                    <!-- /Organize Card -->
                    @include('pages.product.addproduct.product-bundle')
                  <!-- /Second column -->
              <div class="col-12 col-lg-8">
                 <!-- Variants -->
                 @include('pages.product.addproduct.product-variants')
                     <!-- /Variants -->
              </div>

              <div class="col-12 col-lg-4">
                <!-- Variants -->
                @include('pages.product.addproduct.product-media')
                    <!-- /Variants -->
             </div>

              <div class="col-12 col-lg-12">
                <div class=" card">
                  <div class="mt-4">
                    <div class="card-header">
                      <h5 class="card-title mb-0">Options Table</h5>
                    </div>

                  
                    <table class="table table-bordered mt-2">
                      <thead>
                        <tr>
                        
                        </tr>
                      </thead>
                      <tbody id="options-table-body">
                        <!-- Rows will be dynamically added here -->
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>

              
    
            </div>
          </div>
        </div>
        <!-- / Content -->


        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
      
@endsection

@push('script')

@endpush
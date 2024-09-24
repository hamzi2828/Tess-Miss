<div class="card mb-6">
    <div class="card-header">
      <h5 class="card-title mb-0">Inventory</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <!-- Navigation -->
        <div class="col-12 col-md-4 col-xl-5 col-xxl-4 mx-auto card-separator">
          <div class="d-flex justify-content-between flex-column mb-4 mb-md-0 pe-md-4">
            <div class="nav-align-left">
              <ul class="nav nav-pills flex-column w-100">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#restock">
                    <i class="ti ti-box ti-sm me-1_5"></i>
                    <span class="align-middle">Restock</span>
                  </button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping">
                    <i class="ti ti-car ti-sm me-1_5"></i>
                    <span class="align-middle">Shipping</span>
                  </button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#global-delivery">
                    <i class="ti ti-world ti-sm me-1_5"></i>
                    <span class="align-middle">Global Delivery</span>
                  </button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#attributes">
                    <i class="ti ti-link ti-sm me-1_5"></i>
                    <span class="align-middle">Attributes</span>
                  </button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#advanced">
                    <i class="ti ti-lock ti-sm me-1_5"></i>
                    <span class="align-middle">Advanced</span>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /Navigation -->
        <!-- Options -->
        <div class="col-12 col-md-8 col-xl-7 col-xxl-8 pt-6 pt-md-0">
          <div class="tab-content p-0 ps-md-4">
            <!-- Restock Tab -->
            <div class="tab-pane fade show active" id="restock" role="tabpanel">
              <h6 class="text-body">Options</h6>
              <label class="form-label" for="ecommerce-product-stock">Add to Stock</label>
              <div class="row mb-4 g-4 pe-md-4">
                <div class="col-12 col-sm-9">
                  <input
                    type="number"
                    class="form-control"
                    id="ecommerce-product-stock"
                    placeholder="Quantity"
                    name="quantity"
                    aria-label="Quantity" />
                </div>
                <div class="col-12 col-sm-3">
                  <button class="btn btn-primary">Confirm</button>
                </div>
              </div>
              <div>
                <h6 class="mb-2 fw-normal">Product in stock now: 54</h6>
                <h6 class="mb-2 fw-normal">Product in transit: 390</h6>
                <h6 class="mb-2 fw-normal">Last time restocked: 24th June, 2023</h6>
                <h6 class="mb-0 fw-normal">Total stock over lifetime: 2430</h6>
              </div>
            </div>
            <!-- Shipping Tab -->
            <div class="tab-pane fade" id="shipping" role="tabpanel">
              <h6 class="mb-3 text-body">Shipping Type</h6>
              <div>
                <div class="form-check mb-4">
                  <input class="form-check-input" type="radio" name="shippingType" id="seller" />
                  <label class="form-check-label" for="seller">
                    <span class="mb-1 h6">Fulfilled by Seller</span><br />
                    <small
                      >You'll be responsible for product delivery.<br />
                      Any damage or delay during shipping may cost you a Damage fee.</small
                    >
                  </label>
                </div>
                <div class="form-check mb-6">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="shippingType"
                    id="companyName"
                    checked />
                  <label class="form-check-label" for="companyName">
                    <span class="mb-1 h6"
                      >Fulfilled by Company name &nbsp;<span
                        class="badge rounded-2 badge-warning bg-label-warning fs-tiny py-1"
                        >RECOMMENDED</span
                      ></span
                    ><br />
                    <small
                      >Your product, Our responsibility.<br />
                      For a measly fee, we will handle the delivery process for you.</small
                    >
                  </label>
                </div>
                <p class="mb-0">
                  See our <a href="javascript:void(0);">Delivery terms and conditions</a> for details
                </p>
              </div>
            </div>
            <!-- Global Delivery Tab -->
            <div class="tab-pane fade" id="global-delivery" role="tabpanel">
              <h6 class="mb-3 text-body">Global Delivery</h6>
              <!-- Worldwide delivery -->
              <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="globalDel" id="worldwide" />
                <label class="form-check-label" for="worldwide">
                  <span class="mb-1 h6">Worldwide delivery</span><br />
                  <small
                    >Only available with Shipping method:
                    <a href="javascript:void(0);">Fulfilled by Company name</a></small
                  >
                </label>
              </div>
              <!-- Global delivery -->
              <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="globalDel" checked />
                <label class="form-check-label w-75 pe-12" for="country-selected">
                  <span class="mb-2 h6">Selected Countries</span>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Type Country name"
                    id="country-selected" />
                </label>
              </div>
              <!-- Local delivery -->
              <div class="form-check">
                <input class="form-check-input" type="radio" name="globalDel" id="local" />
                <label class="form-check-label" for="local">
                  <span class="mb-1 h6">Local delivery</span><br />
                  <small
                    >Deliver to your country of residence :
                    <a href="javascript:void(0);">Change profile address</a></small
                  >
                </label>
              </div>
            </div>
            <!-- Attributes Tab -->
            <div class="tab-pane fade" id="attributes" role="tabpanel">
              <h6 class="mb-2 text-body">Attributes</h6>
              <div>
                <!-- Fragile Product -->
                <div class="form-check mb-4">
                  <input class="form-check-input" type="checkbox" value="fragile" id="fragile" />
                  <label class="form-check-label" for="fragile">
                    <span class="fw-medium">Fragile Product</span>
                  </label>
                </div>
                <!-- Biodegradable -->
                <div class="form-check mb-4">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value="biodegradable"
                    id="biodegradable" />
                  <label class="form-check-label" for="biodegradable">
                    <span class="fw-medium">Biodegradable</span>
                  </label>
                </div>
                <!-- Frozen Product -->
                <div class="form-check mb-4">
                  <input class="form-check-input" type="checkbox" value="frozen" checked />
                  <label class="form-check-label w-75 pe-12" for="frozen">
                    <span class="mb-1 h6">Frozen Product</span>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Max. allowed Temperature"
                      id="frozen" />
                  </label>
                </div>
                <!-- Exp Date -->
                <div class="form-check mb-6">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value="expDate"
                    id="expDate"
                    checked />
                  <label class="form-check-label w-75 pe-12" for="date-input">
                    <span class="mb-1 h6">Expiry Date of Product</span>
                    <input type="date" class="product-date form-control" id="date-input" />
                  </label>
                </div>
              </div>
            </div>
            <!-- /Attributes Tab -->
            <!-- Advanced Tab -->
            <div class="tab-pane fade" id="advanced" role="tabpanel">
              <h6 class="mb-3 text-body">Advanced</h6>
              <div class="row">
                <!-- Product Id Type -->
                <div class="col">
                  <label class="form-label" for="product-id">
                    <span class="mb-1 h6">Product ID Type</span>
                  </label>
                  <select id="product-id" class="select2 form-select" data-placeholder="ISBN">
                    <option value="">ISBN</option>
                    <option value="ISBN">ISBN</option>
                    <option value="UPC">UPC</option>
                    <option value="EAN">EAN</option>
                    <option value="JAN">JAN</option>
                  </select>
                </div>
                <!-- Product Id -->
                <div class="col">
                  <label class="form-label" for="product-id-1">
                    <span class="mb-1 h6">Product ID</span>
                  </label>
                  <input
                    type="number"
                    id="product-id-1"
                    class="form-control"
                    placeholder="ISBN Number" />
                </div>
              </div>
            </div>
            <!-- /Advanced Tab -->
          </div>
        </div>
        <!-- /Options-->
      </div>
    </div>
  </div>